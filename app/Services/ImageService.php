<?php


namespace App\Services;


use App\Helpers\StorageHelper;
use Illuminate\Http\UploadedFile;

/**
 * Class ImageService
 * @package App\Http\Services
 */
class ImageService
{
    /**
     * @param UploadedFile $image
     *
     * @return array
     */
    public static function upload(UploadedFile $image, $path) : string
    {
        return StorageHelper::uploadFile($image, $path, false);
    }
}
