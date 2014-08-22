Piton\Common\Abstracts\Appender
===============

Class Appender helps our appender code use.




* Class name: Appender
* Namespace: Piton\Common\Abstracts
* This is an **abstract** class
* This class implements: [Piton\Common\Interfaces\Appender](Piton-Common-Interfaces-Appender.md)




Properties
----------


### $name

```
protected string $name
```

Friendly name of this Appender for easy reference



* Visibility: **protected**


### $target

```
protected string $target
```

String representation of the target of this appender
Perhaps the file name, the stream, or the URL



* Visibility: **protected**


### $context

```
protected array $context
```

Any additional contextual information the appender needs
in order to perform its duties.



* Visibility: **protected**


Methods
-------


### \Piton\Common\Abstracts\Appender::__construct()

```
mixed Piton\Common\Abstracts\Appender::\Piton\Common\Abstracts\Appender::__construct()(string $name, string $target, array $context)
```

The constructor signature will be



* Visibility: **public**

#### Arguments

* $name **string** - &lt;p&gt;The Name of this Appender&lt;/p&gt;
* $target **string** - &lt;p&gt;The Logging Target for this Appender&lt;/p&gt;
* $context **array** - &lt;p&gt;Any additional information for this Appender&lt;/p&gt;



### \Piton\Common\Abstracts\Appender::__destruct()

```
mixed Piton\Common\Abstracts\Appender::\Piton\Common\Abstracts\Appender::__destruct()()
```

Gracefully handle destroying any connections, file pointers, resources, etc.



* Visibility: **public**



### \Piton\Common\Abstracts\Appender::interpolate()

```
mixed Piton\Common\Abstracts\Appender::\Piton\Common\Abstracts\Appender::interpolate()($message, array $context)
```

Interpolates context values into the message placeholders.

Taken from PSR-3's example implementation.

**WARNING**
It is important that interpolate does not throw an
exception or error or anyway interrupt operations. It must
always fail silently and keep churning!

* Visibility: **protected**

#### Arguments

* $message **mixed**
* $context **array**



### \Piton\Common\Abstracts\Appender::getName()

```
string Piton\Common\Abstracts\Appender::\Piton\Common\Abstracts\Appender::getName()()
```

Gets the name



* Visibility: **public**



### \Piton\Common\Abstracts\Appender::setName()

```
string Piton\Common\Abstracts\Appender::\Piton\Common\Abstracts\Appender::setName()($name)
```

Sets the Name



* Visibility: **public**

#### Arguments

* $name **mixed**



### \Piton\Common\Abstracts\Appender::getTarget()

```
string Piton\Common\Abstracts\Appender::\Piton\Common\Abstracts\Appender::getTarget()()
```

Gets the target



* Visibility: **public**



### \Piton\Common\Abstracts\Appender::setTarget()

```
string Piton\Common\Abstracts\Appender::\Piton\Common\Abstracts\Appender::setTarget()($target)
```

Sets the target



* Visibility: **public**

#### Arguments

* $target **mixed**



### \Piton\Common\Abstracts\Appender::getContext()

```
array Piton\Common\Abstracts\Appender::\Piton\Common\Abstracts\Appender::getContext()()
```

Gets the context



* Visibility: **public**



### \Piton\Common\Abstracts\Appender::setContext()

```
array Piton\Common\Abstracts\Appender::\Piton\Common\Abstracts\Appender::setContext()(array $context)
```

Sets the context



* Visibility: **public**

#### Arguments

* $context **array**



### \Piton\Common\Abstracts\Appender::configure()

```
mixed Piton\Common\Abstracts\Appender::\Piton\Common\Abstracts\Appender::configure()(array $context)
```

Handles any configuration of context specific settings.



* Visibility: **public**

#### Arguments

* $context **array**



### \Piton\Common\Abstracts\Appender::verifyArrayKey()

```
boolean Piton\Common\Abstracts\Appender::\Piton\Common\Abstracts\Appender::verifyArrayKey()(string $key, array $array, string $method)
```

Utility function to help verify arguments.



* Visibility: **protected**

#### Arguments

* $key **string**
* $array **array**
* $method **string**



### \Piton\Common\Interfaces\Appender::__construct()

```
mixed Piton\Common\Interfaces\Appender::\Piton\Common\Interfaces\Appender::__construct()(string $name, string $target, array $context)
```

The constructor signature will be



* Visibility: **public**
* This method is defined by [Piton\Common\Interfaces\Appender](Piton-Common-Interfaces-Appender.md)

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
* This method is defined by [Piton\Common\Interfaces\Appender](Piton-Common-Interfaces-Appender.md)



### \Piton\Common\Interfaces\Appender::getName()

```
string Piton\Common\Interfaces\Appender::\Piton\Common\Interfaces\Appender::getName()()
```

Gets the name



* Visibility: **public**
* This method is defined by [Piton\Common\Interfaces\Appender](Piton-Common-Interfaces-Appender.md)



### \Piton\Common\Interfaces\Appender::setName()

```
string Piton\Common\Interfaces\Appender::\Piton\Common\Interfaces\Appender::setName()($name)
```

Sets the Name



* Visibility: **public**
* This method is defined by [Piton\Common\Interfaces\Appender](Piton-Common-Interfaces-Appender.md)

#### Arguments

* $name **mixed**



### \Piton\Common\Interfaces\Appender::getTarget()

```
string Piton\Common\Interfaces\Appender::\Piton\Common\Interfaces\Appender::getTarget()()
```

Gets the target



* Visibility: **public**
* This method is defined by [Piton\Common\Interfaces\Appender](Piton-Common-Interfaces-Appender.md)



### \Piton\Common\Interfaces\Appender::setTarget()

```
string Piton\Common\Interfaces\Appender::\Piton\Common\Interfaces\Appender::setTarget()($target)
```

Sets the target



* Visibility: **public**
* This method is defined by [Piton\Common\Interfaces\Appender](Piton-Common-Interfaces-Appender.md)

#### Arguments

* $target **mixed**



### \Piton\Common\Interfaces\Appender::getContext()

```
array Piton\Common\Interfaces\Appender::\Piton\Common\Interfaces\Appender::getContext()()
```

Gets the context



* Visibility: **public**
* This method is defined by [Piton\Common\Interfaces\Appender](Piton-Common-Interfaces-Appender.md)



### \Piton\Common\Interfaces\Appender::setContext()

```
array Piton\Common\Interfaces\Appender::\Piton\Common\Interfaces\Appender::setContext()(array $context)
```

Sets the context



* Visibility: **public**
* This method is defined by [Piton\Common\Interfaces\Appender](Piton-Common-Interfaces-Appender.md)

#### Arguments

* $context **array**



### \Piton\Common\Interfaces\Appender::configure()

```
mixed Piton\Common\Interfaces\Appender::\Piton\Common\Interfaces\Appender::configure()(array $context)
```

Handles any configuration of context specific settings.



* Visibility: **public**
* This method is defined by [Piton\Common\Interfaces\Appender](Piton-Common-Interfaces-Appender.md)

#### Arguments

* $context **array**


