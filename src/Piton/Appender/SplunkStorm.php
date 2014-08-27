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

use GuzzleHttp\Client as gzClient;
use GuzzleHttp\Exception\RequestException;
use Piton\Common\Abstracts\Appender;
use Piton\Exceptions\InvalidArgumentException;

/**
 * This is where the magic happens! We use this class to actually
 * send log events to SplunkStorm via API.
 */
class SplunkStorm extends Appender
{
    /**
     * Splunk API Host Name
     * @var string
     */
    protected $apiHost = null;
    /**
     * Splunk Project ID
     * @var string
     */
    protected $projectID = null;
    /**
     * Splunk Project Access Token
     * @var string
     */
    protected $accessToken = null;

    /**
     * Splunk API Version to use
     * @var number
     */
    protected $apiVersion = 1;

    /**
     * Splunk API End Point
     * @var string
     */
    protected $apiEndpoint = 'inputs/http';
    /**
     * Splunk API URL Scheme
     * @var string
     */
    protected $urlScheme = 'https';
    /**
     * Splunk Source Type
     * @var string
     */
    protected $sourcetype = 'generic_single_line';


    /**
     * The Guzzle Client for HTTP Requests.
     * @var gzClient
     */
    protected $client;

    /**
     * Constructor
     *
     * @param string $name This appenders name
     * @param string $target The API Host
     * @param array $context Extra information for the appender
     */
    public function __construct($name = '', $target, array $context = [])
    {
        $this->apiHost = $target;
        parent::__construct($name, $target, $context);
        $this->getClient();
    }

    /**
     * Handles additional configuration of context specific settings.
     * @param array $context
     * @throws \Piton\Exceptions\InvalidArgumentException
     */
    public function configure(array $context = [])
    {
        if (!array_key_exists('SplunkStorm', $context)) {
            throw new InvalidArgumentException("You must provide the SplunkStorm Key in the context array.");
        }

        if ($this->verifyArrayKey('projectID', $context['SplunkStorm'], __METHOD__)) {
            $this->projectID = $context['SplunkStorm']['projectID'];
        }
        if ($this->verifyArrayKey('accessToken', $context['SplunkStorm'], __METHOD__)) {
            $this->accessToken = $context['SplunkStorm']['accessToken'];
        }
        if (array_key_exists('apiVersion', $context['SplunkStorm'])) {
            $this->apiVersion = $context['SplunkStorm']['apiVersion'];
        }
        if (array_key_exists('apiEndpoint', $context['SplunkStorm'])) {
            $this->apiEndpoint = $context['SplunkStorm']['apiEndpoint'];
        }
        if (array_key_exists('urlScheme', $context['SplunkStorm'])) {
            $this->urlScheme = $context['SplunkStorm']['urlScheme'];
        }
    }

    /**
     * Destructor
     * @codeCoverageIgnoreStart
     */
    public function __destruct()
    {
        $this->client = null;
    }
    // @codeCoverageIgnoreEnd

    /**
     * Take all those variables, and make me a nice URL to use
     * @return string
     */
    protected function getUrl()
    {
        return $this->urlScheme . '://' . $this->apiHost . '/' . $this->apiVersion . '/' . $this->apiEndpoint .
        '?index=' . $this->projectID . '&sourcetype=' . $this->sourcetype;
    }

    /**
     * At some point, we are going to want an HTTP Client
     * @return gzClient
     */
    protected function getClient()
    {
        if (is_null($this->client)) {
            $this->client = new gzClient();
        }
        return $this->client;
    }

    /**
     * Allow injecting a custom client
     * @param gzClient $client
     */
    public function setClient(gzClient $client)
    {
        $this->client = $client;
    }

    /**
     * The method by which all logs are appended to the target.
     *
     * @param string $message
     * @param array $context
     * @throws \ErrorException
     * @internal param \Piton\Common\LoggerLevel $level
     * @internal param $event
     * @return mixed|void
     */
    public function append($message, array $context)
    {
        try {
            $this->getClient()->post(
                $this->getUrl(),
                [
                    'auth' => ['x', $this->accessToken],
                    'body' => trim(preg_replace('/\s+/', ' ', $this->interpolate($message, $context)))
                ]
            );
        } catch (RequestException $e) {
            $msg = $e->getRequest() . "\n";
            // @codeCoverageIgnoreStart
            if ($e->hasResponse()) {
                // @codeCoverageIgnoreStart
                $msg .= $e->getResponse() . "\n";
            }
            // @codeCoverageIgnoreEnd
            throw new \ErrorException("Error Logging to Splunk: $msg");
        }
    }

    /**
     * Get the name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}