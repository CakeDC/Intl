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
if (!extension_loaded('intl')) {
    class_alias('CakeDC\Intl\MessageFormatter', 'MessageFormatter');
    class_alias('CakeDC\Intl\IntlDateFormatter', 'IntlDateFormatter');
    class_alias('CakeDC\Intl\Locale', 'Locale');
    class_alias('CakeDC\Intl\NumberFormatter', 'NumberFormatter');
}