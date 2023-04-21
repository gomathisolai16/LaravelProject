<?php

namespace App\Http\Controllers;

use App\Schemes\Models\ICachable;
use App\Services\ModelService;
use App\Services\ResponseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

/**
 * Class ApiController
 * @package App\Http\Controllers
 */
abstract class ApiController extends Controller
{
    /**
     * @var int $_status
     */
    protected $_status = 200;
    /**
     * @var string
     */
    protected $_format = 'json';
    /**
     * @var string $_message
     */
    protected $_message = '';
    /**
     * @var array $_data
     */
    protected $_data = [];
    /**
     * Store model name for current request
     * Need to be defined inside child class dynamic
     *
     * @required
     * @var string $_modelClass
     */
    protected $_modelClass;
    /**
     * Store request name for current request
     * Need to be defined inside child class dynamic
     *
     * @required
     * @var string $_requestClass
     */
    protected $_requestClass;
    /**
     * Store model object for current request
     * Will initialize automatically depended on _modelClass property
     *
     * @var Model $_model
     */
    protected $_model;
    /**
     * Store request object for current request
     * Will initialize automatically depended on _requestClass property
     *
     * @var Request $_request
     */
    protected $_request;
    /**
     * Define main key (string) for response by default for single response key will be (item) and (items) for multiple
     * Need to be defined inside child class dynamic
     *
     * @optional
     * @var string $_for
     */
    protected $_for;
    /**
     * Store pagination page for current request
     * Need to be set via $_GET['page'] parameter  example (http://APP_DOMAIN/api/users?page=2)
     *
     * @optional for first page
     * @var int $_page
     */
    protected $_page = 1;
    /**
     * Store number of rows to be returned by default value is 25
     *
     * @optional
     * @var int $_perRequest
     */
    protected $_perRequest = 25;

    protected $disableTotal = false;

    /**
     * Store offset modifier per request
     * if request has startFrom then and if startFrom=7
     * then for page=1 offset will be 7 and if perRequest is 10
     * model will get results from pos 7. So 7 - 16
     *
     * @optional
     * @var int $_startFrom
     */
    protected $_startFrom = 0;
    /**
     * Store ResponseService class instance
     * Will initialize automatically
     *
     * @var ResponseService $_responseService
     */
    protected $_responseService;

