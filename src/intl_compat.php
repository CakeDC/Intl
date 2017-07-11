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
    class_alias('CakeDC\Intl\IntlCalendar', 'IntlCalendar');
    class_alias('CakeDC\Intl\IntlGregorianCalendar', 'IntlGregorianCalendar');
    define('INTL_ICU_VERSION', "4.8.1.1");
    define('INTL_ICU_DATA_VERSION', "4.8.1");
    /**x
     * (PHP 5 &gt;= 5.3.0, PECL intl &gt;= 1.0.0)<br/>
     * Create a date formatter
     * @link http://php.net/manual/en/intldateformatter.create.php
     * @param string $locale <p>
     * Locale to use when formatting or parsing.
     * </p>
     * @param int $datetype <p>
     * Date type to use (<b>none</b>,
     * <b>short</b>, <b>medium</b>,
     * <b>long</b>, <b>full</b>).
     * This is one of the
     * IntlDateFormatter constants.
     * </p>
     * @param int $timetype <p>
     * Time type to use (<b>none</b>,
     * <b>short</b>, <b>medium</b>,
     * <b>long</b>, <b>full</b>).
     * This is one of the
     * IntlDateFormatter constants.
     * </p>
     * @param string $timezone [optional] <p>
     * Time zone ID, default is system default.
     * </p>
     * @param int $calendar [optional] <p>
     * Calendar to use for formatting or parsing; default is Gregorian.
     * This is one of the
     * IntlDateFormatter calendar constants.
     * </p>
     * @param string $pattern [optional] <p>
     * Optional pattern to use when formatting or parsing.
     * Possible patterns are documented at http://userguide.icu-project.org/formatparse/datetime.
     * </p>
     * @return IntlDateFormatter
     */
    function datefmt_create($locale, $datetype, $timetype, $timezone = null, $calendar = null, $pattern = null)
    {
        return new IntlDateFormatter($locale, $datetype, $timetype, $timezone, $calendar, $pattern);

    }
}