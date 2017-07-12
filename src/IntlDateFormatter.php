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

use CakeDC\intl\src\Utility\PatternParser;
use DateInterval;
use DateTime;
use Locale;

class IntlDateFormatter
{
    const FULL = 0;
    const LONG = 1;
    const MEDIUM = 2;
    const SHORT = 3;
    const NONE = -1;
    const GREGORIAN = 1;
    const TRADITIONAL = 0;

    private $locale = 'en';
    private $datetype;
    private $timetype;
    private $timezone;
    private $calendar;
    private $pattern;
    private $offest = ['operator' => '+', 'value' => ['h' => '0H', 'm' => '0M'], 'output' => null];

    public function __construct(
        $locale,
        $datetype = IntlDateFormatter::FULL,
        $timetype = IntlDateFormatter::FULL,
        $timezone = null,
        $calendar = IntlDateFormatter::GREGORIAN,
        $pattern = ''
    ) {
        $locale = Locale::parseLocale($locale);
        $this->locale = $locale['language'];
        $this->datetype = $datetype;
        $this->timetype = $timetype;
        $this->setTimeZone($timezone);
        $this->setCalendar($calendar);
        $this->setPattern($pattern);
    }

    public static function create($locale, $datetype, $timetype, $timezone = null, $calendar = null, $pattern = null)
    {
        return new IntlDateFormatter($locale, $datetype, $timetype, $timezone, $calendar, $pattern);
    }

    public function format($value)
    {
        date_default_timezone_set($this->getTimeZone());
        $datetime = new DateTime(date($this->pattern, $value));
        if ($this->offest['operator'] === '-') {
            $datetime->sub(new DateInterval('PT' . $this->offest['value']['h'] . $this->offest['value']['m']));
        } else {
            $datetime->add(new DateInterval('PT' . $this->offest['value']['h'] . $this->offest['value']['m']));
        }
        $return = $datetime->format($this->pattern);

        if (strpos($this->pattern, 'T')) {
            return preg_replace('~,(?!.*,)~', ' at', $return . $this->offest['output']);
        }
        return $return;

    }

    public function getTimeZone()
    {
        return $this->timezone;
    }

    public function setTimeZone($zone)
    {
        $time[0] = '0';
        $time[1] = '0';
        $oper = '';

        if (is_a($zone, 'DateTimeZone')) {
            $zone = $zone->getName();
        }

        if ($zone !== null) {
            $values = explode('+', $zone);
            $this->timezone = $values[0];

            if (strpos($zone, '+')) {
                $time = explode(':', $values[1]);
                $this->offest['output'] = '+' . $values[1];
            } else {
                if (strpos($zone, '-')) {
                    $values = explode('-', $zone);
                    $time = explode(':', $values[1]);
                    $this->offest['output'] = '-' . $values[1];
                }
            }

            $this->offest['operator'] = $oper;
            $this->offest['value']['h'] = $time[0] . 'H';

            $this->offest['value']['m'] = $time[1] . 'M';
        } else {
            $this->timezone = timezone_name_from_abbr(ini_get('date.timezone'));
        }
    }

    public function parse($value, &$position = null)
    {
        $DateTime = new DateTime($value);
        return $DateTime->getTimestamp();
    }

    public function getDateType()
    {
        return $this->datetype;
    }

    public function getTimeType()
    {
        return $this->timetype;
    }

    public function getCalendar()
    {
        return $this->calendar;
    }

    public function setCalendar($which)
    {
        $this->calendar = $which;
    }

    public function getLocale($which = null)
    {
        return $this->locale;
    }

    public function getPattern()
    {
        return $this->pattern;
    }

    public function setPattern($pattern)
    {
        if (!empty($pattern)) {
            $this->pattern = $pattern;
        } else {
            switch ($this->datetype) {
                case IntlDateFormatter::LONG:
                    $this->pattern = 'F j, Y';
                    break;
                case IntlDateFormatter::MEDIUM:
                    $this->pattern = 'M j, Y';
                    break;
                case IntlDateFormatter::SHORT:
                    $this->pattern = 'n/j/y';
                    break;
                default;
                    $this->pattern = 'l, F j, Y';
            }
            switch ($this->timetype) {
                case IntlDateFormatter::LONG:
                    $this->pattern .= ', g:i:s A T';
                    break;
                case IntlDateFormatter::MEDIUM:
                    $this->pattern .= ', g:i:s A';
                    break;
                case IntlDateFormatter::SHORT:
                    $this->pattern .= ' g:i A';
                    break;
                default;
                    $this->pattern .= ', g:i:s A T';
                    break;
            }
        }
    }


    protected function parsePattern($pattern)
    {
        $formater = new PatternParser($pattern);
        $formater->parse();
    }
}