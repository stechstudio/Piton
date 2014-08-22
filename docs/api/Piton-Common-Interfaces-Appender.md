Piton\Common\Interfaces\Appender
===============

Interface for Appender API Consistency




* Interface name: Appender
* Namespace: Piton\Common\Interfaces
* This is an **interface**






Methods
-------


### \Piton\Common\Interfaces\Appender::__construct()

```
mixed Piton\Common\Interfaces\Appender::\Piton\Common\Interfaces\Appender::__construct()(string $name, string $target, array $context)
```

The constructor signature will be



* Visibility: **public**

#### Arguments

* $name **string** - &lt;p&gt;The Name of this Appender&lt;/p&gt;
* $target **string** - &lt;p&gt;The Logging Target for this Appender&lt;/p&gt;
* $context **array** - &lt;p&gt;Any additional information for this Appender&lt;/p&gt;



### \Piton\Common\Interfaces\Appender::__destruct()

```
mixed Piton\Common\Interfaces\Appender::\Piton\Common\Interfaces\Appender::__destruct()()
```

Gracefully handle destroying any connections, file pointers, resources, etc.



* Visibility: **public**



### \Piton\Common\Interfaces\Appender::getName()

```
string Piton\Common\Interfaces\Appender::\Piton\Common\Interfaces\Appender::getName()()
```

Gets the name



* Visibility: **public**



### \Piton\Common\Interfaces\Appender::setName()

```
string Piton\Common\Interfaces\Appender::\Piton\Common\Interfaces\Appender::setName()($name)
```

Sets the Name



* Visibility: **public**

#### Arguments

* $name **mixed**



### \Piton\Common\Interfaces\Appender::getTarget()

```
string Piton\Common\Interfaces\Appender::\Piton\Common\Interfaces\Appender::getTarget()()
```

Gets the target



* Visibility: **public**



### \Piton\Common\Interfaces\Appender::setTarget()

```
string Piton\Common\Interfaces\Appender::\Piton\Common\Interfaces\Appender::setTarget()($target)
```

Sets the target



* Visibility: **public**

#### Arguments

* $target **mixed**



### \Piton\Common\Interfaces\Appender::getContext()

```
array Piton\Common\Interfaces\Appender::\Piton\Common\Interfaces\Appender::getContext()()
```

Gets the context



* Visibility: **public**



### \Piton\Common\Interfaces\Appender::setContext()

```
array Piton\Common\Interfaces\Appender::\Piton\Common\Interfaces\Appender::setContext()(array $context)
```

Sets the context



* Visibility: **public**

#### Arguments

* $context **array**



### \Piton\Common\Interfaces\Appender::configure()

```
mixed Piton\Common\Interfaces\Appender::\Piton\Common\Interfaces\Appender::configure()(array $context)
```

Handles any configuration of context specific settings.



* Visibility: **public**

#### Arguments

* $context **array**


