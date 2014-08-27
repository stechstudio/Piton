<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 *
 * PHP version 5.4
 *
 * LICENSE: The MIT License
 *
 * @category   Logging
 * @package    Piton
 * @author     Original Author <bubba@stechstudio.com>
 * @copyright  2014 Signature Tech Studio, Inc.
 * @license    http://opensource.org/licenses/MIT  MIT License
 * @link       https://github.com/stechstudio/piton
 * @since      File available since Release 1.0.0
 */

namespace Piton;

use Piton\Common\Abstracts;
use Piton\Common\Interfaces\Appender;
use Piton\Common\LoggerLevel;
use Piton\Exceptions\InvalidArgumentException;

/**
 * This is the PSR-3 Logger Class. It allows for any number of appenders
 * and comes with a Null, Console, and SPlunkStorm appender built in.
 */
class Logger extends Abstracts\Logger
{
    /**
     * The Timestamp Format
     * @var string Any format accepted by date().
     */
    protected $timestampFormat = 'D M j G:i:s.u T Y';

    /**
     * The default log level for a new logger
     * @var string
     */
    protected $defaultLevel = LoggerLevel::INFO_STR;

    /**
     * Config for a default console Appender
     * @var array
     */
    protected $defaultAppender = ['console' => ['target' => 'STDOUT', 'class' => 'Piton\Appender\Console']];

    /**
     * Whether our log message should be prepended with a timestamp
     * @var bool    Defaults to FALSE
     */
    protected $useTimestamp = false;
    /**
     * Whether our log message should be prepended with a stanard message
     * @var bool Defaults to FALSE
     */
    protected $hasRequiredMessage = false;
    /**
     * A required message to prepend to log messages
     * @var string
     */
    protected $requiredMessage = '';
    /**
     * Whether we have a required context
     * @var bool Defaults to FALSE
     */
    protected $hasRequiredContext = false;
    /**
     * If we have a required context, this where we keep it.
     * @var array
     */
    protected $requiredContext;
    /**
     * This Loggers Level
     * @var LoggerLevel
     */
    private $level;
    /**
     * Appenders linked to this logger
     * @var array
     */
    private $appenders = array();

    /**
     * Timezone Identifier for out log timestamps. Defaults to UTC, and really,
     * truly, should never be modified! Thus saith Bubba!
     * @var string
     */
    protected $timezoneId = 'UTC';

    /**
     * The constructor, it takes an array of configuration information. And example
     * of instantiating three appenders might look like:
     *
     * ['logger' => ['level' => 'info'],
     *  'appenders' => [
     *      'console' => [
     *              'target' => 'STDOUT',
     *              'class'  => 'Piton\Appender\Console'
     *       ],
     *      'null'    => ['class'  => 'Piton\Appender\Null'],
     *      'splunk'  =>[
     *              'target' => 'api-fake.data.splunkstorm.com',
     *              'class'  => 'Piton\Appender\SplunkStorm',
     *              'context' => [
     *                 'SplunkStorm' => ['projectID'=>'SomeFakeProjectID',
     *                   'accessToken' => 'AnotherFakeAccessToken',
     *                   'apiVersion'  => 1,
     *                   'apiEndpoint' => 'inputs/http',
     *                   'urlScheme'   => 'https'
     *                  ]
     *               ]
     *       ],
     *  ]
     *
     * @param array $config
     */
    public function __construct(array $config = array())
    {
        $this->configure($config);
    }

    /**
     * Configures our Logger with the configuration array.
     * @param array $config
     */
    public function configure(array $config = array())
    {
        $this->setLevel(LoggerLevel::findLevel($this->defaultLevel));
        $appenders = $this->defaultAppender;

        if (array_key_exists('logger', $config)) {
            if (array_key_exists('level', $config['logger'])) {
                $this->setLevel(LoggerLevel::findLevel($config['logger']['level']));
            }
        }

        // Get the desired appenders, or use the default.
        if (array_key_exists('appenders', $config)) {
            $appenders = $config['appenders'];
        }

        $this->setAppenders($appenders);
    }

