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
    class_alias('CakeDC\Intl\Transliterator', 'Transliterator');
    define('INTL_ICU_VERSION', "4.8.1.1");
    define('INTL_ICU_DATA_VERSION', "4.8.1");
    /**x
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

    /**
     * Transliterate a string
     * @link http://php.net/manual/en/transliterator.transliterate.php
     * @param Transliterator|string $transliterator
     * @param string $subject <p>
     * The string to be transformed.
     * </p>
     * @param int $start [optional] <p>
     * The start index (in UTF-16 code units) from which the string will start
     * to be transformed, inclusive. Indexing starts at 0. The text before will
     * be left as is.
     * </p>
     * @param int $end [optional] <p>
     * The end index (in UTF-16 code units) until which the string will be
     * transformed, exclusive. Indexing starts at 0. The text after will be
     * left as is.
     * </p>
     * @return string The transfomed string on success, or <b>FALSE</b> on failure.
     */
    function transliterator_transliterate($transliterator, $subject, $start = null, $end = null)
    {
        if (is_a($transliterator, 'Transliterator')) {
            return $transliterator->transliterate($subject, $start, $end);
        } else {
            $fmt = Transliterator::create($transliterator);
            return $fmt->transliterate($transliterator, $subject);
        }
    }
}