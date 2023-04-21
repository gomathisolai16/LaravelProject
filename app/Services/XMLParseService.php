<?php
/**
 * Created by PhpStorm.
 * User: Var Yan
 * Date: 22.09.2017
 * Time: 12:47
 */

namespace App\Services;

use App;
use App\Models\News;
use Carbon\Carbon;
use Log;
use App\Models\Category;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Storage;
use App\Services\PathService;
use App\Services\ImageService;
use App\Services\BrokenNewsService;
use App\Models\Video;

/**
 * Class XMLParseService
 * @package App\Services
 */
class XMLParseService
{
    /**
     *
     * Collect parsed data into Array
     *
     * @var array $_parsedData
     */
    private $_parsedData = [];
    /**
     *
     * Store after parsing
     *
     * @var bool
     */
    private $_store = true;
    /**
     *
     * Define news model for feature use
     *
     * @var News $_news
     */
    private $_news;

    private $path;

    /**
     * XMLParseService constructor.
     */
    public function __construct()
    {
        $this->_news = new News();

        $this->path = storage_path();

        if (App::environment('production') || App::environment('staging')) {
            $this->path = Storage::disk('s3');
        }
    }

    /**
     * Used by local dev 
     * 
     * @param bool $store
     * @return void
     */
    public function parseXMLData($store = true)
    {

        $this->_store = $store;

        // get all .xml files from storage/news
        if (App::environment('production')) {
            $files = $this->path->files('news/');
        } else {
            $files = glob(storage_path('news/*.xml'));
        }

        $filesList = [];
        foreach ($files as $file) {
            $filesList[explode(".",basename($file))[0]] = $file;
        }

        krsort($filesList);
        $files = array_slice(array_values($filesList), 0, 1000);

        // loop throw and get XML data from file
        foreach ($files as $file) {
            // prepare xml file for parsing
            if (App::environment('production')) {
                $s3file = $this->path->get($file);
                $data = (array)@simplexml_load_string($s3file);
            } else {
                $data = (array)@simplexml_load_file($file);
            }

            // each news should have category
            if (empty($data['Metadata'])) {
                if (App::environment('production')) {
                    // S3 file handling
                    $this->_moveFileS3($file, true, $this->path->get($file));
                } else {
                    // regular file handling
                    $this->_moveFile($file, true);
                }
                Log::error("Metadata is missing for file: " . basename($file));
                continue;
            }

            $descAndPrice = $this->_getDescription($data);

            // get description
            $description = $this->_makeAllLinksClickable($descAndPrice['description']);

            if (empty(trim($description))) {
                if (App::environment('production')) {
                    // S3 file handling
                    $this->_moveFileS3($file, true, $this->path->get($file));
                } else {
                    // regular file handling
                    $this->_moveFile($file, true);
                }
                Log::error("Description is empty for file: ".$fileN);
                continue;
            }

            // get price
            $price = $descAndPrice['price'];

            // if XML file contains Copyright section then add this to the end of description
            $this->_attachCopyright($data, $description);

            // get date
            $date = $this->_getDate($data);

            // collect categories
            $tmpCategories = $this->_getCategories($data);

            // collect tickers
            $tmpTickers = $this->_getTickers($data);

            $isTop = Category::isTopNewsCategory($tmpCategories);
            $isVideo = Category::isVideosNewsCategory($tmpCategories);
            $isCrypto = Category::isCryptoNewsCategory($tmpCategories);
            
            $transmissionId = $this->_getTransmissionId($data);
 
            $imagesData = ($isTop || $isCrypto) ? $this->_getImages($data) : [];
            $videosData = $isVideo ? $this->_getVideos($data) : [];

            // prepare news insert data
            $news = [
                'meta_keywords' => json_encode($tmpCategories),
                'title' => (string)$data['Headline'],
                'description' => $description,
                'top' => $isTop,
                'video' => $isVideo,
                'crypto' => $isCrypto,
                'active' => true,
                'transmission_id' => $transmissionId,
                'show_in_editor' => $isTop,
                'percentage' => $price,
                'release_date' => $date,
                // 'created_at' => $date,
                // 'updated_at' => $date,
            ];
            $this->_insert($news, $tmpTickers, $tmpCategories, $imagesData, $videosData);

            // after success finish move xml file into seeded_news folder
            if (App::environment('production')) {
                // S3 file handling
                $this->_moveFileS3($file);
            } else {
                // regular file handling
                $this->_moveFile($file);
            }


        }
    }

