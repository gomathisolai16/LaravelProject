<?php
/**
 * Created by PhpStorm.
 * User: Var Yan
 * Date: 17.06.2017
 * Time: 13:52
 */

namespace App\Additional\Controllers;

use App\Events\ImageAttachedToNews;
use App\Models\Image;
use App\Models\News;
use App\Services\RoleService;

/**
 * Trait NewAdditional
 * @package App\Additional\Controllers
 */
trait NewAdditional
{
    /**
     * @var bool $__attachOnly
     */
    private static $__attachOnly = false;
    /**
     * @var bool $__toggleReturn
     */
    private static $__toggleReturn = true;

    /**
     * @param $moduleId
     */
    public function byModuleId($moduleId)
    {
        $this->_indexChecks();
        $this->_initFiltersRelations();

        $this->_addScopeToModel('byModuleId', $moduleId);
        $this->_addScopeToModel('withParkedStatus', null);

        $results = $this->_model
            ->skip((($this->_page - 1) * $this->_perRequest) + $this->_startFrom)
            ->take($this->_perRequest)
            ->get();

        return $this->_responseService
            ->format($this->_format)
            ->multiple(null, count($results), $results, $this->_for);
    }

    /**
     * @return void
     */
    public static function attachOnly()
    {
        self::$__attachOnly = true;
    }

    /**
     * @return void
     */
    public static function notToggleReturn()
    {
        self::$__toggleReturn = false;
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function toggleParked($id)
    {
        $new = $this->_model->find($id);

        if (!$new) {
            throw new \Exception(trans('exception.recordNotFound', ['item' => 'News', 'id' => $id]));
        }

        $message = $this->_model->toggleParked($id)
            ? "New $new->title parked successfully"
            : "New $new->title unParked successfully";

        return $this->_responseService->single($new, 'new', $message);
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function toggleEditor($id)
    {
        RoleService::checkRoles(['admin', 'advanced-user']);
        $news = $this->_model->find($id);
        if (!$news) {
            throw new \Exception(trans('exception.recordNotFound', ['item' => 'News', 'id' => $id]));
        }

        $status = $news->show_in_editor = !(boolean)$news->show_in_editor;
        $news->save();

        $message = !$status
            ? "News $news->title removed from editor successfully"
            : "News $news->title added to editor successfully";

        return $this->_responseService->single($news, 'news', $message);
    }

    /**
     * @param int $id
     * @throws \Exception
     */
    public function toggleImages($id)
    {
        $this->_validate();

        $imagesIds = [];

        if (request()->filled('image_ides')) {
            $imagesIds = json_decode(request('image_ides'));
            if (json_last_error()) {
                throw new \Exception("image ids should be in JSON format");
            }
        }

        if (!count($imagesIds)) {
            throw new \Exception("Can not attach");
        }

        $new = News::find($id);
        $method = $new->images()->count() ? (self::$__attachOnly ? "attach" : "detach") : "attach";
        $new->images()->{$method}(Image::whereIn('id', (array)$imagesIds)->get());

        if ($method === 'attach') {
            event(new ImageAttachedToNews($new));
            $message = 'Images attached to news successfully';
        } else {
            $message = "Images detached from news successfully";
        }

        if (self::$__toggleReturn) {
            return $this->_responseService->single($new, 'new', $message);
        }
    }

    /**
     * @return void
     */
    protected function _validate()
    {
        $this->validate(request(), [
            'image_ides' => 'required'
        ]);
    }
}