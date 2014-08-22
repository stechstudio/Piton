<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Short description for file
 *
 * PHP version 5.4
 *
 * LICENSE: The MIT License
 *
 * @category   Logging
 * @author     Original Author <bubba@stechstudio.com>
 * @copyright  2014 Signature Tech Studio, Inc.
 * @license    http://opensource.org/licenses/MIT  MIT License
 * @link       https://github.com/stechstudio/piton
 * @since      File available since Release 1.0.0
 */

namespace Piton\Common;

use Piton\Exceptions;

/**
 * Describes log levels
 */
class LoggerLevel
{
    const OFF = -2147483647; // Logging is turned Off
    const OFF_STR = 'OFF';

    const FATAL = -1; // Identical to Emergency
    const FATAL_STR = 'FATAL';

    const EMERGENCY = 0; // System is unusable
    const EMERGENCY_STR = 'EMERGENCY';

    const ALERT = 100; // Action Must be Taken Immediately
    const ALERT_STR = 'ALERT';

    const CRITICAL = 200; // Critical Conditions
    const CRITICAL_STR = 'CRITICAL';

    const ERROR = 300; // Error Conditions
    const ERROR_STR = 'ERROR';

    const WARNING = 400; // Warning Conditions
    const WARNING_STR = 'WARNING';

    const NOTICE = 500; // Normal, but significant conditions
    const NOTICE_STR = 'NOTICE';

    const INFO = 600; // Informational messages
    const INFO_STR = 'INFO';

    const DEBUG = 700; // Debug Level Messages
    const DEBUG_STR = 'DEBUG';

    const TRACE = 800; // Trace Level Messages
    const TRACE_STR = 'TRACE';

    const ALL = 2147483647; // Every Possible Log Level
    const ALL_STR = 'ALL';


    /**
     * Contains a list of instantiated levels.
     * @var array
     */
    private static $levelMap;

    /**
     * Have we initialized the levelMap yet?
     * @var bool
     */
    private static $initializedMap = false;

    /** String representation of the level.
     * @var string
     */
    private $levelStr;

    /** Integer level value.
     * @var int
     */
    private $level;

    /**
     * Whether we need to do the mappting or not
     * @var bool
     */
    private static $doMapping = true;

    /**
     * Find a level by either integer or string
     * @param mixed $level
     * @return LoggerLevel
     * @throws \Piton\Exceptions\InvalidArgumentException
     */
    public static function findLevel($level)
    {
        self::initLevelMap();

        if (is_int($level)) {
            if (array_key_exists($level, self::$levelMap)) {
                return self::$levelMap[$level];
            } else {
                throw new Exceptions\InvalidArgumentException("The numeric value [$level] can not be mapped to a valid level.");
            }
        } elseif (is_string($level)) {
            $level = strtoupper($level);
            foreach (self::$levelMap as $oLevel) {
                /**
                 * @var LoggerLevel $oLevel
                 */
                if ($oLevel->toString() === $level) {
                    return $oLevel;
                }
            }
            throw new Exceptions\InvalidArgumentException("The string value [$level] can not be mapped with to a valid level.");
        } else {
            throw new Exceptions\InvalidArgumentException("The level parameter is neither a string nor an integer, you must pass in one or the other.");
        }
    }


    /**
     * Get one of the standard logging levels by name.
     * @param $name
     * @return LoggerLevel
     * @throws \Piton\Exceptions\InvalidArgumentException
     */
    public static function getStandardLevelByName($name)
    {
        if (!is_string($name)) {
            throw new Exceptions\InvalidArgumentException("The name parameter is not a string, you must pass in a string.");
        }

        // Because we all ways use all upper constants for Standard
        $name = strtoupper($name);

        // Ensure this is defined as a standard
        if (!defined('self::' . $name)) {
            throw new Exceptions\InvalidArgumentException("$name is not one of the standard integer levels defined in this class.");
        }
        /**
         * This should never evaluate to an exception, because the evaluation above should catch it.
         * But someone, somewhere, will jack it up.
         */
        if (!defined('self::' . $name . '_STR')) {
            // @codeCoverageIgnoreStart
            throw new Exceptions\InvalidArgumentException("{$name}_STR is not one of the standard string levels defined in this class.");
            // @codeCoverageIgnoreEnd
        }

        return self::checkMap(constant('self::' . $name), constant('self::' . $name . '_STR'));
    }

    /**
     * Compares two logger levels.
     *
     * @param $level
     * @return boolean
     */
    public function equals($level)
    {
        if (!$level instanceof LoggerLevel) {
            $level = self::findLevel($level);
        }

        return (bool)($this->toInt() == $level->toInt());
    }

