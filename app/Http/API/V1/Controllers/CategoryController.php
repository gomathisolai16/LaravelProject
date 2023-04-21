<?php

namespace App\Http\API\V1\Controllers;

use App\Http\API\V1\Requests\CategoryRequest;
use App\Http\Controllers\ApiController;
use App\Models\Category;
use App\Models\Keyword;
use App\Models\Setting;
use App\Models\Subscription;
use App\Services\RoleService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class CategoryController
 * @package App\Http\API\V1\Controllers
 */
class CategoryController extends ApiController
{
    /**
     * @var string $_for
     */
    protected $_for = "categories";

    /**
     * @var string $_modelClass
     */
    protected $_modelClass = Category::class;

    /**
     * @var string $_requestClass
     */
    protected $_requestClass = CategoryRequest::class;

    /**
     * Will return tree of categories as response
     *
     * @param Category $category
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function tree(Category $category, $id = 0)
    {
        $this->_initFiltersRelations();
        $allResults = $this->_model->get();
        return $this->_responseService->single($category->getTree($allResults, $id), 'categories');
    }

    /**
     * Override store method of parent class
     * Make additional changes and return parent store method
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store()
    {
        $this->_checkRequest();
        RoleService::checkRoles('admin');
        $this->__commonData();
        if (request()->filled('category_id')) {
            $category = Category::find(request()->get('category_id'));
            if ($category) {
                $this->_data['category_id'] = request()->get('category_id');
            } else {
                throw new \Exception(trans('message.categoryNotFound', ['id' => request()->get('category_id')]));
            }

        }
        $itemName = $this->_getSingleItemKey();

        $this->_message = trans('message.saved', ['item' => ucfirst($itemName)]);
        $storedItem = $this->_model->create($this->_data);

        if (!$storedItem) {
            throw new \Exception(trans('exception.canNotSave', ['item' => $itemName]));
        }
        if (request()->filled('keywords')) {
            $keywords = request()->get('keywords');
            $keywordIds = [];
            foreach ($keywords as $keyword) {
                $keywordModel = Keyword::get($keyword);
                if (!$keywordModel) {
                    $keywordModel = Keyword::add($keyword);
                }
                $keywordIds[] = $keywordModel->id;
            }
            $storedItem->assignKeywords($keywordIds, true);
        }
        return $this->_responseService
            ->withStatus($this->_status)
            ->single(Category::with('keywords')->where('id', $storedItem->id)->get(), $itemName, $this->_message);
    }

    /**
     *
     * Update category by id and request data
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function update($id)
    {
        RoleService::checkRoles('admin');
        // Check existence of category to update
        $category = Category::find($id);
        if (!$category) {
            throw new \Exception(trans('message.categoryNotFound', ['id' => $id]));
        }

        $this->_checkRequest();
        $this->__commonData();

        if (request()->filled('category_id')) {
            $parentCategory = Category::find(request()->get('category_id'));
            if ($parentCategory) {
                $this->_data['category_id'] = request()->get('category_id');
            } else {
                throw new \Exception(trans('message.categoryNotFound', ['id' => request()->get('category_id')]));
            }
        }

        if (request()->filled('keywords')) {
            $keywords = request()->get('keywords');
            $keywordIds = [];
            foreach ($keywords as $keyword) {
                $keywordModel = Keyword::get($keyword);
                if (!$keywordModel) {
                    $keywordModel = Keyword::add($keyword);
                }
                $keywordIds[] = $keywordModel->id;
            }
            $category->assignKeywords($keywordIds, true);
        }
        return parent::update($id);
    }


    /**
     * Gets the categories that the user is not subscribed for.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNotSubscribed()
    {
        $categories = [];
        if (!Auth::user()->hasRole('admin')) {
            $subscriptions = Setting::where(['user_id' => Auth::user()->id, 'key' => 'subscriptions'])->first();
            $subScriptionArray = json_decode($subscriptions->value);
            $subscription = null;
            foreach ($subScriptionArray as $key => $val) {
                $subscription = Subscription::where('abbreviation', $val)->first();
            }
            $ids = $subscription ? Subscription::getSubscriptionsHierarchyBySubscription($subscription) : [];
            $categories = DB::table('categories')
                ->whereNotIn('subscription_id', $ids)
                ->orWhere('subscription_id', null)
                ->get();
        }

        $itemName = $this->_getSingleItemKey();
        return $this->_responseService
            ->withStatus($this->_status)
            ->single($categories, $itemName, $this->_message);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        RoleService::checkRoles('admin');
        return parent::destroy($id);
    }

    /**
     * Change ordering of categories based on 'sort_order' column
     * 
     * @param int $initCatId
     * @param int $destCatId
     * @return  \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function order($initCatId, $destCatId) {
        // Check if required URL parameters are provided 
        if ($initCatId === $destCatId) {
            throw new \InvalidArgumentException(
                "To perform ordering please provide different IDs for category to move and the destination one"
            );
        }
        $categories = Category::find([$initCatId, $destCatId])->sortBy('sort_order', 1);
        $categoriesArray = [];
        foreach($categories as $categoryInstance) {
            $categoriesArray[] = $categoryInstance;
        }
        // Retrieve records from the database to prove their existence
        $requiredFoundCategories = array_map(function($record) {
            return $record->id;
        }, $categoriesArray);
        // Check if have a missing record from the database and throw error if needed
        $missingRecord = array_reduce([$initCatId, $destCatId], function($missing, $recordId) use ($requiredFoundCategories) {
            if ($missing) {
                return $missing;
            }
            if (!in_array($recordId, $requiredFoundCategories)) {
                return $recordId;
            }
            return $missing;
        }, null);
        if ($missingRecord) {
            throw new \Exception(trans('exception.recordNotFound', ['item' => ucfirst('category'), 'id' => $missingRecord]));
        }
        $jumpCategories = Category::whereBetween('sort_order', [
            $categoriesArray[0]->sort_order,
            $categoriesArray[1]->sort_order
        ])->orderBy('sort_order', 'asc')->get();
        $initRecordIndex = $categoriesArray[0]->id == $initCatId ? 0 : 1;
        foreach($jumpCategories as $category) {
            if ($category->id == $initCatId) {
                $category->sort_order = $categoriesArray[(int)!$initRecordIndex]->sort_order;
            } else {
                // In case we are trying to move category in a sort_order greater than actual value
                // we will mark it as 'asc' and we need to reduce sort_order for between records (vice versa)
                $asc = ($categoriesArray[(int)!$initRecordIndex]->sort_order - $categoriesArray[$initRecordIndex]->sort_order) > 0;
                $category->sort_order = $asc ? $category->sort_order - 1 : $category->sort_order + 1;
            }
            $category->save();
        }
        return $this->_responseService
            ->withStatus($this->_status)
            ->single(null, '', 'Order updated successfully');
    }

    /**
     * @throws \Exception
     */
    private function __commonData()
    {
        $this->_data = [
            'title' => request()->get('title'),
            'abbreviation' => request()->get('abbreviation'),
            'description' => request()->get('description'),
        ];

        if (!request()->filled('subscription_id')) {
            throw new \Exception(trans('message.subscriptionNotValid'));
        }

        $this->_data['subscription_id'] = request()->get('subscription_id');
    }
}
