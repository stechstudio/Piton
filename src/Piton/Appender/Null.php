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

/**
 * Simply NULL Appender, mostly used for stubbing out logging.
 */
class Null extends Appender
{
    /**
     * The constructor signature will be
     * @param string $name The Name of this Appender
     * @param string $target The Logging Target for this Appender
     * @param array $context Any additional information for this Appender
     */
    public function __construct($name = '', $target = '', array $context = [])
    {
        parent::__construct($name, $target, $context);
    }
}