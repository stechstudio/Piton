Piton\Common\Abstracts\Logger
===============

This is a simple Logger implementation that other Loggers can inherit from.

It simply delegates all log-level-specific methods to the `log` method to
reduce boilerplate code that a simple Logger that does the same thing with
messages regardless of the error level has to implement.


* Class name: Logger
* Namespace: Piton\Common\Abstracts
* This is an **abstract** class
* This class implements: [Piton\Common\Interfaces\Logger](Piton-Common-Interfaces-Logger.md)






Methods
-------


### \Piton\Common\Abstracts\Logger::fatal()

```
null Piton\Common\Abstracts\Logger::\Piton\Common\Abstracts\Logger::fatal()(string $message, array $context)
```

System is dead.



* Visibility: **public**

#### Arguments

* $message **string**
* $context **array**



### \Piton\Common\Abstracts\Logger::emergency()

```
null Piton\Common\Abstracts\Logger::\Piton\Common\Abstracts\Logger::emergency()(string $message, array $context)
```

System is unusable.



* Visibility: **public**

#### Arguments

* $message **string**
* $context **array**



### \Piton\Common\Abstracts\Logger::alert()

```
null Piton\Common\Abstracts\Logger::\Piton\Common\Abstracts\Logger::alert()(string $message, array $context)
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
null Piton\Common\Abstracts\Logger::\Piton\Common\Abstracts\Logger::critical()(string $message, array $context)
```

Critical conditions.

Example: Application component unavailable, unexpected exception.

* Visibility: **public**

#### Arguments

* $message **string**
* $context **array**



### \Piton\Common\Abstracts\Logger::error()

```
null Piton\Common\Abstracts\Logger::\Piton\Common\Abstracts\Logger::error()(string $message, array $context)
```

Runtime errors that do not require immediate action but should typically
be logged and monitored.



* Visibility: **public**

#### Arguments

* $message **string**
* $context **array**



### \Piton\Common\Abstracts\Logger::warning()

```
null Piton\Common\Abstracts\Logger::\Piton\Common\Abstracts\Logger::warning()(string $message, array $context)
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
null Piton\Common\Abstracts\Logger::\Piton\Common\Abstracts\Logger::notice()(string $message, array $context)
```

Normal but significant events.



* Visibility: **public**

#### Arguments

* $message **string**
* $context **array**



### \Piton\Common\Abstracts\Logger::info()

```
null Piton\Common\Abstracts\Logger::\Piton\Common\Abstracts\Logger::info()(string $message, array $context)
```

Interesting events.

Example: User logs in, SQL logs.

* Visibility: **public**

#### Arguments

* $message **string**
* $context **array**



### \Piton\Common\Abstracts\Logger::debug()

```
null Piton\Common\Abstracts\Logger::\Piton\Common\Abstracts\Logger::debug()(string $message, array $context)
```

Detailed debug information.



* Visibility: **public**

#### Arguments

* $message **string**
* $context **array**



### \Piton\Common\Abstracts\Logger::trace()

```
null Piton\Common\Abstracts\Logger::\Piton\Common\Abstracts\Logger::trace()(string $message, array $context)
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