    /**
     * Returns <i>true</i> if this level has a higher or equal
     * level than the level passed as argument, <i>false</i>
     * otherwise.
     *
     * @param $level
     * @return boolean
     */
    public function isGreaterOrEqual($level)
    {
        if (!$level instanceof LoggerLevel) {
            $level = self::findLevel($level);
        }
        return (bool)($this->toInt() >= $level->toInt());
    }

    /**
     * Returns <i>true</i> if this level has a less or equal
     * level than the level passed as argument, <i>false</i>
     * otherwise.
     *
     * @param $level
     * @return boolean
     */
    public function isLessThanOrEqual($level)
    {
        if (!$level instanceof LoggerLevel) {
            $level = self::findLevel($level);
        }
        //print "{$this->level} >= {$level->level}\n";
        return (bool)($this->toInt() <= $level->toInt());
    }

    /**
     * Returns the string representation of this level.
     * @return string
     */
    public function toString()
    {
        return $this->levelStr;
    }

    /**
     * Returns the string representation of this level.
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }

    /**
     * Returns the integer representation of this level.
     * @return integer
     */
    public function toInt()
    {
        return (int)$this->level;
    }

    /**
     * Create a custom log level
     * @param $level
     * @param $levelStr
     * @return LoggerLevel
     * @throws \Piton\Exceptions\InvalidArgumentException
     */
    public static function custom($level, $levelStr)
    {
        if (!is_int($level)) {
            throw new Exceptions\InvalidArgumentException("The level parameter is not an integer, you must pass in an integer.");
        }

        if (!is_string($levelStr)) {
            throw new Exceptions\InvalidArgumentException("The levelStr parameter is not an string, you must pass in a string.");
        }
        return self::checkMap($level, strtoupper($levelStr));
    }

    /**
     * Our constructor, you can use common levels, or pass is some custom stuff!
     * @param $level
     * @param $levelStr
     * @throws \Piton\Exceptions\InvalidArgumentException
     */
    private function __construct($level, $levelStr)
    {

        /**
         * Logically, these two argument checks are redundant, and should never
         * evaluate to an exception. However, I'm convinced someone will take that
         * as a challenge to eventually overcome.
         */
        if (!is_int($level)) {
            // @codeCoverageIgnoreStart
            throw new Exceptions\InvalidArgumentException("The level parameter is not an integer, you must pass in an integer.");
            // @codeCoverageIgnoreEnd
        }

        if (!is_string($levelStr)) {
            // @codeCoverageIgnoreStart
            throw new Exceptions\InvalidArgumentException("The levelStr parameter is not an string, you must pass in a string.");
            // @codeCoverageIgnoreEnd
        }

        // set our level
        $this->level = $level;
        $this->levelStr = $levelStr;
        return $this;
    }

    /**
     * Initializes the level map with the standard level
     * constants defined in the class.
     */
    private static function initLevelMap()
    {
        if (self::$initializedMap) {
            return;
        }
        self::$doMapping = false;
        $oClass = new \ReflectionClass (__CLASS__);
        $constants = $oClass->getConstants();
        foreach ($constants as $constant => $value) {
            if (is_int($value) && array_key_exists($constant . '_STR', $constants)) {
                self::$levelMap[$value] = new LoggerLevel($value, $constants[$constant . '_STR']);
            }
        }
        self::$initializedMap = true;
    }


    /**
     * Checks the levelMap for the level, if it isn't there,
     * we construct the level, then put it in there. Finally,
     * return the level object.
     *
     * @param integer $level
     * @param string $levelStr
     * @throws \Piton\Exceptions\InvalidArgumentException
     * @return LoggerLevel
     */
    private static function checkMap($level, $levelStr)
    {
        if (!is_int($level)) {
            // @codeCoverageIgnoreStart
            throw new Exceptions\InvalidArgumentException("The level parameter is not an integer, you must pass in an integer.");
            // @codeCoverageIgnoreEnd
        }

        if (!is_string($levelStr)) {
            // @codeCoverageIgnoreStart
            throw new Exceptions\InvalidArgumentException("The levelStr parameter is not an string, you must pass in a string.");
            // @codeCoverageIgnoreEnd
        }
        self::initLevelMap();
        if (!isset(self::$levelMap[$level])) {
            self::$levelMap[$level] = new LoggerLevel($level, $levelStr);
        }
        return self::$levelMap[$level];
    }
}