<?php

namespace App\Helpers;

use Carbon\Carbon;

/**
 * Class StrHelper
 *
 * @package App\Helpers
 */
abstract class StrHelper
{
    /**
     * Rebuild folder name to lower case and change space on underline
     *
     * @param $text
     * @return mixed
     */
    public static function rebuildFolderFormat(string $text) :string
    {
        return str_replace(' ', '_', mb_strtolower(trim($text)));
    }

    /**
     * Rebuild date format
     *
     * @param array $data
     * @return array
     */
    public static function rebuildDateRangeFormat(array $data) :array
    {
        $range = [];
        foreach ($data as $key => $value) {
            $range[$key] = Carbon::parse($value)->toDateString();
        }
        return $range;
    }
}