<?php

namespace App\Http\API\V1\Controllers;

use App\Http\API\V1\Requests\DashboardRequest;
use App\Http\Controllers\ApiController;
use App\Models\Category;
use App\Models\Dashboard;
use App\Models\Image;
use App\Models\Module;
use App\Models\News;
use App\Models\Subscription;
use App\Models\Video;
use App\Services\ModelService;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;

/**
 * Class DashboardController
 * @package App\Http\API\V1\Controllers
 */
class DashboardController extends ApiController
{
    /**
     * @var string $_for
     */
    protected $_for = 'dashboards';

    /**
     * @var string $_modelClass
     */
    protected $_modelClass = Dashboard::class;

    /**
     * @var string $_requestClass
     */
    protected $_requestClass = DashboardRequest::class;

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $result = parent::index();

        $request = request();
        if($result->original['count'] == 0 || empty($result->original['dashboards']) || !$request->filled('with')) {
            return $result;
        }

        $relations = explode('|', $request->get('with'));
        if(empty($relations) || !in_array('modules', $relations)) return $result;

        // Search for Top News and Video News modules
        $modArray = [];
        $topNewsCat = null;
        $dashboards = $result->original["dashboards"];
        $allModuleIds = [];
        foreach ($dashboards as $dashboard) {
            /** @var \App\Models\Dashboard $dashboard */

            /** @var \App\Models\Module[] $modules */
            $modules = $dashboard->modules;
            foreach ($modules as $module) {
                $allModuleIds[] = $module->id;
                $modArray[$module->id] = [
                    'categories' => [],
                    'videoCount' => 0
                ];
            }
        }

        if(!empty($modArray)) {
            sort($allModuleIds);

            $categories = app(Category::class)->getByModulesIds($allModuleIds);

            if(!empty($categories)){
                foreach ($categories as $item) {
                    $modArray[$item->module_id]['categories'][] = $item->category_id;
                    if (Category::isTopNewsCategory($item->abbreviation)) {
                        $topNewsCat = $item->category_id;
                    }
                    if (Category::isVideosNewsCategory($item->abbreviation)) {
                        $modArray[$item->module_id]['videoCount']++;
                    }
                }
            }
        }

        foreach ($dashboards as $dashboard) {
            /** @var \App\Models\Dashboard $dashboard */

            /** @var \App\Models\Module[] $modules */
            $modules = $dashboard->modules;
            foreach ($modules as $module) {
                // Module will be marked as 'Top News' only in cases if it has just one category that belongs to 'Top News'
                $topNewsModule = (int)(
                    !is_null($topNewsCat) &&
                    count($modArray[$module->id]['categories']) == 1 &&
                    $modArray[$module->id]['categories'][0] == $topNewsCat
                );
                // Module will be marked as 'Video News' in cases it has at least one video category
                $videoNewsModule = (int)((bool)$modArray[$module->id]['videoCount']);
                $module->isTopNews = $topNewsModule;
                $module->isVideoNews = $videoNewsModule;
            }
        }

