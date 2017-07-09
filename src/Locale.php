<?php
/**
 * Copyright 2017, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2017, Cake Development Corporation (http://cakedc.com)
 * @link https://www.cakedc.com
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
namespace CakeDC\Intl;


class Locale
{
    public static function getDefault()
    {
        return 'en_US';
    }

    public static function parseLocale($locale)
    {
        if ($locale == null) {
            return array('language' => 'en');
        }
        if($locale != 'en_US')
        {
            trigger_error('This library currently supports English.', E_USER_ERROR);
        }

        return array('language' => 'en');
    }
}