    /**
     * Utility function for the configuration to set up multiple appenders
     * @param array $appenders
     * @throws Exceptions\InvalidArgumentException
     */
    public function setAppenders(array $appenders)
    {
        if (empty($appenders)) {
            throw new InvalidArgumentException('You must provide an array of appender configurations.');
        }

        foreach ($appenders as $name => $config) {
            $target = '';
            $context = array();

            if (!is_array($config)) {
                throw new InvalidArgumentException('You must provide the config array for the Appender.');
            }

            if (!array_key_exists('class', $config)) {
                throw new InvalidArgumentException('You must provide the fully qualified class name for the appender.');
            }

            if (empty($config['class'])) {
                throw new InvalidArgumentException('You may not provide an empty class element.');
            }

            if (!class_exists($config['class'])) {
                throw new InvalidArgumentException(
                    "The class {$config['class']} hasn't been defined. Check your spelling, include paths, or autoloading."
                );
            }

            if (array_key_exists('target', $config)) {
                $target = $config['target'];
            }

            if (array_key_exists('context', $config)) {
                $context = $config['context'];
            }
            $this->addAppender(new $config['class']($name, $target, $context));
        }
    }

    /**
     * Add a new appender to the logger
     * @param Appender $appender
     */
    public function addAppender(Appender $appender)
    {
        $this->appenders[$appender->getName()] = $appender;
    }

    /**
     * How many appenders are configured?
     * @return int
     */
    public function appenderCount()
    {
        return count($this->appenders);
    }

    /**
     * Simple way to get a NULL logger
     * @return Logger
     */
    public static function defaultNullFactory()
    {
        return new self(['appenders' => ['null' => ['class' => 'Piton\Appender\Null']]]);
    }

    /**
     * Simple way to get a console logger
     * @return Logger
     */
    public static function defaultConsoleFactory()
    {
        return new self(
            [
                'appenders' => [
                    'console' => [
                        'target' => 'stdout',
                        'class' => 'Piton\Appender\Console'
                    ]
                ]
            ]
        );
    }

    /**
     * Remove an appender from the logger
     * @param $name
     * @throws Exceptions\InvalidArgumentException
     */
    public function removeAppender($name)
    {
        if (!is_string($name) || empty($name)) {
            throw new InvalidArgumentException('You must provide a valid string name for an appender');
        }
        if (array_key_exists($name, $this->appenders)) {
            unset($this->appenders[$name]);
        }
    }

    /**
     * Get an appender by name
     * @param $name
     * @throws Exceptions\InvalidArgumentException
     * @return Appender|bool
     */
    public function getAppender($name)
    {
        if (!is_string($name) || empty($name)) {
            throw new InvalidArgumentException('You must provide a valid string name for an appender');
        }
        if (array_key_exists($name, $this->appenders)) {
            return $this->appenders[$name];
        }
        return false;
    }

    /**
     * Enable the use of timestamps
     */
    public function enableTimestamp()
    {
        $this->useTimestamp = true;
    }

    /**
     * Disable the use of timestamps
     */
    public function disableTimestamp()
    {
        $this->useTimestamp = false;
    }

    /**
     * Set a required message to be prepended
     * @param $message
     * @throws Exceptions\InvalidArgumentException
     */
    public function setRequiredMessage($message)
    {
        if (!is_string($message) || empty($message)) {
            throw new InvalidArgumentException('You must provide a valid string a message.');
        }
        $this->requiredMessage = $message;
    }

    /**
     * Enable the use of a required message
     */
    public function enableRequiredMessage()
    {
        $this->hasRequiredMessage = true;
    }

    /**
     * Disable the use of a required message
     */
    public function disableRequiredMessage()
    {
        $this->hasRequiredMessage = false;
    }

    /**
     * Enable required contexts
     */
    public function enableRequiredContext()
    {
        $this->hasRequiredContext = true;
    }

    /**
     * Disable required contexts
     */
    public function disableRequiredContext()
    {
        $this->hasRequiredContext = false;
    }

    /**
     * Get the required contexts
     * @return array
     */
    public function getRequiredContext()
    {
        return $this->requiredContext;
    }

    /**
     * Set the required contexts
     * @param array $context
     */
    public function setRequiredContext(array $context)
    {
        $this->requiredContext = $context;
    }

    /**
     * Determines whether to move the message into the context or not
     * @var bool
     */
    public $contextualizeMessage = false;


    /**
     * Helper function to more easily set and use a required message.
     * @param string $message                      The string to prepend to the message prior to contextualizing
     * @param bool $contextualizeMessage    Do you want the message tokenized? {MESSAGE}
     */
    public function setAndEnableRequiredMessage($message, $contextualizeMessage = FALSE){
        $this->setRequiredMessage($message);
        $this->enableRequiredMessage();
        $this->contextualizeMessage = $contextualizeMessage;
    }

    /**
     * Helper function to more easily set and use a Required Context
     * @param array $context
     */
    public function setAndEnableRequiredContext(array $context){
        $this->enableRequiredContext();
        $this->setRequiredContext($context);
    }

