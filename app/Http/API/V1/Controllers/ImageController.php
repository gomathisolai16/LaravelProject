<?php
/**
 * Created by PhpStorm.
 * User: Var Yan
 * Date: 17.06.2017
 * Time: 13:02
 */

namespace App\Http\API\V1\Controllers;

use App\Http\API\V1\Requests\ImageRequest;
use App\Http\Controllers\ApiController;
use App\Models\Image;
use App\Services\ImageService;
use App\Services\ModelService;
use App\Services\PathService;
use App\Services\RoleService;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Mockery\Exception;

/**
 * Class ImageController
 * @package App\Http\API\V1\Controllers
 */
class ImageController extends ApiController
{
    /**
     * @var string $_for
     */
    protected $_for = "images";
    /**
     * @var string $_modelClass
     */
    protected $_modelClass = Image::class;
    /**
     * @var string $_requestClass
     */
    protected $_requestClass = ImageRequest::class;

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index()
    {
        RoleService::checkPermissions('read-images');
        return parent::index();
    }

    /**
     * Add default filter to images request
     * @return void
     */
    protected function _additionalFilters()
    {
        $order = request()->filled('order') ? request('order') : 'desc';
        $this->_addScopeToModel('order', $order);
        $this->_addScopeToModel('deleted');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store()
    {
        RoleService::checkPermissions('create-images');
        $this->_checkRequest();
        $data = $this->_request->get('base64');

        if (!is_null($data) && preg_match('/data:image\/(jpg|jpeg|png);base64,(.*)/i', $data, $matches)) {
            $imageType = $matches[1];
            $imageData = base64_decode($matches[2]);
            $path = PathService::forEnv()->getPublic('public/img/news/');
            $filename = uniqid() . "." . $imageType;

            $saveFileName = public_path('img/news/') . $filename;

            if (file_put_contents($saveFileName, $imageData)) {
                $this->_validateImage($saveFileName);
                $this->__collectData($this->__makeImages($path, $filename));
                $this->__save();
            }

        } elseif (request()->filled('path')) {
            $path = $this->__resolvePath(request('path'));
            $this->__collectData([
                'original' => $path,
                'medium' => str_replace("original", "medium", $path),
                'small' => str_replace("original", "small", $path),
            ]);
            $this->__save();
        } else {
            throw new \Exception(trans('exception.invalidBase64'));
        }

        // remove cache if model is instanceof ICachable interface
        ModelService::removeCacheIfExists();

        return $this->_responseService
            ->format($this->_format)
            ->withStatus($this->_status)
            ->single($this->_data, $this->_for, $this->_message);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function update($id)
    {
        $this->destroy($id);
        return $this->store();
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        RoleService::checkPermissions('delete-images');
        $image = $this->_model->find($id);
        if (!$image) {
            throw new Exception(trans("exception.itemNotFound", ['item' => 'Image', 'id' => $id]));
        }
        ImageService::deleteAllSizes($image);
        $pieces = explode('/', $image->path);
        $this->__deleteRelatedImages(end($pieces));

        // remove cache if model is instanceof ICachable interface
        ModelService::removeCacheIfExists();

        return $this->_responseService
            ->format($this->_format)
            ->withStatus($this->_status)
            ->single($image, 'image', trans('message.deleted', ['item' => 'Image', 'id' => $id]));
    }

    /**
     * @param $fileName
     * @throws \Exception
     */
    protected function _validateImage($fileName)
    {
        $image = \Img::make($fileName);
        $sizeInKB = (int)($image->fileSize() / 1024);

        $message = $this->validateImage($sizeInKB, $image);

        if (!empty($message)) {
            @unlink($fileName);
            throw new \Exception($message);
        }
    }

    /**
     * @param $sizeInKB
     * @param $image
     * @return string
     */
    protected function validateImage($sizeInKB, $image)
    {
        $message = '';

        if ($sizeInKB < config('image.minSize')) {
            $message = trans('message.image.minSize', ['size' => config('image.minSize')]);
        } elseif ($sizeInKB > config('image.maxSize')) {
            $message = trans('message.image.maxSize', ['size' => config('image.maxSize')]);
        } elseif ($image->width() < config('image.minWidth')){
            $message = trans('message.image.minWidth', ['width' => config('image.minWidth')]);
        } elseif ($image->height() < config('image.minHeight')){
            $message = trans('message.image.minHeight', ['height' => config('image.minHeight')]);
        } elseif ($image->height() > config('image.maxHeight')){
            $message = trans('message.image.maxHeight', ['height' => config('image.maxHeight')]);
        } elseif ($image->width() > config('image.maxWidth')){
            $message = trans('message.image.maxWidth', ['width' => config('image.maxWidth')]);
        }

        return $message;
    }

    /**
     * Create thumbnails for image
     *
     * @param string $path
     * @param string $filename
     * @return array
     */
    private function __makeImages($path, $filename)
    {
        $localPath = public_path('img/news/');
        $img = \Img::make($localPath . $filename);

        $small = clone $img;
        $medium = clone $img;

        // resize the image to a width of 470 and constrain aspect ratio (auto height)
        $medium->resize(470, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $this->_saveUnlink($localPath, $path, 'medium/' . $filename, $medium);

        // resize the image to a width of 154 and constrain aspect ratio (auto height)
        $small->resize(154, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $this->_saveUnlink($localPath, $path, 'small/' . $filename, $small);

        if ($img->width() > 1024) {
            // resize the image to a width of 640 and constrain aspect ratio (auto height)
            $img->resize(1024, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        $this->_saveUnlink($localPath, $path, $filename, $img);

        return [
            'original' => '/img/news/' . $filename,
            'medium' => '/img/news/' . $filename,
            'small' => '/img/news/' . $filename,
        ];
    }

    /**
     * Prepare data to insert into database
     *
     * @param array $images
     * @return void
     */
    private function __collectData($images)
    {
        $timestamp = Carbon::now()->toDateTimeString();
        $title = request()->get('title');
        $author = '';

        $this->_data = [
            [
                'path' => $images['small'],
                'title' => $title,
                'size' => 'small',
                'author' => $author,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'path' => $images['medium'],
                'title' => $title,
                'size' => 'medium',
                'author' => $author,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'path' => $images['original'],
                'title' => $title,
                'size' => 'original',
                'author' => $author,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
        ];
    }

    /**
     * @param string $fileName
     */
    private function __deleteRelatedImages($fileName)
    {
        $service = PathService::forEnv();
        $path = $service->getPublic('public/img/news/');
        if ($this->_model->original($path)->count() == 1) {
            if ($service->has($path)) {
                $service->delete($path . $fileName, $path . "medium/$fileName", $path . "small/$fileName");
            }
        }
    }

    /**
     * @param string $path
     * @return string
     */
    private function __resolvePath($path)
    {
        $image = $this->_model->original($path)->first();
        return $image ? $image->path : $path;
    }

    /**
     * @throws \Exception
     */
    private function __save()
    {
        $saved = $this->_model->insert($this->_data);

        if (!$saved) {
            throw new \Exception(trans('exception.canNotSave', ['item' => $this->_getSingleItemKey()]));
        }

        if (request()->filled('new_id')) {
            ImageService::connectImagesToSingleNew(request()->get('new_id'));
        }
    }

    /**
     * @param string $localPath
     * @param string $path
     * @param string $filename
     * @param $imageObject
     */
    private function _saveUnlink($localPath, $path, $filename, $imageObject)
    {
        $pathService = PathService::forEnv();
        $imageObject->save($localPath . $filename);
        $contents = file_get_contents($localPath . $filename);
        $pathService->put('public/img/news/' . $filename, $contents, 'public');
        if (!App::environment('local')) {
            unlink($localPath . $filename);
        }
    }
}