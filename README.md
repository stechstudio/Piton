# PITON
## _The [PSR-3](http://www.php-fig.org/psr/psr-3/) Compliant [SplunkStorm](http://docs.splunk.com/Documentation/Storm/latest/User/AboutSplunkStorm) Logger for PHP_

Piton was developed in order to allow simple access to the [SplunkStorm REST API](http://docs.splunk.com/Documentation/Storm/Storm/User/UseStormsRESTAPI) from PHP code. While we use the [SplunkStorm](http://docs.splunk.com/Documentation/Storm/latest/User/AboutSplunkStorm) log shippers for the majority of our applications, we ran into cases of short lived tasks, running on short lived EC2 instances, that didn't warrant setting up log shipping.

However, we did desire the ability to capture the logs on SplunkStorm. Because the majority of these tasks run on [Iron.io's](http://www.iron.io) [IronWorker](http://www.iron.io/worker) and are CLI based, we also desired the ability to log to the console. Thus, our logger ships with console and splunk appenders.

We also happen to think highly of the [PHP FIG](http://www.php-fig.org/) standards, and desire to meet them where possible. After writing the logger for ourselves, we decided others might want to leverage it to, and are releasing it into the wild.

|   | <strong>Build Status</strong> | <strong>Code Coverage</strong> |
:-------- | ------------: | -------------:
<strong>Master</strong> | [![Build Status](https://travis-ci.org/stechstudio/Piton.svg?branch=master)](https://travis-ci.org/stechstudio/Piton) | [![Coverage Status](https://coveralls.io/repos/stechstudio/Piton/badge.png?branch=master)](https://coveralls.io/r/stechstudio/Piton?branch=master)
<strong>Develop</strong> | [![Build Status](https://travis-ci.org/stechstudio/Piton.svg?branch=develop)](https://travis-ci.org/stechstudio/Piton) | [![Coverage Status](https://coveralls.io/repos/stechstudio/Piton/badge.png?branch=develop)](https://coveralls.io/r/stechstudio/Piton?branch=develop)

## Installation / Usage
1. Download the [`composer.phar`](https://getcomposer.org/composer.phar) executable or use the installer.

    ``` sh
    $ curl -sS https://getcomposer.org/installer | php
    ```

2. Create a composer.json defining your dependencies. Note that this example is
a short version for applications that are not meant to be published as packages
themselves. To create libraries/packages please read the
[documentation](http://getcomposer.org/doc/02-libraries.md).

    ``` json
    {
        "require": {
            "stechstudio/piton": ">=0.1.1"
        }
    }
    ```

3. Run Composer: `php composer.phar install`
4. Browse for more packages on [Packagist](https://packagist.org).

## Documentations
Check out the [docs/api directory](https://github.com/stechstudio/Piton/tree/master/docs/api).

## Examples
Check out the [examples directory](https://github.com/stechstudio/Piton/tree/master/examples).

## Quickstart
You will need a SplunkStorm Project API Hostname, Project ID, and Access Token. You can find them in the data section of your SplunkStorm Project. Select _Data_, the _API_, and you will find everything you need.
```php

$allAppenders = [
        'logger' => ['level' => 'info'],
        'appenders' => [
            'console' => [
                'target' => 'STDOUT',
                'class' => 'Piton\Appender\Console'
            ],
            'null' => ['class' => 'Piton\Appender\Null'],
            'splunk' => [
                'target' => 'api-fake.data.splunkstorm.com',
                'class' => 'Piton\Appender\SplunkStorm',
                'context' => [
                    'SplunkStorm' => [
                        'projectID' => 'SomeFakeProjectID',
                        'accessToken' => 'AnotherFakeAccessToken',
                        'apiVersion' => 1,
                        'apiEndpoint' => 'inputs/http',
                        'urlScheme' => 'https'
                    ]
                ]
            ]
        ]
    ];

$logger = new Logger($allAppenders);
$logger->contextualizeMessage = TRUE;
$logger->setLevel('all');
$logger->setRequiredMessage('{TIMESTAMP} app="SimpleConsoleLogging" level="{LOGLEVEL}" file="{file}" line={line} class="{class}" msg="{MESSAGE}" ');
runLogMessages('Because we log to SplunkStorm, and we PWN our logs!', ['file'=>__FILE__,'class'=>__CLASS__, 'line'=>__LINE__]);

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
```