    /**
     * Used by SQS (production / staging)
     * 
     * @param bool $store
     * @return void
     */
    public function parseXMLDataOneFile($store = true, $fileName)
    {
        $this->_store = $store;

        if (!$this->path->exists($fileName))
          return false;

        // prepare xml file for parsing
        $file = $this->path->get($fileName);
    
        $data = (array)@simplexml_load_string($file);

        // each news should have category
        if (empty($data['Metadata'])) {
            Log::error("Metadata is empty for ".$fileName);
            $this->_moveFileS3($fileName, true, $file);
            return false;
        }

        $descAndPrice = $this->_getDescription($data);

        // get description
        $description = $this->_makeAllLinksClickable($descAndPrice['description']);

        if (empty(trim($description))) {
            Log::error("Descripton is empty for ".$fileName);
            $this->_moveFileS3($fileName, true, $file);
            return false;
        }

        // get price
        $price = $descAndPrice['price'];

        // if XML file contains Copyright section then add this to the end of description
        $this->_attachCopyright($data, $description);

        // get date
        $date = $this->_getDate($data);

        // collect categories
        $tmpCategories = $this->_getCategories($data);

        // collect tickers
        $tmpTickers = $this->_getTickers($data);

        $isTop = Category::isTopNewsCategory($tmpCategories);
        $isVideo = Category::isVideosNewsCategory($tmpCategories);
        $isCrypto = Category::isCryptoNewsCategory($tmpCategories);

        $transmissionId = $this->_getTransmissionId($data);

        $imagesData = ($isTop || $isCrypto) ? $this->_getImages($data) : [];
        $videosData = $isVideo ? $this->_getVideos($data) : [];

        // prepare news insert data
        $news = [
            'meta_keywords' => json_encode($tmpCategories),
            'title' => (string)$data['Headline'],
            'description' => $description,
            'top' => $isTop,
            'video' => $isVideo,
            'crypto' => $isCrypto,
            'active' => true,
            'transmission_id' => $transmissionId,
            'show_in_editor' => $isTop,
            'percentage' => $price,
            'release_date' => $date,
        ];

        $this->_insert($news, $tmpTickers, $tmpCategories, $imagesData, $videosData);

        // after success finish move xml file into seeded_news folder
        $this->_moveFileS3($fileName);
    }

    /**
     * @return array
     */
    public function getParsedData()
    {
        return $this->_parsedData;
    }

    /**
     * @param array $data
     * @return string|null
     */
    private function _getTransmissionId($data)
    {
        if (isset($data['@attributes']['TransmissionID'])) {
            return $data['@attributes']['TransmissionID'];
        }

        return null;
    }

    /**
     * @param array $data
     * @return array
     */
    private function _getDescription($data)
    {
        $description = '';
        $price = 0.0;

        if (isset($data['Body'])) {
            if (property_exists($data['Body'], 'p')) {
                $body = (array)$data['Body']->p;

                $priceP = (string)end($body);
                if (strpos($priceP, 'Price', 0) !== false) {
                    $partials = explode(',', $priceP);
                    $resolvedString = "";

                    if (isset($partials[2])) {
                        $percentParts = explode('Percent Change:', trim($partials[2]));
                        if (!empty($percentParts[1]) && $percentParts[1] != 0) {
                            if (strpos(trim($percentParts[1]),"%") !== false) {
                                $resolvedString = ", Percent Change: " . trim($percentParts[1]);
                                $percentParts[1] = str_replace("%","",$percentParts[1]);
                            } else {
                                $resolvedString = ", Percent Change: " . trim($percentParts[1]) . '%';
                            }
                            $price = (float)$percentParts[1];
                        }
                    }
                    if (isset($partials[1])) {
                        $changeParts = explode('Change:', trim($partials[1]));
                        if (!empty($changeParts[1]) && $changeParts[1] !== 0) {
                            if(strpos($priceP, 'Price:', 0) !== false && strpos(trim($changeParts[1]),"$") === false) {
                                $resolvedString = ", Change: $" . trim($changeParts[1]) . $resolvedString;
                            } else {
                                $resolvedString = ", Change: " . trim($changeParts[1]) . $resolvedString;
                            }
                        }
                    }
                    if (isset($partials[0])) {
                        $dollarSignCheck = false;
                        if (strpos($priceP, 'Price:', 0) !== false) {
                            $priceParts = explode(':', trim($partials[0]));
                            $dollarSignCheck = true;
                        } else {
                            $priceParts = explode(':', trim($partials[0]));
                        }

                        if (!empty($priceParts[1]) && $priceParts[1] !== 0) {
                            if ($dollarSignCheck) {
                                if (strpos(trim($priceParts[1]),"$") !== false) {
                                    $resolvedString = $priceParts[0].": " . trim($priceParts[1]) . $resolvedString;
                                } else {
                                    $resolvedString = $priceParts[0].": $" . trim($priceParts[1]) . $resolvedString;
                                }
                            } else {
                                $resolvedString = $priceParts[0].": " . trim($priceParts[1]) . $resolvedString;
                            }
                        }
                    }

                    if ($resolvedString !== '' && count($body) > 1)
                        $body[count($body) - 1] = $resolvedString;
                }

                foreach ($body as $index => $value) {
                    if ($index === 0) {
                        $value = strstr($value, '(MT Newswires)');
                    }

                    if (!empty(trim($value))) {
                        $description .= "<p>$value</p>";
                    }
                }
            } else {
                $description = $data['Body'];
            }
        }

        return [
            'description' => str_replace(',  ,', ',', $description),
            'price' => $price,
        ];
    }

