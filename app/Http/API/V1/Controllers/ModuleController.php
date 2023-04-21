<?php

namespace App\Http\API\V1\Controllers;

use App\Http\API\V1\Requests\ModuleRequest;
use App\Http\Controllers\ApiController;
use App\Models\Module;
use App\Models\Subscription;
use App\Services\ModelService;
use App\Services\RoleService;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class ModuleController
 * @package App\Http\API\V1\Controllers
 */
class ModuleController extends ApiController
{
    /**
     * @var string $_for
     */
    protected $_for = "modules";

    /**
     * @var string $_modelClass
     */
    protected $_modelClass = Module::class;

    /**
     * @var string $_requestClass
     */
    protected $_requestClass = ModuleRequest::class;

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function show($id)
    {
        $this->_initFiltersRelations();

        if(method_exists($this,'_additionalFilters')){
            $this->_additionalFilters();
        }

        $object = $this->_model->find($id);
        if (!$object) {
            throw new \Exception(trans('exception.recordNotFound', [
                'item' => ucfirst($this->_getSingleItemKey()),
                'id' => $id
            ]));
        }

        return $this->_responseService
            ->format($this->_format)
            ->single($object, $this->_getSingleItemKey());
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
        $module = Module::lastBySort()->first();
        $this->__commonData();
        // if module already exists then throw exception
        $this->__checkUnique();

        $width = request()->filled('width') ? request()->get('width') : 1;
        $height = request()->filled('height') ? request()->get('height') : 1;
        $options = [];
        if (!request()->filled('name')) {
            throw new \Exception(trans('message.attrNotFound', ['item' => "name"]));
        }
        if (!request()->filled('dashboard_id')) {
            throw new \Exception(trans('message.attrNotFound', ['item' => "dashboard_id"]));
        }

        if (request()->filled('subscription_id')) {
            $this->_data['subscription_id'] = request()->get('subscription_id');
        } else {
            $this->_data['subscription_id'] = null;
        }

        $this->_checkRequest();
        $dashboard_id = request()->get('dashboard_id');
        if (!request()->filled('pos_x')) {
            throw new \Exception(trans('message.attrNotFound', ['item' => "pos_x"]));
        }
        if (!request()->filled('pos_y')) {
            throw new \Exception(trans('message.attrNotFound', ['item' => "pos_y"]));
        }
        if (!request()->filled('abbreviation')) {
            $this->_data['abbreviation'] = join('-', explode(' ', strtolower(request('name'))));
        }
        $options['width'] = $width;
        $options['height'] = $height;
        $options['pos_x'] = request()->get('pos_x');
        $options['pos_y'] = request()->get('pos_y');
        // In case 'watch_list' is provided we will include on new record
        if (array_key_exists('watch_list', request()->all())) {
            $this->_data['watch_list'] = request()->get('watch_list');
        }
        // In case 'strict' is provided we will include on new record
        if (array_key_exists('strict', request()->all())) {
            $this->_data['strict'] = (int)request()->get('strict');
        }
        $this->_data['name'] = request()->get('name');
        if (Auth::user()->hasRole('admin')) {
            $this->_data['preset'] = Module::PRESET_ACTIVE;
        }

        $this->_data = array_merge($this->_data,[
            'user_id' => Auth::id(),
            'sort_order' => ++$module->sort_order
        ]);
        $itemName = $this->_getSingleItemKey();


        $storedItem = $this->_model->create($this->_data);

        $storedItem->addToDashboard($dashboard_id, $options);

        $notification = new NotificationService();
        //$notification_response = $notification->getRequest('MODULES');
        //$notification_response = $notification->getRequest('DASHBOARDS');

        if (request()->filled('categories')) {
            $categories = request()->get('categories');
            $categories = Auth::user()->filterCategoriesBySubscription($categories);
            $storedItem->assignCategories($categories);
        }
        if (!$storedItem) {
            throw new \Exception(trans('exception.canNotSave', ['item' => $itemName]));
        }

        // remove cache if model is instanceof ICachable interface
        ModelService::removeCacheIfExists();

        return $this->_responseService
            ->withStatus($this->_status)
            ->single(
                Module::with('categories')->where('id',$storedItem->id)->get(),
                $itemName, trans('message.saved', [
                    'item' => 'Module'
                ])
            );
    }



