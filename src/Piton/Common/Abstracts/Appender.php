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

namespace Piton\Common\Abstracts;

use Piton\Common\Interfaces;
use Piton\Exceptions;
use Piton\Exceptions\InvalidArgumentException;

/**
 * Class Appender helps our appender code use.
 */
abstract class Appender implements Interfaces\Appender
{

    /**
     * Friendly name of this Appender for easy reference
     * @var string
     */
    protected $name;

    /**
     * String representation of the target of this appender
     * Perhaps the file name, the stream, or the URL
     * @var string
     */
    protected $target;

    /**
     * Any additional contextual information the appender needs
     * in order to perform its duties.
     * @var array
     */
    protected $context;

    /**
     * The constructor signature will be
     * @param string $name The Name of this Appender
     * @param string $target The Logging Target for this Appender
     * @param array $context Any additional information for this Appender
     */
    public function __construct($name, $target, array $context = [])
    {
        $this->setName($name);
        $this->setTarget($target);
        $this->setContext($context);
        $this->configure($context);
    }

    /**
     * Gracefully handle destroying any connections, file pointers, resources, etc.
     */
    public function __destruct()
    {
        // NOOP
    }

    /**
     * The method by which all logs are appended to the target.
     * @param string $message
     * @param array $context
     * @internal param \Piton\Common\LoggerLevel $level
     * @internal param $event
     * @return mixed
     */
    public function append($message, array $context)
    {
        // NOOP
    }

    /**
     * Interpolates context values into the message placeholders.
     * Taken from PSR-3's example implementation.
     *
     * **WARNING**
     * It is important that interpolate does not throw an
     * exception or error or anyway interrupt operations. It must
     * always fail silently and keep churning!
     *
     * @param $message
     * @param array $context
     * @return mixed
     */
    protected function interpolate($message, array $context = array())
    {
        // If there is no context to deal with
        // just return the message and be done.
        if (empty($context)) {
            return $message;
        }
        // build a replacement array with braces around the context keys
        $replace = array();
        foreach ($context as $key => $val) {
            // handle arrays
            if (is_array($val)) {
                $val = print_r($val, true);
                // handle objects
            } elseif (is_object($val)) {
                // special handle for exceptions
                if ($key === 'exception' && $val instanceof \Exception) {
                    // @var \Exception $val
                    $final = $val->getMessage() . PHP_EOL;
                    ob_start();
                    var_dump($val->getTraceAsString());
                    $final .= ob_get_contents();
                    ob_end_clean();
                    $val = $final;
                    // if the object implement the __toString method
                } elseif (method_exists($val, '__toString')) {
                    $val = $val->__toString();
                    // Otherwise, we just get the class name.
                } elseif (method_exists($val, 'toString')) {

                    $val = $val->toString();
                    // Otherwise, we just get the class name.
                } else {
                    $val = get_class($val);
                }
            } elseif (is_bool($val)) {
                $val = ($val) ? 'TRUE' : 'FALSE';
            } elseif (is_numeric($val)) {
                $val = strval($val);
            } elseif (is_resource($val)) {
                $val = (string)$val . ' (' . get_resource_type($val) . ')';
            }

            if (is_string($val)) {
                $replace['{' . $key . '}'] = $val;
            } else {
                $replace['{' . $key . '}'] = 'NULL_TOKEN';
            }
        }
        // This should be neigh impossible to get to if we did our work correctly,
        // however - if there is no replacements found
        // @codeCoverageIgnoreStart
        if (empty($replace)) {
            return $message;
        }
        // @codeCoverageIgnoreEnd
        // interpolate replacement values into the message and return
        return strtr($message, $replace);
    }

    /**
     * Gets the name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the Name
     * @param $name
     * @return string
     */
    public function setName($name)
    {
        if (empty($name)) {
            $name = uniqid();
        }
        $this->name = $name;
        return $this->getName();
    }

    /**
     * Gets the target
     * @return string
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Sets the target
     * @param $target
     * @return string
     */
    public function setTarget($target)
    {
        $this->target = $target;
        return $this->getTarget();
    }

    /**
     * Gets the context
     * @return array
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * Sets the context
     * @param array $context
     * @return array
     */
    public function setContext(array $context = [])
    {
        $this->context = $context;
        return $this->getContext();
    }

    /**
     * Handles any configuration of context specific settings.
     * @param array $context
     */
    public function configure(array $context = [])
    {
        // NOOP
    }

    /**
     * Utility function to help verify arguments.
     * @param string $key
     * @param array $array
     * @param string $method
     * @throws InvalidArgumentException
     * @return bool
     */
    protected function verifyArrayKey($key, array $array, $method)
    {
        if (!array_key_exists($key, $array)) {
            throw new InvalidArgumentException("$method requires you provide a configuration for the [$key] key.");
        }
        return true;
    }
}