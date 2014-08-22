Piton\Common\LoggerLevel
===============

Describes log levels




* Class name: LoggerLevel
* Namespace: Piton\Common



Constants
----------


### OFF

```
const OFF = -2147483647
```





### OFF_STR

```
const OFF_STR = 'OFF'
```





### FATAL

```
const FATAL = -1
```





### FATAL_STR

```
const FATAL_STR = 'FATAL'
```





### EMERGENCY

```
const EMERGENCY = 0
```





### EMERGENCY_STR

```
const EMERGENCY_STR = 'EMERGENCY'
```





### ALERT

```
const ALERT = 100
```





### ALERT_STR

```
const ALERT_STR = 'ALERT'
```





### CRITICAL

```
const CRITICAL = 200
```





### CRITICAL_STR

```
const CRITICAL_STR = 'CRITICAL'
```





### ERROR

```
const ERROR = 300
```





### ERROR_STR

```
const ERROR_STR = 'ERROR'
```





### WARNING

```
const WARNING = 400
```





### WARNING_STR

```
const WARNING_STR = 'WARNING'
```





### NOTICE

```
const NOTICE = 500
```





### NOTICE_STR

```
const NOTICE_STR = 'NOTICE'
```





### INFO

```
const INFO = 600
```





### INFO_STR

```
const INFO_STR = 'INFO'
```





### DEBUG

```
const DEBUG = 700
```





### DEBUG_STR

```
const DEBUG_STR = 'DEBUG'
```





### TRACE

```
const TRACE = 800
```





### TRACE_STR

```
const TRACE_STR = 'TRACE'
```





### ALL

```
const ALL = 2147483647
```





### ALL_STR

```
const ALL_STR = 'ALL'
```





Properties
----------


### $levelMap

```
private array $levelMap
```

Contains a list of instantiated levels.



* Visibility: **private**
* This property is **static**.


### $initializedMap

```
private boolean $initializedMap = false
```

Have we initialized the levelMap yet?



* Visibility: **private**
* This property is **static**.


### $levelStr

```
private string $levelStr
```

String representation of the level.



* Visibility: **private**


### $level

```
private integer $level
```

Integer level value.



* Visibility: **private**


### $doMapping

```
private boolean $doMapping = true
```

Whether we need to do the mappting or not



* Visibility: **private**
* This property is **static**.


Methods
-------


### \Piton\Common\LoggerLevel::findLevel()

```
\Piton\Common\LoggerLevel Piton\Common\LoggerLevel::\Piton\Common\LoggerLevel::findLevel()(mixed $level)
```

Find a level by either integer or string



* Visibility: **public**
* This method is **static**.

#### Arguments

* $level **mixed**



### \Piton\Common\LoggerLevel::getStandardLevelByName()

```
\Piton\Common\LoggerLevel Piton\Common\LoggerLevel::\Piton\Common\LoggerLevel::getStandardLevelByName()($name)
```

Get one of the standard logging levels by name.



* Visibility: **public**
* This method is **static**.

#### Arguments

* $name **mixed**



### \Piton\Common\LoggerLevel::equals()

```
boolean Piton\Common\LoggerLevel::\Piton\Common\LoggerLevel::equals()($level)
```

Compares two logger levels.



* Visibility: **public**

#### Arguments

* $level **mixed**



### \Piton\Common\LoggerLevel::isGreaterOrEqual()

```
boolean Piton\Common\LoggerLevel::\Piton\Common\LoggerLevel::isGreaterOrEqual()($level)
```

Returns <i>true</i> if this level has a higher or equal
level than the level passed as argument, <i>false</i>
otherwise.



* Visibility: **public**

#### Arguments

* $level **mixed**



### \Piton\Common\LoggerLevel::isLessThanOrEqual()

```
boolean Piton\Common\LoggerLevel::\Piton\Common\LoggerLevel::isLessThanOrEqual()($level)
```

Returns <i>true</i> if this level has a less or equal
level than the level passed as argument, <i>false</i>
otherwise.



* Visibility: **public**

#### Arguments

* $level **mixed**



### \Piton\Common\LoggerLevel::toString()

```
string Piton\Common\LoggerLevel::\Piton\Common\LoggerLevel::toString()()
```

Returns the string representation of this level.



* Visibility: **public**



### \Piton\Common\LoggerLevel::__toString()

```
string Piton\Common\LoggerLevel::\Piton\Common\LoggerLevel::__toString()()
```

Returns the string representation of this level.



* Visibility: **public**



### \Piton\Common\LoggerLevel::toInt()

```
integer Piton\Common\LoggerLevel::\Piton\Common\LoggerLevel::toInt()()
```

Returns the integer representation of this level.



* Visibility: **public**



### \Piton\Common\LoggerLevel::custom()

```
\Piton\Common\LoggerLevel Piton\Common\LoggerLevel::\Piton\Common\LoggerLevel::custom()($level, $levelStr)
```

Create a custom log level



* Visibility: **public**
* This method is **static**.

#### Arguments

* $level **mixed**
* $levelStr **mixed**



### \Piton\Common\LoggerLevel::__construct()

```
mixed Piton\Common\LoggerLevel::\Piton\Common\LoggerLevel::__construct()($level, $levelStr)
```

Our constructor, you can use common levels, or pass is some custom stuff!



* Visibility: **private**

#### Arguments

* $level **mixed**
* $levelStr **mixed**



### \Piton\Common\LoggerLevel::initLevelMap()

```
mixed Piton\Common\LoggerLevel::\Piton\Common\LoggerLevel::initLevelMap()()
```

Initializes the level map with the standard level
constants defined in the class.



* Visibility: **private**
* This method is **static**.



### \Piton\Common\LoggerLevel::checkMap()

```
\Piton\Common\LoggerLevel Piton\Common\LoggerLevel::\Piton\Common\LoggerLevel::checkMap()(integer $level, string $levelStr)
```

Checks the levelMap for the level, if it isn't there,
we construct the level, then put it in there. Finally,
return the level object.



* Visibility: **private**
* This method is **static**.

#### Arguments

* $level **integer**
* $levelStr **string**


