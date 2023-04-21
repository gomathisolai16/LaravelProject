<?php

namespace App\Http\API\V1\Controllers;

use App\Additional\Controllers\NewAdditional;
use App\Http\API\V1\Requests\NewsRequest;
use App\Http\Controllers\ApiController;
use App\Models\News;
use App\Models\Setting;
use App\Services\EmailAlertService;
use App\Services\ModelService;
use App\Services\NewsService;
use App\Services\RoleService;
use App\Services\SettingService;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

/**
 * Class NewsController
 * @package App\Http\API\V1\Controllers
 */
class NewsController extends ApiController
{
    use NewAdditional;
    /**
     * @var string $_for
     */
    protected $_for = "news";

    /**
     * @var string $_modelClass
     */
    protected $_modelClass = News::class;

    /**
     * @var string $_requestClass
     */
    protected $_requestClass = NewsRequest::class;

    /**
     * Override store method of parent class
     * Make additional changes and return parent store method
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        RoleService::checkRoles('admin');

        $insertData = request()->filled('news')
            // get bulk insert data
            ? $this->_getData()
            // get single insert data
            : $this->_getSingleData();

        $inserted = $this->_model->insert($insertData['news']);

        if ($inserted && count($insertData['categories'])) {
            $inserted = $this->_model->storeBulkRelation('category', $insertData['categories']);
        }

        if ($inserted && count($insertData['tickers'])) {
            $inserted = $this->_model->storeBulkRelation('ticker', $insertData['tickers']);
        }

        return response()->json([
            'success' => (boolean)$inserted,
            'message' => $inserted ? "Saved successfully" : "Unable to insert news"
        ]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id)
    {
        RoleService::checkRoles('admin');
        $this->_data = $this->__getCommonData();

        if (request()->filled('meta_keywords')) {
            $this->_data['meta_keywords'] = json_encode(request()->get('meta_keywords'));
        }

        $result = parent::update($id);
        self::attachOnly();
        self::notToggleReturn();
        $this->toggleImages($id);

        return $result;
    }

    /**
     * Override destroy method of parent class
     * Make additional changes and return parent destroy method
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        RoleService::checkRoles('admin');
        return parent::destroy($id);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function tickers()
    {
        $list = [];
        $news = News::getTickerUpdates();

        foreach ($news as $item) {
            if (!$this->in_array_r($item->abbreviation, $list)) {
                $list[] = [
                    "id" => $item->id,
                    "ticker" => $item->abbreviation,
                    "time" => $item->created_at
                ];
            }

        }

        return $this->_responseService
            ->withStatus($this->_status)
            ->single($list, 'tickers', $this->_message);

    }

    /**
     * @param $needle
     * @param $haystack
     * @param bool $strict
     * @return bool
     */
    public function in_array_r($needle, $haystack, $strict = false)
    {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_r($needle, $item, $strict))) {
                return true;
            }
        }
        return false;
    }

    /**
     * Will be called by parent index method
     */
    protected function _additionalFilters()
    {
        $keywords = array_filter(explode(',', trim(request()->get('keywords') ?? '',',')) ?? []);
        if (count($keywords)) {
            $this->_model = $this->_model->keywords($keywords);
        }

        $tickers = array_filter(explode(',', trim(request()->get('tickers') ?? '',',')) ?? []);
        if (count($tickers)) {
            $this->_model = $this->_model->tickers($tickers, request()->filled('isStrict'));
        }

        $categories = array_filter(explode(',', trim(request()->get('categories') ?? '',',')) ?? []);
        if (count($categories)) {
            $ides = Auth::user()->filterCategoriesBySubscription($categories);
            $this->_model = $this->_model->categories($ides, null, !request()->filled('isWatchList'));
        }

        // sims this line not needed because before scope withSubscriptionLevel changed select to *
        $this->_addScopeToModel('withParkedStatus');
        $this->_addScopeToModel('subscribeLevel');
    }

    /**
     * @return array
     */
    protected function _getData()
    {
        $lastNewId = $this->_model->resolveAndGetLastId();
        $news = request()->get('news');
        $recordsCount = sizeof($news);
        $categories = $tickers = [];

        for ($j = 0; $j < $recordsCount; $j++) {

            NewsService::validate($news[$j]);
            $this->_data[$j] = $this->__getCommonData($news[$j]);

            // find ids of categories based on there abbreviations
            $categories[] = NewsService::getCategoriesByAbbrToInsert(
                @$news[$j]['categories'],
                $lastNewId
            );

            // find ids of tickers based on there abbreviations
            $tickers[] = NewsService::getTickersByAbbrToInsert(
                @$news[$j]['tickers'],
                $lastNewId
            );
        }

        return [
            'categories' => $categories,
            'tickers' => $tickers,
            'news' => $this->_data
        ];
    }

    /**
     * @return array
     * @throws \Exception
     */
    protected function _getSingleData()
    {
        $this->_checkRequest();
        $lastNewId = $this->_model->resolveAndGetLastId();
        $insertData = [];
        $insertData['news'] = $this->__getCommonData();

        // find ids of categories based on there abbreviations
        $insertData['categories'][] = NewsService::getCategoriesByAbbrToInsert(
            request()->get('categories'),
            $lastNewId
        );

        // find ids of tickers based on there abbreviations
        $insertData['tickers'][] = NewsService::getTickersByAbbrToInsert(
            request()->get('tickers'),
            $lastNewId
        );

        return $insertData;
    }

    /**
     * Add common fields to object _data property
     * @param array $data
     * @return array
     */
    private function __getCommonData($data = [])
    {
        if (!count($data)) {
            $data = request()->all();
        }

        return [
            'title' => $data['title'],
            'description' => $data['description'],
            'meta_keywords' => json_encode(@$data['meta_keywords']),
            'percentage' => $data['percentage'],
            'active' => (boolean)@$data['active'],
            'top' => (boolean)@$data['top'],
            'created_at' => !empty($data['created_at'])
                ? $data['created_at']
                : Carbon::now()->toDateTimeString(),
            'updated_at' => !empty($data['updated_at'])
                ? $data['updated_at']
                : Carbon::now()->toDateTimeString(),
        ];
    }

}
