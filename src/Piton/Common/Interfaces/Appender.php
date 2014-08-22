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

namespace Piton\Common\Interfaces;

/**
 * Interface for Appender API Consistency
 */
interface Appender
{

    /**
     * The constructor signature will be
     * @param string $name The Name of this Appender
     * @param string $target The Logging Target for this Appender
     * @param array $context Any additional information for this Appender
     */
    public function __construct($name, $target, array $context = []);

    /**
     * Gracefully handle destroying any connections, file pointers, resources, etc.
     */
    public function __destruct();

    /**
     * The method by which all logs are appended to the target.
     * @param string $message
     * @param array $context
     * @internal param \Piton\Common\LoggerLevel $level
     * @internal param $event
     * @return mixed
     */
    public function append($message, array $context);

    /**
     * Gets the name
     * @return string
     */
    public function getName();

    /**
     * Sets the Name
     * @param $name
     * @return string
     */
    public function setName($name);

    /**
     * Gets the target
     * @return string
     */
    public function getTarget();

    /**
     * Sets the target
     * @param $target
     * @return string
     */
    public function setTarget($target);

    /**
     * Gets the context
     * @return array
     */
    public function getContext();

    /**
     * Sets the context
     * @param array $context
     * @return array
     */
    public function setContext(array $context = []);

    /**
     * Handles any configuration of context specific settings.
     * @param array $context
     */
    public function configure(array $context = []);
}