    /**
     * Override update method of parent class
     * Make additional changes and return parent update method
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function update($id)
    {
        $module = Module::findOrFail($id);
        $this->__commonData();
        $this->_addScopeToModel('owner',true);

        if ((request()->filled('pos_x') || request()->filled('pos_y')) && !request()->filled('dashboard_id')) {
            throw new \Exception(trans('message.attrNotFound', ['item' => "dashboard_id"]));
        }
        if (request()->filled('subscription_id')) {
            $subscription = Subscription::find(request()->get('subscription_id'));
            if (!$subscription) {
                throw new \Exception(trans('exception.recordNotFound', ['item' => 'subscription', 'id' => request()->get('subscription_id')]));
            }
            if (!$module->subscription_id || $module->subscription_id == null) {
                $this->_data['subscription_id'] = request()->get('subscription_id');
            }
        }
        if (request()->filled('name')) {
            $this->_data['name'] = request()->get('name');
        } else {
            $this->_data['name'] = $module->name;
        }
        // In case 'watch_list' is provided we will update on the database
        if (array_key_exists('watch_list', request()->all())) {
            $this->_data['watch_list'] = request()->get('watch_list');
        }
        // In case 'strict' is provided we will update on the database
        if (array_key_exists('strict', request()->all())) {
            $this->_data['strict'] = (int)request()->get('strict');
        }
        $options = $this->_getDashboardDetails();
        $dashboard_id = request()->get('dashboard_id');
        $this->_checkRequest();
        if ($options) {
            $module->updateInDashboard($dashboard_id, $options);
        }
        $categories = request()->get('categories');
        $categories = Auth::user()->filterCategoriesBySubscription($categories);
        $module->assignCategories($categories,true);

        $notification = new NotificationService();
        //$notification_response = $notification->getRequest('MODULES');
        //$notification_response = $notification->getRequest('DASHBOARDS');

        return parent::update($id);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateCoordinates($id)
    {
        $module = Module::findOrFail($id);
        $this->_addScopeToModel('owner',true);
        $options = $this->_getDashboardDetails();
        if (!request()->filled('dashboard_id')) {
            throw new \Exception(trans('message.attrNotFound', ['item' => "dashboard_id"]));
        }
        if ($options) {
            $dashboard_id = request()->get('dashboard_id');
            $module->updateInDashboard($dashboard_id, $options);

            // remove cache if model is instanceof ICachable interface
            ModelService::removeCacheIfExists();

            $notification = new NotificationService();
            //$notification_response = $notification->getRequest('MODULES');
            //$notification_response = $notification->getRequest('DASHBOARDS');

            return $this->_responseService
                ->withStatus($this->_status)
                ->single($module->dashboards);
        }
        throw new \Exception(trans('message.attrNotFound', ['item' => "width, height, pos_x, pos_y"]));
    }


    /**
     * @return array
     */
    public function _getDashboardDetails()
    {
        $options = [];
        if (request()->filled('pos_x')) {
            $posX = request()->get('pos_x');
            $options['pos_x'] = $posX;
        }
        if (request()->filled('pos_y')) {
            $posY = request()->get('pos_y');
            $options['pos_y'] = $posY;
        }

        if (request()->filled('width')) {
            $width = request()->get('width');
            $options['width'] = $width;
        }

        if (request()->filled('height')){
            $height = request()->get('height');
            $options['height'] = $height;
        }
        return $options;
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
        $this->_addScopeToModel('owner',true);

        $notification = new NotificationService();
        //$notification_response = $notification->getRequest('MODULES');
        //$notification_response = $notification->getRequest('DASHBOARDS');

        return parent::destroy($id);
    }

    /**
     * Add common fields to object _data property
     *
     * @return void
     */
    private function __commonData()
    {
        $this->_data = [
            'public' => request()->filled('public') ? (boolean)request()->get('public') : true,
            'active' => request()->filled('active') ? (boolean)request()->get('active') : true,
        ];
    }

    /**
     * @throws \Exception
     */
    private function __checkUnique(){
        // if module with request name exists for user then throw exception
        if($this->_model->isUnique(Auth::id(), request()->get('name'), request('dashboard_id'))){
            throw new \Exception(trans('exception.unique', [
                'item' => ucfirst($this->_getSingleItemKey($this->_for)),
                'field' => 'name',
                'key' => request()->get('name')
            ]));
        }
    }
}