        return $this->_responseService
            ->format($this->_format)
            ->multiple(
                $result->original['total'],
                $result->original['count'],
                $dashboards,
                $this->_for
            );
    }


    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function show($id)
    {
        $result = parent::show($id);

        $request = request();

        if(!$result->original['success'] || empty($result->original['dashboard']) || !$request->filled('with')) {
            return $result;
        }

        $relations = explode('|', $request->get('with'));
        if(empty($relations) || !in_array('modules', $relations)) return $result;

        // Search for Top News and Video News modules
        $modArray = [];
        $topNewsCat = null;

        /** @var \App\Models\Dashboard $dashboard */
        $dashboard = $result->original["dashboard"];

        /** @var \App\Models\Module[] $modules */
        $modules = $dashboard->modules;
        $allModuleIds = [];
        // modules always will be array because it is belongs to many relation
        foreach ($modules as $module) {
            $allModuleIds[] = $module->id;
            $modArray[$module->id] = [
                'categories' => [],
                'videoCount' => 0
            ];
        }

        if(!empty($modArray)) {
            sort($allModuleIds);

            $categories = app(Category::class)->getByModulesIds($allModuleIds);

            if(!empty($categories)){
                foreach ($categories as $item) {
                    $modArray[$item->module_id]['categories'][] = $item->category_id;
                    if(Category::isTopNewsCategory($item->abbreviation)) {
                        $topNewsCat = $item->category_id;
                    }
                    if (Category::isVideosNewsCategory($item->abbreviation)) {
                        $modArray[$item->module_id]['videoCount']++;
                    }
                }
            }
        }

        foreach ($modules as $module) {
            // Module will be marked as 'Top News' only in cases if it has just one category that belongs to 'Top News'
            $topNewsModule = (int)(
                !is_null($topNewsCat) &&
                count($modArray[$module->id]['categories']) == 1 &&
                $modArray[$module->id]['categories'][0] == $topNewsCat
            );
            // Module will be marked as 'Video News' in cases it has at least one video category
            $videoNewsModule = (int)((bool)$modArray[$module->id]['videoCount']);
            $module->isTopNews = $topNewsModule;
            $module->isVideoNews = $videoNewsModule;
        }

        return $this->_responseService
            ->format($this->_format)
            ->single($dashboard, $this->_getSingleItemKey());
    }

    /**
     * Override store method of parent class
     * Make additional changes and return parent store method
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function store()
    {
        $this->__commonData();

        // if dashboard with request name exists for user then throw exception
        if ($this->_model->isUnique(Auth::id(), request()->get('name'))) {
            throw new \Exception(trans('exception.unique', [
                'item' => ucfirst($this->_getSingleItemKey($this->_for)),
                'field' => 'name',
                'key' => request()->get('name')
            ]));
        }

        $this->_data['user_id'] = Auth::id();
        $this->_data['public'] = request()->filled('public') ? request()->get('public') : 1;
        if (Auth::user()->hasRole('admin')) {
            $this->_data['preset'] = Dashboard::PRESET_ACTIVE;
        }

        if (!request()->filled('abbreviation')) {
            $this->_data['abbreviation'] = join('-', explode(' ', strtolower(request('name'))));
        }

        if (request()->filled('subscription_id')) {
            $this->_data['subscription_id'] = request()->get('subscription_id');
        } else {
            $this->_data['subscription_id'] = null;
        }

        $itemName = $this->_getSingleItemKey();
        $this->_checkRequest();

        $this->_message = trans('message.saved', ['item' => ucfirst($itemName)]);
        $storedItem = $this->_model->create($this->_data);

        if (request()->filled('modules')) {
            $modules = request()->get('modules');
            $data = $this->_extractModules($modules);
            $storedItem->assignModules($data, true);
        }

        $notification = new NotificationService();
        //$notification_response = $notification->getRequest('MODULES');
        //$notification_response = $notification->getRequest('DASHBOARDS');

        if (!$storedItem) {
            throw new \Exception(trans('exception.canNotSave', ['item' => $itemName]));
        }
        Auth::user()->updateDashboardList($storedItem->id, true);

        // remove cache if model is instanceof ICachable interface
        ModelService::removeCacheIfExists();

        return $this->_responseService
            ->withStatus($this->_status)
            ->single(Dashboard::with('modules')->where('id', $storedItem->id)->get(), $itemName, $this->_message);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateActiveModules($id)
    {
        $width = request()->filled('width') ? request()->get('width') : 1;
        $height = request()->filled('height') ? request()->get('height') : 1;
        $dashboard = Dashboard::findOrFail($id);
        $this->_addScopeToModel('owner', true);
        if (!request()->filled('module_id')) {
            throw new \Exception(trans('message.attrNotFound', ['item' => "module_id"]));
        }
        if (!request()->filled('status')) {
            throw new \Exception(trans('message.attrNotFound', ['item' => "status"]));
        }
        if (!request()->filled('pos_x')) {
            throw new \Exception(trans('message.attrNotFound', ['item' => "pos_x"]));
        }
        if (!request()->filled('pos_y')) {
            throw new \Exception(trans('message.attrNotFound', ['item' => "pos_y"]));
        }

        $status = request()->get('status');
        $module_id = request()->get('module_id');
        $options = [];
        if ($status) {
            $options['pos_x'] = request()->get('pos_x');
            $options['pos_y'] = request()->get('pos_y');
            $options['width'] = $width;
            $options['height'] = $height;
            $dashboard->attachModule($module_id, $options);
        } else {
            $dashboard->detachModule($module_id);
        }

        $notification = new NotificationService();
        //$notification_response = $notification->getRequest('MODULES');
        //$notification_response = $notification->getRequest('DASHBOARDS');

        // remove cache if model is instanceof ICachable interface
        ModelService::removeCacheIfExists();

        return $this->_responseService
            ->withStatus($this->_status)
            ->single($dashboard->modules);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getActiveDashboards()
    {
        $activeDashboards = Auth::user()->filterActiveDashboards();

        return $this->_responseService
            ->withStatus($this->_status)
            ->multiple(sizeof($activeDashboards), sizeof($activeDashboards), $activeDashboards, 'dashboards');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function updateActiveList($id)
    {
        $this->_addScopeToModel('owner', true);
        if (!request()->filled('status')) {
            throw new \Exception(trans('message.attrNotFound', ['item' => "status"]));
        }
        $status = request()->get('status');
        if ($status) {
            Auth::user()->updateDashboardList($id, true);
        } else {
            Auth::user()->updateDashboardList($id);
        }
        $activeDashboards = Auth::user()->filterActiveDashboards();

        // remove cache if model is instanceof ICachable interface
        ModelService::removeCacheIfExists();

        return $this->_responseService
            ->withStatus($this->_status)
            ->multiple(sizeof($activeDashboards), sizeof($activeDashboards), $activeDashboards, 'dashboards');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update($id)
    {
        $dashboard = Dashboard::findOrFail($id);
        if (!request()->filled('name')) {
            throw new \Exception(trans('message.attrNotFound', ['item' => "name"]));
        }
        if (request()->filled('active')) {
            $this->_data['active'] = request()->get('active');
        }
        if (request()->filled('subscription_id')) {
            $subscription = Subscription::find(request()->get('subscription_id'));
            if (!$subscription) {
                throw new \Exception(trans('exception.recordNotFound', ['item' => 'subscription', 'id' => request()->get('subscription_id')]));
            }
            if (!$dashboard->subscription_id || $dashboard->subscription_id == null) {
                $this->_data['subscription_id'] = request()->get('subscription_id');
            }
        }
        $this->_data['name'] = request()->get('name');
        $this->_addScopeToModel('owner', true);
        $this->_data['public'] = request()->filled('public') ? request()->get('public') : 1;
        if (request()->filled('modules')) {
            $modules = request()->get('modules');
            $data = $this->_extractModules($modules);
            Dashboard::findOrFail($id)->assignModules($data, true);
        }

        $notification = new NotificationService();
        //$notification_response = $notification->getRequest('MODULES');
        //$notification_response = $notification->getRequest('DASHBOARDS');

        return parent::update($id);
    }

    /**
     * @param $modules
     * @return array
     * Extract the module json array and format it so we can send it for synchronization with the modules pivot table.
     */
    public function _extractModules($modules)
    {
        $data = [];
        foreach ($modules as $module) {
            $data[$module['module_id']] = [
                'pos_x' => $module['pos_x'],
                'pos_y' => $module['pos_y'],
            ];
            $data[$module['module_id']]['height'] = isset($module['height']) ? $module['height'] : 1;
            $data[$module['module_id']]['width'] = isset($module['width']) ? $module['width'] : 1;
        }
        return $data;
    }

    /**
     * Override destroy method of parent class
     * Make additional changes and return parent destroy method
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->_addScopeToModel('owner', true);

        $notification = new NotificationService();
        //$notification_response = $notification->getRequest('DASHBOARDS');

        return parent::destroy($id);
    }

    /**
     * request: /api/dashboard/1/news?order=desc&perRequest=20&page=1
     * @param $dashboardId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllNewsForDashboard($dashboardId)
    {
        $request = request();

        // detect filters or set defaults
        $limit = $request->get('perRequest', $this->_perRequest);
        $page = $request->get('page', $this->_page);
        $offset = ($page > 1) ? $limit * $page : 0;
        $orderType = $request->get('order', 'desc');

        $orderType = strtoupper($orderType);
        // check for correct order parameter
        if (!in_array($orderType, ['ASC', 'DESC'])) {
            throw new \InvalidArgumentException('Allowed values for order are asc|desc');
        }

        $result = [];
        $modules = [];
        $topNewsCat = null;

        // Get all modules for dashboard
        // TODO process parameters with=images|tickers

        $res = app(Module::class)->getByDashboardId($dashboardId);

        if(!empty($res)) {
            $allModuleIds = [];
            foreach ($res as $row) {
                $allModuleIds[] = $row->id;
                $modules[$row->id] = [
                    'watchList' => $row->watch_list, // will save ID reference of WL record
                    'categories' => [],
                    'videoCount' => 0,
                    'hasCryptoMetaCode' => false,
                ];
            }

            sort($allModuleIds);
            // Get categories for modules
            $categories = app(Category::class)->getByModulesIds($allModuleIds);

            if(!empty($categories)) {
                foreach ($categories as $item) {
                    $modules[$item->module_id]['categories'][] = $item->category_id;
                    if (Category::isTopNewsCategory($item->abbreviation)) {
                        $topNewsCat = $item->category_id;
                    }
                    if (Category::isVideosNewsCategory($item->abbreviation)) {
                        $modules[$item->module_id]['videoCount']++;
                    }
                    if (Category::isCryptoNewsCategory($item->abbreviation)) {
                        $modules[$item->module_id]['hasCryptoMetaCode'] = true;
                    }
                }
            }
        }

        $user = Auth::user();
        foreach ($modules as $modId => $module) {
            // Retrieve 'tickers' for specific WL record assigned to given module
            $watchList = !$module['watchList'] ? ['tickers' => []] : $user->watchListItemsIds($module['watchList']);
            if((empty($module['categories']) && !$module['watchList']) || ((empty($module['categories']) && empty($watchList['tickers'])))) {
                $result[] = [
                    'id' => $modId,
                    'isTopNews' => 0,
                    'isVideoNews' => 0,
                    'news' => []
                ];
                continue;
            }

            $newsModel = app(News::class);

            $newsModel = $newsModel->withParkedStatus()
                ->orderBy('news.release_date', $orderType)
                ->limit($limit, $offset);

            $newsModel = $newsModel->byModuleId($modId);

            // TODO: Validate additional load added from joining news model with provided relations
            // instead adding them only in cases of module being of "Top News" or "Video News" types
            // $relations = $request->filled('with') ? array_filter(explode('|', $request->get('with') ?? '')) : [];
            // if (!empty($relations)) {
            //     $newsModel = $newsModel->with($relations);
            // }
            // $news = $newsModel->orderBy('id','DESC')->get();

            $news = $newsModel->with(['tickers' => function ($query) {
                return $query->orderBy('id','DESC');
            }])->get();

            // Top news module
            $isTopNewsModule = (int)(
                !is_null($topNewsCat) &&
                count($module['categories']) == 1 &&
                $module['categories'][0] == $topNewsCat
            );
            $isVideoNewsModule = (int)((bool)$module['videoCount']);
            $isCryptoNewsModule = (bool)$module['hasCryptoMetaCode'];

            if (!empty($news)) {
                $moduleNewsIds = [];
                foreach ($news as $row) {
                    $moduleNewsIds[] = $row->id;
                }

                // Get images records for Top News module
                if ($isTopNewsModule || $isCryptoNewsModule) {
                    sort($moduleNewsIds);
                    // Get images for news
                    $images = app(Image::class)->getByNewsIds($moduleNewsIds);

                    if(!empty($images)) {
                        $tmp = array();
                        foreach ($images as $row) {
                            $row = (array)$row;
                            $id = $row['new_id'];
                            unset($row['new_id']);
                            $row['pivot'] = [
                                'new_id' => $id,
                                'image_id' => $row['id']
                            ];
                            $tmp[$id][] = $row;
                        }

                        foreach ($news as $row) {
                            if(!empty($tmp[$row->id])) {
                                $row->images = $tmp[$row->id];
                            }
                        }
                    }
                    unset($images, $tmp);
                }

                if ($isVideoNewsModule) {
                    // Get videos for news
                    $videos = app(Video::class)->getByNewsIds($moduleNewsIds);

                    if (!empty($videos)) {
                        $tmp = [];
                        foreach($videos as $video) {
                            $toArrayVideo = (array)$video;
                            $newsId = $toArrayVideo['news_id'];
                            unset($toArrayVideo['news_id']);
                            $toArrayVideo['pivot'] = [
                                'news_id' => $newsId,
                                'video_id' => $toArrayVideo['id']
                            ];
                            $tmp[$newsId][] =  $toArrayVideo;
                        }
                        foreach($news as $newsItem) {
                            if (!empty($tmp[$newsItem->id])) {
                                $newsItem->videos = $tmp[$newsItem->id];
                            }
                        }
                    }
                    unset($videos, $tmp);
                }
            }

            $result[] = [
                'id' => $modId,
                'isTopNews' => $isTopNewsModule,
                'isVideoNews' => $isVideoNewsModule,
                'news' => $news
            ];
        }

        $total = 0;
        $count = count($result);

        return $this->_responseService
            ->format($this->_format)
            ->multiple(
                $total,
                $count,
                $result,
                'modules'
            );
    }

    /**
     * Add common fields to object _data property
     *
     * @return void
     */
    private function __commonData()
    {
        $this->_data = [
            'name' => request()->get('name'),
            'active' => request()->filled('active') ? (boolean)request()->get('active') : true,
        ];
    }
}
