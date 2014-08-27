#!/usr/bin/env php
<?php
use Piton\Logger;

error_reporting(E_ALL);
ini_set('display_errors', true);
date_default_timezone_set (@date_default_timezone_get());
set_time_limit(0);

define('APPLICATION_ENV', 'testing');

require_once(__DIR__  . '/../vendor/autoload.php');

$logger = Logger::defaultConsoleFactory();

print "First, lets just see what we get by default.\n";
runLogMessages('Default Log Messages');

print "\nThat is great, but I would really like to see the level in each message!\n";
runLogMessages('{LOGLEVEL} Messages with Log Levels!');

print "\nOk, but I don't see debug and trace, I really want to see all the messages.\n";
$logger->setLevel('all');
runLogMessages('{LOGLEVEL} Then just use the built in LOGLEVEL tag!');
$logger->setLevel('fatal');

print "\nFine, yer a clever fellow. But, where are the timestamps?\n";
runLogMessages('{TIMESTAMP} {LOGLEVEL} Here they are, just use the built in TIMESTAMP tag!');

print "\nSo, everytime I send a message, I have to put this in it?\n";
$logger->setRequiredMessage('{TIMESTAMP} {LOGLEVEL}');
$logger->enableRequiredMessage();
runLogMessages('Set and enable the required message, it will prepend to any message you send. Then, just send your message.');

print "\nWhat if I want the loglevel and timestamp after the message tough guy?\n";
$logger->contextualizeMessage = TRUE;
$logger->setRequiredMessage('{MESSAGE} {LOGLEVEL} {TIMESTAMP}');
runLogMessages('Oh, you mean like this?');

print "\nI have to make three different calls in order to set, enable the required message as well as contextualize the dynamic message?\n";
$logger->setAndEnableRequiredMessage('{TIMESTAMP} {LOGLEVEL} {MESSAGE} ', TRUE);
runLogMessages('Nope, just do this.');

print "\nAight Mr. Smarty pants. Why? Seriously, why not just default to timestamp, loglevel, message like everyone else?\n";
$logger->setRequiredMessage('{TIMESTAMP} app="SimpleConsoleLogging" level="{LOGLEVEL}" file="{file}" line={line} class="{class}" msg="{MESSAGE}" ');
runLogMessages('Because we log to SplunkStorm, and we PWN our logs!', ['file'=>__FILE__,'class'=>__CLASS__, 'line'=>__LINE__]);

/**
 * Helper Function
 * @param $message
 */
function runLogMessages($message, $context = array()){
    global $logger;

    $logger->fatal($message, $context);
    $logger->emergency($message, $context);
    $logger->alert($message, $context);
    $logger->critical($message, $context);
    $logger->error($message, $context);
    $logger->warning($message, $context);
    $logger->notice($message, $context);
    $logger->info($message, $context);
    $logger->debug($message, $context);
    $logger->trace($message, $context);
}



