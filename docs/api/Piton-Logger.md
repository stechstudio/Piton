Piton\Logger
===============

This is the PSR-3 Logger Class. It allows for any number of appenders
and comes with a Null, Console, and SPlunkStorm appender built in.

It simply delegates all log-level-specific methods to the `log` method to
reduce boilerplate code that a simple Logger that does the same thing with
messages regardless of the error level has to implement.


* Class name: Logger
* Namespace: Piton
* Parent class: [Piton\Common\Abstracts\Logger](Piton-Common-Abstracts-Logger.md)





Properties
----------


### $timestampFormat

```
protected string $timestampFormat = 'D M j G:i:s.u T Y'
```

The Timestamp Format



* Visibility: **protected**


### $defaultLevel

```
protected string $defaultLevel = \Piton\Common\LoggerLevel::INFO_STR
```

The default log level for a new logger



* Visibility: **protected**


### $defaultAppender

```
protected array $defaultAppender = array('console' => array('target' => 'STDOUT', 'class' => 'Piton\Appender\Console'))
```

Config for a default console Appender



* Visibility: **protected**


### $useTimestamp

```
protected boolean $useTimestamp = false
```

Whether our log message should be prepended with a timestamp



* Visibility: **protected**


### $hasRequiredMessage

```
protected boolean $hasRequiredMessage = false
```

Whether our log message should be prepended with a stanard message



* Visibility: **protected**


### $requiredMessage

```
protected string $requiredMessage = ''
```

A required message to prepend to log messages



* Visibility: **protected**


### $hasRequiredContext

```
protected boolean $hasRequiredContext = false
```

Whether we have a required context



* Visibility: **protected**


### $requiredContext

```
protected array $requiredContext
```

If we have a required context, this where we keep it.



* Visibility: **protected**


### $level

```
private \Piton\Common\LoggerLevel $level
```

This Loggers Level



* Visibility: **private**


### $appenders

```
private array $appenders = array()
```

Appenders linked to this logger



* Visibility: **private**


### $timezoneId

```
protected string $timezoneId = 'UTC'
```

Timezone Identifier for out log timestamps. Defaults to UTC, and really,
truly, should never be modified! Thus saith Bubba!



* Visibility: **protected**


### $contextualizeMessage

```
public boolean $contextualizeMessage = false
```

Determines whether to move the message into the context or not



* Visibility: **public**


Methods
-------


### \Piton\Logger::__construct()

```
mixed Piton\Logger::\Piton\Logger::__construct()(array $config)
```

The constructor, it takes an array of configuration information. And example
of instantiating three appenders might look like:

