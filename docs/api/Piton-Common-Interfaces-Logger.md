Piton\Common\Interfaces\Logger
===============

Our interface extends the PSR-3 Reference Interface




* Interface name: Logger
* Namespace: Piton\Common\Interfaces
* This is an **interface**
* This interface extends: Psr\Log\LoggerInterface





Methods
-------


### \Piton\Common\Interfaces\Logger::emergency()

```
null Piton\Common\Interfaces\Logger::\Piton\Common\Interfaces\Logger::emergency()(string $message, array $context)
```

System is unusable.



* Visibility: **public**

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

#### Arguments

* $message **string**
* $context **array**



### \Piton\Common\Interfaces\Logger::notice()

```
null Piton\Common\Interfaces\Logger::\Piton\Common\Interfaces\Logger::notice()(string $message, array $context)
```

Normal but significant events.



* Visibility: **public**

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

#### Arguments

* $message **string**
* $context **array**



### \Piton\Common\Interfaces\Logger::debug()

```
null Piton\Common\Interfaces\Logger::\Piton\Common\Interfaces\Logger::debug()(string $message, array $context)
```

Detailed debug information.



* Visibility: **public**

#### Arguments

* $message **string**
* $context **array**



### \Piton\Common\Interfaces\Logger::log()

```
null Piton\Common\Interfaces\Logger::\Piton\Common\Interfaces\Logger::log()(mixed $level, string $message, array $context)
```

Logs with an arbitrary level.



* Visibility: **public**

#### Arguments

* $level **mixed**
* $message **string**
* $context **array**


