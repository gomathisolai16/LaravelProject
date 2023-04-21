<?php
/**
 * Created by IntelliJ IDEA.
 * User: Var Yan
 * Date: 19.12.2017
 * Time: 15:33
 */

namespace App\Services;

use App\Models\News;
use Carbon\Carbon;

/**
 * Class XMLGenerateService
 * @package App\Services
 */
class XMLGenerateService
{
    const DATE_FIRST = 1;
    const TIME_FIRST = 2;
    const SOURCE_OF_IMAGE = 'Shutterstock.com';

    protected $_news;
    /**
     * @var string $__content
     */
    private $__fileName;
    private $__path;

    /**
     * XMLGenerateService constructor.
     * @param News $news
     */
    public function __construct(News $news)
    {
        $this->_news = $news;
        $this->__path = storage_path('generated');
        $this->_generate();
    }

    /**
     * @return string
     */
    public function getGeneratedXMLFileName()
    {
        return $this->__fileName;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->__path;
    }

    /**
     * Generate XML file
     */
    protected function _generate()
    {
        $node = <<<XML
<?xml version="1.0" encoding="UTF-8" ?>
<Document></Document>
XML;

        $xml = new \SimpleXMLElement($node);
        $date = $this->_getDate()->format('Y/m/d H:i:s');
        $xml->addAttribute('ReleaseTime', $date);
        $xml->addAttribute('TransmissionID', $this->_news->transmission_id);

        $images = $this->_news->images;
        if (null !== $images) {
            foreach ($this->_news->images as $item) {
                $image = $xml->addChild('ArticleImage');
                $image->addAttribute('size', ucfirst($item->size));
                $image->addChild('url', PathService::forEnv()->getUrl($item->path));
                $image->addChild('source', self::SOURCE_OF_IMAGE);
                $image->addChild('photographer', $item->author);
            }
        }
        $xml->addChild('Metadata', $this->_getMetadataValue());

        $xml->addChild('Headline', htmlspecialchars($this->_news->title));
        $body = $xml->addChild('Body');
        $this->_attachBody($body);
        $xml->addChild('Tickers', $this->_getTickersValue());
        $this->_attachCopyright($xml);

        // NOTE: In case the transmission_id value starts with 'G' we need to provide it as the name
        // of the new generated file. For all the other cases we need to stick to the logic of replacing
        // the leading 'A' character with 'M'
        $transmissionIdFirstLetter = substr($this->_news->transmission_id, 0, 1);
        $fileName = $transmissionIdFirstLetter === 'G'
            ? $this->_news->transmission_id
            : 'M' . ltrim($this->_news->transmission_id, 'A');
        $this->__fileName = $fileName . '.xml';

        $dom = dom_import_simplexml($xml)->ownerDocument;
        $dom->formatOutput = true;
        $dom->preserveWhiteSpace = false;
        $dom->save($this->__path . '/' . $this->__fileName);
    }

    /**
     * @param bool $returnCats
     * @return string|array
     */
    protected function _getMetadataValue($returnCats = false)
    {
        static $categories;
        if (!$categories) {
            $categories = $this->_news->categories->pluck('abbreviation')->toArray();
        }
        if ($returnCats) {
            return $categories;
        }

        $output = '&#xA;';

        foreach ($categories as $category) {
            $output .= $category.'&#xA;';
        }

        return $output;
    }

    /**
     * @param bool $returnTicks
     * @return string|array
     */
    protected function _getTickersValue($returnTicks = false)
    {
        static $tickers;
        if (!$tickers) {
            $tickers = $this->_news->tickers->pluck('abbreviation')->toArray();
        }
        if ($returnTicks) {
            return $tickers;
        }
        return implode(' ', $tickers);
    }

    /**
     * @param \SimpleXMLElement $body
     */
    protected function _attachBody($body)
    {
        $str = $this->_news->description;
        $done = false;
        $current = $this->_getDate()->format('g:i A T, m/d/Y') . ' ';
        for ($i = 0; $i < strlen($str); $i++) {
            if (!in_array($str[$i], ['<', '>'])) {
                $current .= $str[$i];
            } elseif ($str[$i] === '<') {
                $i += 2;
            } elseif (isset($str[$i - 2]) && $str[$i - 2] === '/') {
                $i += 2;
                $done = true;
                if (strpos($current, 'Copyright ©') === FALSE) {
                    $body->addChild('p', str_replace('&#13;', ' ', str_replace('&#13;', ' ', trim($current))));
                }
                $current = '';
            }
        }

        if (!$done) {
            $body->addChild('p', $str);
        }
    }

    /**
     * @param \SimpleXMLElement $xml
     * @return string
     */
    protected function _attachCopyright($xml)
    {
        $tickers = $this->_getTickersValue(true);
        $year = Carbon::now()->year;

        if (in_array('UPTK', $tickers, true)) {
            $xml->addChild('Copyright', 'Copyright © ' . $year . ' , All Rights reserved. Data provided by UpTick Data Technologies.');
            return true;
        }

        if (in_array('ALLI', $tickers, true)) {
            $xml->addChild('Copyright', 'Copyright © ' . $year . ' Alliance News Limited. Delivery via MT Newswires. All Rights Reserved.');
            return true;
        }

        $content = 'http://www.demkn.com Copyright © ' . $year . ' . All rights reserved. MT Newswires does not provide investment advice. Unauthorized reproduction is strictly prohibited.';

        if ($this->_isForecast()) {
            $content .= ' ====================================== This report does not constitute a recommendation to purchase or sell any security and the analysts are not registered investment advisors. Further analysis is recommended before undertaking any position in any security. Any risks are solely the responsibility of the buyer/seller. The authors, publishers and distributors of the MT Newswires Live Briefs service and any associates thereof accept no liability for the content or actions taken by anyone or institution utilizing this report.';
        }

        $xml->addChild('Copyright', $content);
        return true;
    }

    /**
     * @return int
     */
    protected function _isForecast()
    {
        return count(array_intersect($this->_getTickersValue(true), [
            'BTBR', 'ITMS', 'ITML', 'ERNB', 'ITMF'
        ]));
    }

    protected function _getDate()
    {
        return Carbon::parse($this->_news->release_date)
            ->setTimezone('EST5EDT')
            ->addHour(4);
    }
}