['logger' => ['level' => 'info'],
 'appenders' => [
     'console' => [
             'target' => 'STDOUT',
             'class'  => 'Piton\Appender\Console'
      ],
     'null'    => ['class'  => 'Piton\Appender\Null'],
     'splunk'  =>[
             'target' => 'api-fake.data.splunkstorm.com',
             'class'  => 'Piton\Appender\SplunkStorm',
             'context' => [
                'SplunkStorm' => ['projectID'=>'SomeFakeProjectID',
                  'accessToken' => 'AnotherFakeAccessToken',
                  'apiVersion'  => 1,
                  'apiEndpoint' => 'inputs/http',
                  'urlScheme'   => 'https'
                 ]
              ]
      ],
 ]

* Visibility: **public**

#### Arguments

* $config **array**



### \Piton\Logger::configure()

```
mixed Piton\Logger::\Piton\Logger::configure()(array $config)
```

Configures our Logger with the configuration array.



* Visibility: **public**

#### Arguments

* $config **array**



### \Piton\Logger::setAppenders()

```
mixed Piton\Logger::\Piton\Logger::setAppenders()(array $appenders)
```

Utility function for the configuration to set up multiple appenders



* Visibility: **public**

#### Arguments

* $appenders **array**



### \Piton\Logger::addAppender()

```
mixed Piton\Logger::\Piton\Logger::addAppender()(\Piton\Common\Interfaces\Appender $appender)
```

Add a new appender to the logger



* Visibility: **public**

#### Arguments

* $appender **[Piton\Common\Interfaces\Appender](Piton-Common-Interfaces-Appender.md)**



### \Piton\Logger::appenderCount()

```
integer Piton\Logger::\Piton\Logger::appenderCount()()
```

How many appenders are configured?



* Visibility: **public**



### \Piton\Logger::defaultNullFactory()

```
\Piton\Logger Piton\Logger::\Piton\Logger::defaultNullFactory()()
```

Simple way to get a NULL logger



* Visibility: **public**
* This method is **static**.



### \Piton\Logger::defaultConsoleFactory()

```
\Piton\Logger Piton\Logger::\Piton\Logger::defaultConsoleFactory()()
```

Simple way to get a console logger



* Visibility: **public**
* This method is **static**.



### \Piton\Logger::removeAppender()

```
mixed Piton\Logger::\Piton\Logger::removeAppender()($name)
```

Remove an appender from the logger



* Visibility: **public**

#### Arguments

* $name **mixed**



### \Piton\Logger::getAppender()

```
\Piton\Common\Interfaces\Appender|boolean Piton\Logger::\Piton\Logger::getAppender()($name)
```

Get an appender by name



* Visibility: **public**

#### Arguments

* $name **mixed**



### \Piton\Logger::enableTimestamp()

```
mixed Piton\Logger::\Piton\Logger::enableTimestamp()()
```

Enable the use of timestamps



* Visibility: **public**



### \Piton\Logger::disableTimestamp()

```
mixed Piton\Logger::\Piton\Logger::disableTimestamp()()
```

Disable the use of timestamps



* Visibility: **public**



### \Piton\Logger::setRequiredMessage()

```
mixed Piton\Logger::\Piton\Logger::setRequiredMessage()($message)
```

Set a required message to be prepended



* Visibility: **public**

#### Arguments

* $message **mixed**



### \Piton\Logger::enableRequiredMessage()

```
mixed Piton\Logger::\Piton\Logger::enableRequiredMessage()()
```

Enable the use of a required message



* Visibility: **public**



### \Piton\Logger::disableRequiredMessage()

```
mixed Piton\Logger::\Piton\Logger::disableRequiredMessage()()
```

Disable the use of a required message



* Visibility: **public**



### \Piton\Logger::enableRequiredContext()

```
mixed Piton\Logger::\Piton\Logger::enableRequiredContext()()
```

Enable required contexts



* Visibility: **public**



### \Piton\Logger::disableRequiredContext()

```
mixed Piton\Logger::\Piton\Logger::disableRequiredContext()()
```

Disable required contexts



* Visibility: **public**



### \Piton\Logger::getRequiredContext()

```
array Piton\Logger::\Piton\Logger::getRequiredContext()()
```

Get the required contexts



* Visibility: **public**



### \Piton\Logger::setRequiredContext()

```
mixed Piton\Logger::\Piton\Logger::setRequiredContext()(array $context)
```

Set the required contexts



* Visibility: **public**

#### Arguments

* $context **array**



### \Piton\Logger::log()

```
null Piton\Logger::\Piton\Logger::log()(mixed $level, string $message, array $context)
```

Public a log message! This is where the magic happens .

.. or not!

* Visibility: **public**

#### Arguments

* $level **mixed**
* $message **string**
* $context **array**



### \Piton\Logger::getLevel()

```
\Piton\Common\LoggerLevel Piton\Logger::\Piton\Logger::getLevel()()
```

Get the current log level



* Visibility: **public**



### \Piton\Logger::setLevel()

```
mixed Piton\Logger::\Piton\Logger::setLevel()($level)
```

Set the current log level



* Visibility: **public**

#### Arguments

* $level **mixed**



### \Piton\Logger::setTimezoneId()

```
mixed Piton\Logger::\Piton\Logger::setTimezoneId()($timezoneId)
```





* Visibility: **public**

#### Arguments

* $timezoneId **mixed**



### \Piton\Logger::getTimezone()

```
mixed Piton\Logger::\Piton\Logger::getTimezone()()
```





* Visibility: **public**



### \Piton\Logger::createTimeStamp()

```
string Piton\Logger::\Piton\Logger::createTimeStamp()()
```

Get a nice timestamp, with microseconds



* Visibility: **public**



### \Piton\Logger::getTimestampFormat()

```
string Piton\Logger::\Piton\Logger::getTimestampFormat()()
```

Get the format used for the timestamp



* Visibility: **public**



### \Piton\Logger::setTimestampFormat()

```
mixed Piton\Logger::\Piton\Logger::setTimestampFormat()($format)
```

Set the format used for the timestamp. Any format accepted by date().



* Visibility: **public**

#### Arguments

* $format **mixed**



### \Piton\Logger::formatMessage()

```
string Piton\Logger::\Piton\Logger::formatMessage()($message)
```

Prepends the formatted timestamp and required messages as needed.



* Visibility: **protected**

#### Arguments

* $message **mixed**



### \Piton\Logger::usesTimeStamp()

```
boolean Piton\Logger::\Piton\Logger::usesTimeStamp()()
```

Do we use the timestamp?



* Visibility: **public**



### \Piton\Logger::usesRequiredMessage()

```
boolean Piton\Logger::\Piton\Logger::usesRequiredMessage()()
```

Do we use a required Message?



* Visibility: **public**



### \Piton\Logger::getRequiredMessage()

```
string Piton\Logger::\Piton\Logger::getRequiredMessage()()
```

Get the required message



* Visibility: **public**



### \Piton\Logger::mergeContexts()

```
array Piton\Logger::\Piton\Logger::mergeContexts()($context)
```

Merges the message context with a required context if we use one.



* Visibility: **protected**

#### Arguments

* $context **mixed**



### \Piton\Logger::usesRequiredContext()

```
boolean Piton\Logger::\Piton\Logger::usesRequiredContext()()
```

Do we use a required context?



* Visibility: **public**



### \Piton\Common\Abstracts\Logger::fatal()

```
null Piton\Logger::\Piton\Common\Abstracts\Logger::fatal()(string $message, array $context)
```

System is dead.



* Visibility: **public**

#### Arguments

* $message **string**
* $context **array**



### \Piton\Common\Abstracts\Logger::emergency()

```
null Piton\Logger::\Piton\Common\Abstracts\Logger::emergency()(string $message, array $context)
```

System is unusable.



* Visibility: **public**

#### Arguments

* $message **string**
* $context **array**



### \Piton\Common\Abstracts\Logger::alert()

```
null Piton\Logger::\Piton\Common\Abstracts\Logger::alert()(string $message, array $context)
```

Action must be taken immediately.

Example: Entire website down, database unavailable, etc. This should
trigger the SMS alerts and wake you up.

* Visibility: **public**

#### Arguments

* $message **string**
* $context **array**



### \Piton\Common\Abstracts\Logger::critical()

```
null Piton\Logger::\Piton\Common\Abstracts\Logger::critical()(string $message, array $context)
```

Critical conditions.

Example: Application component unavailable, unexpected exception.

* Visibility: **public**

#### Arguments

* $message **string**
* $context **array**



### \Piton\Common\Abstracts\Logger::error()

```
null Piton\Logger::\Piton\Common\Abstracts\Logger::error()(string $message, array $context)
```

Runtime errors that do not require immediate action but should typically
be logged and monitored.



* Visibility: **public**

#### Arguments

* $message **string**
* $context **array**



### \Piton\Common\Abstracts\Logger::warning()

```
null Piton\Logger::\Piton\Common\Abstracts\Logger::warning()(string $message, array $context)
```

Exceptional occurrences that are not errors.

Example: Use of deprecated APIs, poor use of an API, undesirable things
that are not necessarily wrong.

* Visibility: **public**

#### Arguments

* $message **string**
* $context **array**



### \Piton\Common\Abstracts\Logger::notice()

```
null Piton\Logger::\Piton\Common\Abstracts\Logger::notice()(string $message, array $context)
```

Normal but significant events.



* Visibility: **public**

#### Arguments

* $message **string**
* $context **array**



### \Piton\Common\Abstracts\Logger::info()

```
null Piton\Logger::\Piton\Common\Abstracts\Logger::info()(string $message, array $context)
```

Interesting events.

Example: User logs in, SQL logs.

* Visibility: **public**

#### Arguments

* $message **string**
* $context **array**



### \Piton\Common\Abstracts\Logger::debug()

```
null Piton\Logger::\Piton\Common\Abstracts\Logger::debug()(string $message, array $context)
```

Detailed debug information.



* Visibility: **public**

#### Arguments

* $message **string**
* $context **array**



### \Piton\Common\Abstracts\Logger::trace()

```
null Piton\Logger::\Piton\Common\Abstracts\Logger::trace()(string $message, array $context)
```

Detailed trace information.



* Visibility: **public**

#### Arguments

* $message **string**
* $context **array**



### \Piton\Common\Interfaces\Logger::emergency()

```
null Piton\Common\Interfaces\Logger::\Piton\Common\Interfaces\Logger::emergency()(string $message, array $context)
```

System is unusable.



* Visibility: **public**
* This method is defined by [Piton\Common\Interfaces\Logger](Piton-Common-Interfaces-Logger.md)

#### Arguments

* $message **string**
* $context **array**



### \Piton\Common\Interfaces\Logger::alert()

```
null Piton\Common\Interfaces\Logger::\Piton\Common\Interfaces\Logger::alert()(string $message, array $context)
```

Action must be taken immediately.

Example: Entire website down, database unavailable, etc. This should
trigger the SMS alerts and wake you up.

* Visibility: **public**
* This method is defined by [Piton\Common\Interfaces\Logger](Piton-Common-Interfaces-Logger.md)

#### Arguments

* $message **string**
* $context **array**



### \Piton\Common\Interfaces\Logger::critical()

```
null Piton\Common\Interfaces\Logger::\Piton\Common\Interfaces\Logger::critical()(string $message, array $context)
```

Critical conditions.

Example: Application component unavailable, unexpected exception.

* Visibility: **public**
* This method is defined by [Piton\Common\Interfaces\Logger](Piton-Common-Interfaces-Logger.md)

#### Arguments

* $message **string**
* $context **array**



### \Piton\Common\Interfaces\Logger::error()

```
null Piton\Common\Interfaces\Logger::\Piton\Common\Interfaces\Logger::error()(string $message, array $context)
```

Runtime errors that do not require immediate action but should typically
be logged and monitored.



* Visibility: **public**
* This method is defined by [Piton\Common\Interfaces\Logger](Piton-Common-Interfaces-Logger.md)

#### Arguments

* $message **string**
* $context **array**



### \Piton\Common\Interfaces\Logger::warning()

```
null Piton\Common\Interfaces\Logger::\Piton\Common\Interfaces\Logger::warning()(string $message, array $context)
```

Exceptional occurrences that are not errors.

Example: Use of deprecated APIs, poor use of an API, undesirable things
that are not necessarily wrong.

* Visibility: **public**
* This method is defined by [Piton\Common\Interfaces\Logger](Piton-Common-Interfaces-Logger.md)

#### Arguments

* $message **string**
* $context **array**



### \Piton\Common\Interfaces\Logger::notice()

```
null Piton\Common\Interfaces\Logger::\Piton\Common\Interfaces\Logger::notice()(string $message, array $context)
```

Normal but significant events.



* Visibility: **public**
* This method is defined by [Piton\Common\Interfaces\Logger](Piton-Common-Interfaces-Logger.md)

#### Arguments

* $message **string**
* $context **array**



### \Piton\Common\Interfaces\Logger::info()

```
null Piton\Common\Interfaces\Logger::\Piton\Common\Interfaces\Logger::info()(string $message, array $context)
```

Interesting events.

Example: User logs in, SQL logs.

* Visibility: **public**
* This method is defined by [Piton\Common\Interfaces\Logger](Piton-Common-Interfaces-Logger.md)

#### Arguments

* $message **string**
* $context **array**



### \Piton\Common\Interfaces\Logger::debug()

```
null Piton\Common\Interfaces\Logger::\Piton\Common\Interfaces\Logger::debug()(string $message, array $context)
```

Detailed debug information.



* Visibility: **public**
* This method is defined by [Piton\Common\Interfaces\Logger](Piton-Common-Interfaces-Logger.md)

#### Arguments

* $message **string**
* $context **array**



### \Piton\Common\Interfaces\Logger::log()

```
null Piton\Common\Interfaces\Logger::\Piton\Common\Interfaces\Logger::log()(mixed $level, string $message, array $context)
```

Logs with an arbitrary level.



* Visibility: **public**
* This method is defined by [Piton\Common\Interfaces\Logger](Piton-Common-Interfaces-Logger.md)

#### Arguments

* $level **mixed**
* $message **string**
* $context **array**


