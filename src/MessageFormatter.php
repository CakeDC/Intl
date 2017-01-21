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


class MessageFormatter
{
    private $locale = 'en_US';
    private $pattern;

    public function __construct($locale, $pattern)
    {
        $this->locale = $locale;
        $this->pattern = $pattern;
    }
    public static function formatMessage($locale, $pattern, array $args)
    {
        if($locale != 'en_US')
        {
            trigger_error('This library currently supports English.', E_USER_ERROR);
        }


        if (stripos($pattern, 'number,')) {
        $x = explode('}', $pattern, 2);
            $pattern = '0' . $x[1];
            $args[0] = number_format($args[0], 2);
        }

        $count = count($args) -1;
        $i = 0;

        do {
            $pattern = str_replace("{$count}", $args[$i], $pattern);
        }
        while ($i > $count);
        return  $pattern;
    }
}