    /**
     * @param array $data
     * @param string $description
     */
    private function _attachCopyright($data, &$description)
    {
        if (isset($data['Copyright'])) {
            $pieces = explode("\n", $data['Copyright']);
            $fixed = [];
            foreach ($pieces as $piece) {
                if (!empty(trim($piece))) {
                    $fixed[] = $piece;
                }
            }
            $pieces = $fixed;
            $description .= '<p>';
            if (count($pieces) > 1) {
                $extraPieces = explode('=====', $pieces[1]);
                $pieces[1] = $extraPieces[0];
                //$description .= '<a class="source-link" target="_blank" href="' . trim($pieces[0]) . '">' . trim($pieces[1]) . '</a>';
                $description .= trim($pieces[1]);
            } else {
                $description .= $pieces[0];
            }
            $description .= '</p>';
        }
    }

    /**
     * @param array $news
     * @param array $tickers
     * @param array $categories
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function _insert($news, $tickers, $categories, $images, $videos)
    {
        $this->_parsedData[] = [
            'news' => $news,
            'tickers' => $tickers,
            'categories' => $categories,
            'images' => $images,
            'videos' => $videos
        ];

        if ($this->_store) {
            if (isset($news['title'])) {
                if (count($categories)) {

                    $savedNews = NewsService::onExistsUpdateReturnNews($news);
                    if($savedNews === false){
                        $savedNews = News::create($news);
                    }

                    $notification = new NotificationService();
                    $notification->getRequest('NEWS');

                    // push categories for previous news
                    $foundedCategories = NewsService::getCategoriesByAbbrToInsert($categories, $savedNews->id);

                    // push tickers for previous news
                    $foundedTickers = NewsService::getTickersByAbbrToInsert($tickers, $savedNews->id);

                    if (count($foundedTickers)) {
                        $this->_news->storeBulkRelation('ticker', $foundedTickers);
                    }
                    $this->_news->storeBulkRelation('category', $foundedCategories);

                    if (count($images) !== 0) {
                        ImageService::insertImagesAndAttachToNews($images, $savedNews->id);
                    }

                    if (count($videos)) {
                        Video::addAndAttachToNews($savedNews->id, $videos);
                    }
                }
            }
        }
    }

    /**
     * @param array $data
     * @return string
     */
    private function _getDate($data)
    {
        if (isset($data['@attributes']['ReleaseTime'])) {
            $date = $data['@attributes']['ReleaseTime'];
            try {
                $date = Carbon::parse($date)->toDateTimeString();
            } catch (\InvalidArgumentException $exception) {
                // we don't need to stop cron if will be exception.
                // so script will continue it's work on exception with current date
            }
        } else {
            $date = Carbon::now()->toDateTimeString();
        }
        return $date;
    }

    /**
     * @param array $data
     * @return array
     */
    private function _getCategories($data)
    {
        $categories = [];
        $metadata = explode("\n", trim($data['Metadata']));
        if (count($metadata) === 1) {
            $metadata = explode(' ', $metadata[0]);
        }
        foreach ($metadata as $category) {
            $category = trim($category);
            if (!empty($category) && !in_array($category, $categories, true)) {
                $categories[] = $category;
            }
        }
        return $categories;
    }

    /**
     * @param array $data
     * @return array
     */
    private function _getTickers($data)
    {
        $tickers = [];
        if (isset($data['Tickers'])) {
            $pieces = explode(' ', $data['Tickers']);
            if (count($pieces) === 1) {
                $pieces = explode("\n", $pieces[0]);
            }
            foreach ($pieces as $ticker) {
                $ticker = trim($ticker);
                if (!empty($ticker) && !in_array($ticker, $tickers, true)) {
                    $tickers[] = $ticker;
                }
            }
        }
        return $tickers;
    }

