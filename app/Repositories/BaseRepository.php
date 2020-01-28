<?php


namespace App\Repositories;

/**
 * Class BaseRepository
 * @package App\Repositories
 */
class BaseRepository
{
    /**
     * Joined folders
     *
     * @param $collection
     * @return object
     */
    protected function joiningPaths($collection) :object
    {
        return $collection->map(function ($model) {
            $model->image_folder = asset('storage') . '/' .$model->image_folder;
            return $model;
        });
    }

}