    /**
     * APIController constructor.
     * @param ResponseService $responseService
     */
    public function __construct(ResponseService $responseService)
    {
        $this->_responseService = $responseService;
        $this->_format = request()->filled('format') ? request()->get('format') : 'json';
        $this->__initModel();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // check request PATH parameters for this method only
        $this->_indexChecks();

        // check filters and relations for results we are going to get
        $this->_initFiltersRelations();

        // if we need additional filters to attach to the query then we can define it in child controller
        if (method_exists($this, '_additionalFilters')) {
            $this->_additionalFilters();
        }
        // get total count of results that API going to send as response
        if (!$this->disableTotal) {
            if ($this->_modelClass === 'App\Models\Ticker') {
                $total = count($this->_model->get());
            } else {
                $total = ModelService::total($this->_model);
            }
        } else {
            $total = 0;
        }

        // get results by pagination to avoid have loading
        $results = $this->_model
            ->offset((($this->_page - 1) * $this->_perRequest) + $this->_startFrom)
            ->limit($this->_perRequest);

        $results = ModelService::getResults($results);

        $count = count($results);

        // recall model total method if exists on group by statements
        if (!$this->disableTotal && $count > $total && method_exists(ModelService::$model, 'total')) {
            $total = ModelService::$model->total();
        }

        return $this->_responseService
            ->format($this->_format)
            ->multiple(
                $total,
                $count,
                $results,
                $this->_for
            );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store()
    {
        // get for parameter of controller to use it as response key
        $itemName = $this->_getSingleItemKey();
        // this method will check validation for specific request
        $this->_checkRequest();

        // prepare message for success response
        $this->_message = trans('message.saved', ['item' => ucfirst($itemName)]);
        $storedItem = $this->_model->create($this->_data);

        if (!$storedItem) {
            throw new \Exception(trans('exception.canNotSave', ['item' => $itemName]));
        }

        // remove cache if model is instanceof ICachable interface
        ModelService::removeCacheIfExists();

        return $this->_responseService
            ->format($this->_format)
            ->withStatus($this->_status)
            ->single($storedItem, $itemName, $this->_message);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function show($id)
    {
        $this->_initFiltersRelations();

        if (method_exists($this, '_additionalFilters')) {
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
     * Update the specified resource in storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function update($id)
    {
        $this->_checkRequest();
        $itemName = $this->_getSingleItemKey();
        $item = $this->_model->find($id);

        if (!$item) {
            throw new \Exception(trans('exception.recordNotFound', ['item' => ucfirst($itemName), 'id' => $id]));
        }

        if (!count($this->_data)) {
            $this->_data = request()->all();
        }

        $this->_message = trans('message.updated', [
            'item' => ucfirst($itemName),
            'id' => $id
        ]);

        $updatedItem = $item->update($this->_data);

        if (!$updatedItem) {
            throw new \Exception(trans('exception.canNotUpdate', [
                'item' => ucfirst($itemName),
                'id' => $id
            ]));
        }

        // remove cache if model is instanceof ICachable interface
        ModelService::removeCacheIfExists();

        return $this->_responseService
            ->format($this->_format)
            ->withStatus($this->_status)
            ->single($item, $itemName, $this->_message);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $itemName = $this->_getSingleItemKey();
        $item = $this->_model->find($id);

        if (!$item) {
            throw new \Exception(trans('exception.recordNotFound', [
                'item' => ucfirst($itemName),
                'id' => $id
            ]));
        }

        $this->_message = ucfirst($itemName) . " has been deleted";
        $deletedItem = $item->delete();

        if (!$deletedItem) {
            throw new \Exception(trans('exception.canNotDelete', [
                'item' => ucfirst($itemName),
                'id' => $id
            ]));
        }

        // remove cache if model is instanceof ICachable interface
        ModelService::removeCacheIfExists();

        return $this->_responseService
            ->format($this->_format)
            ->withStatus($this->_status)
            ->single($item, $itemName, $this->_message);
    }

    /**
     * Will check and initialize Model
     * @throws \Exception
     * @return void
     */
    private function __initModel()
    {
        if (!class_exists($this->_modelClass)) {
            throw new \Exception(trans('exception.modelNotFound', ['model' => $this->_modelClass]));
        }

        $this->_model = App::make($this->_modelClass);
        ModelService::$model = $this->_model;
    }

    /**
     * @param string $name
     * @param mixed $param
     * @return void
     */
    protected function _addScopeToModel($name, $param = null)
    {
        $this->_model =  $this->_model->{$name}($param);
    }

    /**
     * Will check and run Request
     * @throws \Exception
     * @return void
     */
    protected function _checkRequest()
    {
        if (!class_exists($this->_requestClass)) {
            throw new \Exception(trans('exception.requestNotFound', ['request' => $this->_requestClass]));
        }

        $this->_request = App::make($this->_requestClass);
    }

    /**
     * Will set Request required filters and relations
     *
     * @return void
     */
    protected function _initFiltersRelations()
    {
        // detect fields request want to get
        $this->_model = ModelService::applyFields($this->_model);
        // detect additional filters like order
        $this->_model = ModelService::applyAdditionalFilters($this->_model);
        // detect relations to attach to response result
        $this->_model = ModelService::applyRelations($this->_model);
        // detect model scopes
        $this->_model = ModelService::applyFilters($this->_model);
    }

    /**
     * Will check pagination parameters
     *
     * @return void
     */
    protected function _indexChecks()
    {
        $request = request();

        // detect results per request if exists
        if ($request->filled('perRequest')) {
            $this->_perRequest = $request->get('perRequest');
        }

        // detect pagination page if exists
        if ($request->filled('page')) {
            $this->_page = $request->get('page');
        }

        // detect offset start position
        if ($request->filled('startFrom')) {
            $this->_startFrom = $request->get('startFrom');
        }

        // detect offset start position
        if ($request->filled('disableTotal')) {
            $this->disableTotal = $request->get('disableTotal');
        }
    }

    /**
     * Change key to singular
     *
     * @return string
     */
    protected function _getSingleItemKey()
    {
        if(in_array($this->_for, ['news'])){
            return $this->_for;
        }

        $substring = substr($this->_for, strlen($this->_for) - 4);
        if (strpos($substring, 'ies') !== false) {
            return substr($this->_for, 0, -3) . "y";
        }
        return substr($this->_for, 0, -1);
    }
}