    /**
     * @param string $file
     * @param bool $broken
     */
    private function _moveFile($file, $broken = false)
    {
        $path = $broken ? 'broken_news' : 'seeded_news';
        $fileName = time() . '_' . basename($file);
        @rename($file, storage_path("$path/" . $fileName));
        if ($broken) {
            BrokenNewsService::notify($file, $fileName);
        }
    }

    /**
     * @param string $file
     * @param bool $broken
     * @param string $content
     */
    private function _moveFileS3($file, $broken = false, $content = null)
    {
        $fp = $broken ? 'broken_news/' : 'seeded_news/';
        $fileName = str_replace('news/', '', $file);
        $fullFileName = $fp.$fileName;
        $i = 0;
        while($this->path->exists($fullFileName)) {
            $tmpName = str_replace('.xml', '', $fileName);
            $num = 0;
            if(mb_strpos($tmpName, '_') !== false) {
                $tmp = explode('_', $tmpName);
                $num = (int)array_pop($tmp);
                $tmpName = implode('_', $tmp);
            }

            $num++;
            $fileName = $tmpName.'_'.$num.'.xml';
            $fullFileName = $fp.$fileName;

            $i++;
            if($i > 1000) {
                // Something wrong. Just delete source file
                $this->path->delete($file);
                return;
            }
        }

        $this->path->move($file, $fullFileName);
        if ($broken && $content) {
            BrokenNewsService::notify($content, $fileName, true);
        }
    }

    /**
     * @param string $content
     * @return string
     */
    private function _makeAllLinksClickable($content)
    {
        return preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a target="_blank" href="$1">$1</a>', $content);
    }

    /**
     * @param array $data
     * @return array
     */
    private function _getImages($data) {
        // Check if 'ArticleImage' node is provided on news XML
        if (!isset($data['ArticleImage'])) {
            return [];
        }
        // Check if 'url' node with image location exists
        if (!property_exists($data['ArticleImage'], 'url')) {
            return [];
        }
        $size = 'original';
        // Check if 'size' attribute is defined 
        $attributes = $data['ArticleImage']->attributes();
        foreach ($attributes as $key => $value) {
            if ($key === 'size') {
                $size = strtolower($value ? $value : $size);
                break;
            }
        }
        $imagePublicLocationOnEnv = PathService::forEnv()->getUrl('');
        $locationTokens = explode($imagePublicLocationOnEnv, $data['ArticleImage']->url);
        if (count($locationTokens) < 2) {
            Log::error(
                'Image is not part of storage for this environment with URL ' . $data['ArticleImage']->url .
                ', where respective storage is ' . $imagePublicLocationOnEnv
            );
            return [];
        }
        $imageNameExtReg = "/\/[0-9a-zA-Z]+\.(jpg|jpeg)$/";
        $providedImagePath = $locationTokens[1];
        preg_match($imageNameExtReg, $providedImagePath, $imageName);
        if (count($imageName) === 0) {
            Log::error('No signature of JPG/JPEG file in the remote location ' . $data['ArticleImage']->url);
            return [];
        }
        $timestamp = Carbon::now()->toDateTimeString();
        $author = '';
        $title = $imageName[0];
        $imageData[] = [
            'path' => $providedImagePath,
            'title' => substr($title, 1),
            'size' => $size ? $size : 'original',
            'author' => $author,
            'created_at' => $timestamp,
            'updated_at' => $timestamp
        ];
        $leftDimensions = array_filter(['original', 'small', 'medium'], function($value) use ($size) {
            return $value !== $size;
        });
        foreach ($leftDimensions as $dimension) {
            if ($dimension === 'small') {
                $dimensionSubPath = '/small';
            } else if ($dimension === 'medium') {
                $dimensionSubPath = '/medium';
            } else {
                $dimensionSubPath = '/';
            }
            $path = preg_replace($imageNameExtReg, $dimensionSubPath . $title, $providedImagePath);
            $imageData[] = [
                'path' => $path,
                'title' => substr($title, 1),
                'size' => $dimension,
                'author' => $author,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ];
        }
        return $imageData;
    }

    /**
     * @param array $data
     * @return array
     */
    private function _getVideos($data) {
        // Check if 'ArticleVideo' node is provided in the XML file
        if (!isset($data['ArticleVideo'])) {
            return [];
        }
        // Check if 'ArticleVideo' has <url> child defined so we can fetch video URL
        if (!property_exists($data['ArticleVideo'], 'url')) {
            return [];
        }
        if (empty($data['ArticleVideo']->url)) {
            return [];
        }
        return ['url' => $data['ArticleVideo']->url];
    }
}
