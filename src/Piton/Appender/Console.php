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

namespace Piton\Appender;

use Piton\Common\Abstracts\Appender;
use Piton\Exceptions\InvalidArgumentException;

/**
 * Class Console will print to stdout or stderr.
 */
class Console extends Appender
{

    /**
     * The standard otuput stream.
     * @var string
     */
    const STDOUT = 'php://stdout';

    /**
     * The standard error stream.
     * @var string
     */
    const STDERR = 'php://stderr';

    /**
     * Stream resource for the target stream.
     * @var resource
     */
    protected $fp = null;

    /**
     * The constructor signature will be
     * @param string $name The Name of this Appender
     * @param string $target The Logging Target for this Appender
     * @param array $context Any additional information for this Appender
     */
    public function __construct($name = '', $target = self::STDOUT, array $context = [])
    {
        parent::__construct($name, $target, $context);
    }

    /**
     * Gracefully handle closing any resources, etc.
     */
    public function __destruct()
    {
        $this->close();
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
        if (is_resource($this->fp)) {
            fwrite($this->fp, $this->interpolate($message, $context) . PHP_EOL);
        }
    }

    /**
     * Sets the target, which ultimately sets the file pointer (stream)
     * for this appender
     *
     * @param $target
     * @throws \Piton\Exceptions\InvalidArgumentException
     * @return string
     */
    public function setTarget($target)
    {
        $value = trim($target);
        if ($value == self::STDOUT || strtoupper($value) == 'STDOUT') {
            $this->target = self::STDOUT;
        } elseif ($value == self::STDERR || strtoupper($value) == 'STDERR') {
            $this->target = self::STDERR;
        } else {
            throw new InvalidArgumentException("Invalid value given for 'target' property: [$target]. Property not set.");
        }
        $this->open();
        return $this->getTarget();
    }

    /**
     * Opens up a file pointer to a resource for us.
     */
    protected function open()
    {
        //if we already have a resource, we need to close it.
        $this->close();
        $this->fp = fopen($this->target, 'w');
    }

    /**
     * Closes the resource file pointer, if it is valid.
     */
    protected function close()
    {
        if (is_resource($this->fp)) {
            fclose($this->fp);
            $this->fp = null;
        }
    }
}