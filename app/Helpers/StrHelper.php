<?php

namespace App\Helpers;

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
}