    /**
     * Public a log message! This is where the magic happens ... or not!
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return null
     */
    public function log($level, $message, array $context = array())
    {
        // Ensure we try catch everything, and fail gracefully
        // if the logging fails for some reason. It should not
        // prevent the application from continuing to work.
        try {
            $level = LoggerLevel::findLevel($level);
            // Do we even care about this message?
            // this-1 <- that2
            if (!$level->isLessThanOrEqual($this->getLevel())) {
                return null;
            }
            $origMessage = '';


            if ($this->contextualizeMessage && $this->hasRequiredMessage && !empty($this->requiredMessage)) {
                $origMessage = $message;
                $message = '';
            }
            $appenderMessage = $this->formatMessage($message);

            $appenderContext = $this->mergeContexts($context);
            $appenderContext['LOGLEVEL'] = $level->toString();
            $appenderContext['TIMESTAMP'] = $this->createTimeStamp();
            if ($this->contextualizeMessage) {
                $appenderContext['MESSAGE'] = $origMessage;
            }
            foreach ($this->appenders as $appender) {
                /* @var $appender Appender */
                $appender->append($appenderMessage, $appenderContext);
            }
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Get the current log level
     * @return LoggerLevel
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set the current log level
     * @param $level
     * @throws Exceptions\InvalidArgumentException
     */
    public function setLevel($level)
    {
        if ($level instanceof LoggerLevel) {
            $this->level = $level;
            return;
        }

        if (is_int($level) || is_string($level)) {
            $this->level = LoggerLevel::findLevel($level);
            return;
        }
        throw new InvalidArgumentException('You must provide a valid LoggerLevel argument.');
    }

    /**
     * Sets the timezone Identifier
     * @param $timezoneId
     */
    public function setTimezoneId($timezoneId)
    {
        if (!is_string($timezoneId)) {
            throw new InvalidArgumentException("You must pass a string type timezone identifier.");
        }

        if (!in_array($timezoneId, \timezone_identifiers_list())) {
            throw new InvalidArgumentException("[$timezoneId] is not a valid TimeZone Identifier.");
        }
        $this->timezoneId = $timezoneId;
    }

    /**
     * Returns the timezone, based on the time zone identifier
     * @return \DateTimeZone
     */
    public function getTimezone()
    {
        return new \DateTimeZone($this->timezoneId);
    }

    /**
     * Get a nice timestamp, with microseconds
     * @return string
     */
    public function createTimeStamp()
    {
        // @todo setup timezone for logs
        $dateTime = date_create_from_format('U.u', sprintf('%.f', microtime(true)), $this->getTimezone());
        return $dateTime->format($this->getTimestampFormat());
    }

    /**
     * Get the format used for the timestamp
     * @return string
     */
    public function getTimestampFormat()
    {
        return $this->timestampFormat;
    }

    /**
     * Set the format used for the timestamp. Any format accepted by date().
     * @param $format
     * @throws Exceptions\InvalidArgumentException
     */
    public function setTimestampFormat($format)
    {
        if (!is_string($format) || empty($format)) {
            throw new InvalidArgumentException('You must provide a valid string accepted by date().');
        }
        $this->timestampFormat = $format;
    }

    /**
     * Prepends the formatted timestamp and required messages as needed.
     * @param $message
     * @return string
     */
    protected function formatMessage($message)
    {
        $formattedMessage = '';
        if ($this->usesTimestamp()) {
            $formattedMessage .= $this->createTimeStamp() . ' ';
        }
        if ($this->usesRequiredMessage()) {
            $formattedMessage .= $this->getRequiredMessage() . ' ';
        }
        return $formattedMessage . $message;
    }

    /**
     * Do we use the timestamp?
     * @return bool
     */
    public function usesTimeStamp()
    {
        return $this->useTimestamp;
    }

    /**
     * Do we use a required Message?
     * @return bool
     */
    public function usesRequiredMessage()
    {
        return $this->hasRequiredMessage;
    }

    /**
     * Get the required message
     * @return string
     */
    public function getRequiredMessage()
    {
        return $this->requiredMessage;
    }

    /**
     * Merges the message context with a required context if we use one.
     * @param $context
     * @return array
     */
    protected function mergeContexts(array $context)
    {
        if ($this->usesRequiredContext()) {
            return array_merge($this->requiredContext, $context);
        }
        return $context;
    }

    /**
     * Do we use a required context?
     * @return bool
     */
    public function usesRequiredContext()
    {
        return $this->hasRequiredContext;
    }
}