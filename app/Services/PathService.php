<?php
/**
 * Created by PhpStorm.
 * User: Var Yan
 * Date: 06.11.2017
 * Time: 21:22
 */

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Cache;

/**
 * Class PathService
 * @package App\Services
 */
class PathService
{
    const CACHE_IMAGE_NAME = 's3Image{:fileName}';
    const CACHE_IMAGE_TYPE = 's3Image{:fileName}Type';

    /**
     * @var FilesystemAdapter
     */
    private static $_path;
    /**
     * @var string $_drive
     */
    private static $_drive;

    /**
     * @param string|null $env
     * @return PathService
     */
    public static function forEnv($env = null)
    {
        if (null === $env) {
            $env = env('APP_ENV', 'local');
        }

        self::$_drive = $env === 'local' ? 'local-public' : 's3';
        self::$_path = \Storage::disk(self::$_drive);

        return new self();
    }

    /**
     * @return FilesystemAdapter
     */
    public static function getPath()
    {
        return self::$_path;
    }

    /**
     * @param string $pathName
     * @return bool
     */
    public static function pathExists($pathName)
    {
        return self::$_path->exists($pathName);
    }

    /**
     * @param string|null $addPath
     * @return string
     */
    public function getPublic($addPath = null)
    {
        if (null !== $addPath) {
            $path = str_replace('/', DIRECTORY_SEPARATOR, $addPath);
        }

        return self::$_path->path($path);
    }

    /**
     * @param string $pathToTheFile
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getUrl($pathToTheFile)
    {
        return self::$_drive === 's3' ? 'https://s3.amazonaws.com/' .
            self::$_path->getDriver()->getAdapter()->getBucket() . '/public' .
            $pathToTheFile : url($pathToTheFile);
    }

    /**
     * @param $filename
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getResponse($filename)
    {
        $key = self::getCacheImageKey($filename);
        $typeKey = self::getCacheImageTypeKey($filename);

        if (!Cache::has($key)) {

            $path = $this->getPublic("public/img/news/$filename");

            if (!self::$_path->has($path)) {
                abort(404);
            }

            $storage = self::$_path;

            $seconds = Carbon::now()->addSeconds(600);

            // cache images from s3 for next 10 minutes
            Cache::add($key, $storage->get($path), $seconds);
            Cache::add($typeKey, $storage->mimeType($path), $seconds);
        }

        $response = \Response::make(Cache::get($key), 200);
        $response->header("Content-Type", Cache::get($typeKey));

        return $response;
    }

    /**
     * @param string $fileName
     * @return string
     */
    public static function getCacheImageKey($fileName)
    {
        return str_replace('{:fileName}', $fileName, PathService::CACHE_IMAGE_NAME);
    }

    /**
     * @param string $fileName
     * @return string
     */
    public static function getCacheImageTypeKey($fileName)
    {
        return str_replace('{:fileName}', $fileName, PathService::CACHE_IMAGE_TYPE);
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array([self::$_path, $name], $arguments);
    }
}