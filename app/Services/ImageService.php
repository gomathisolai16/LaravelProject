<?php
/**
 * Created by PhpStorm.
 * User: Var Yan
 * Date: 22.07.2017
 * Time: 00:24
 */

namespace App\Services;

use App\Models\Image;
use App\Models\News;

/**
 * Class ImageService
 * @package App\Services
 */
class ImageService
{
    /**
     * @param int $newId
     * @throws \Exception
     */
    public static function connectImagesToSingleNew($newId)
    {
        $images = Image::lastByLimit()->get();
        News::find($newId)->images()->attach($images);
    }

    /**
     * @param array $images
     * @param int $newsId
     * @throws \Exception
     */
    public static function insertImagesAndAttachToNews($images, $newsId) {
        $saved = Image::insert($images);
        if (!$saved) {
            throw new \Exception(trans('exception.canNotSave', ['item' => 'Images']));
        }
        self::connectImagesToSingleNew($newsId);
    }

    /**
     * @param Image $image
     * @param bool $smooth
     * @throws \Exception
     */
    public static function deleteAllSizes(Image $image, $smooth = true)
    {
        $imageId = $image->id;
        $shouldBeRemovedIdes = [$imageId];

        if ($image->size == 'original') {
            $shouldBeRemovedIdes = array_merge($shouldBeRemovedIdes, [$imageId + 1, $imageId + 2]);
        } elseif ($image->size == 'small') {
            $shouldBeRemovedIdes = array_merge($shouldBeRemovedIdes, [$imageId - 1, $imageId + 1]);
        } else {
            $shouldBeRemovedIdes = array_merge($shouldBeRemovedIdes, [$imageId + 1, $imageId + 2]);
        }

        $state = Image::whereIn('id', $shouldBeRemovedIdes);

        true === $smooth
            ? $state->update(['deleted' => true])
            : $state->delete();
    }
}