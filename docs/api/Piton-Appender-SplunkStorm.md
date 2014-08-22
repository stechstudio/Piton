Piton\Appender\SplunkStorm
===============

This is where the magic happens! We use this class to actually
send log events to SplunkStorm via API.




* Class name: SplunkStorm
* Namespace: Piton\Appender
* Parent class: [Piton\Common\Abstracts\Appender](Piton-Common-Abstracts-Appender.md)





Properties
----------


### $apiHost

```
protected string $apiHost = null
```

Splunk API Host Name



* Visibility: **protected**


### $projectID

```
protected string $projectID = null
```

Splunk Project ID



* Visibility: **protected**


### $accessToken

```
protected string $accessToken = null
```

Splunk Project Access Token



* Visibility: **protected**


### $apiVersion

```
protected \Piton\Appender\number $apiVersion = 1
```

Splunk API Version to use



* Visibility: **protected**


### $apiEndpoint

```
protected string $apiEndpoint = 'inputs/http'
```

Splunk API End Point



* Visibility: **protected**


### $urlScheme

```
protected string $urlScheme = 'https'
```

Splunk API URL Scheme



* Visibility: **protected**


### $sourcetype

```
protected string $sourcetype = 'generic_single_line'
```

Splunk Source Type



* Visibility: **protected**


### $client

```
protected \GuzzleHttp\Client $client
```

The Guzzle Client for HTTP Requests.



* Visibility: **protected**


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


### \Piton\Appender\SplunkStorm::__construct()

```
mixed Piton\Appender\SplunkStorm::\Piton\Appender\SplunkStorm::__construct()(string $name, string $target, array $context)
```

Constructor



* Visibility: **public**

#### Arguments

* $name **string** - &lt;p&gt;This appenders name&lt;/p&gt;
* $target **string** - &lt;p&gt;The API Host&lt;/p&gt;
* $context **array** - &lt;p&gt;Extra information for the appender&lt;/p&gt;



### \Piton\Appender\SplunkStorm::configure()

```
mixed Piton\Appender\SplunkStorm::\Piton\Appender\SplunkStorm::configure()(array $context)
```

Handles additional configuration of context specific settings.



* Visibility: **public**

#### Arguments

* $context **array**



### \Piton\Appender\SplunkStorm::__destruct()

```
mixed Piton\Appender\SplunkStorm::\Piton\Appender\SplunkStorm::__destruct()()
```

Destructor



* Visibility: **public**



### \Piton\Appender\SplunkStorm::getUrl()

```
string Piton\Appender\SplunkStorm::\Piton\Appender\SplunkStorm::getUrl()()
```

Take all those variables, and make me a nice URL to use



* Visibility: **protected**



### \Piton\Appender\SplunkStorm::getClient()

```
\GuzzleHttp\Client Piton\Appender\SplunkStorm::\Piton\Appender\SplunkStorm::getClient()()
```

At some point, we are going to want an HTTP Client



* Visibility: **protected**



### \Piton\Appender\SplunkStorm::setClient()

```
mixed Piton\Appender\SplunkStorm::\Piton\Appender\SplunkStorm::setClient()(\GuzzleHttp\Client $client)
```

Allow injecting a custom client



* Visibility: **public**

#### Arguments

* $client **GuzzleHttp\Client**



### \Piton\Appender\SplunkStorm::getName()

```
string Piton\Appender\SplunkStorm::\Piton\Appender\SplunkStorm::getName()()
```

Get the name



* Visibility: **public**



### \Piton\Common\Abstracts\Appender::__construct()

```
mixed Piton\Appender\SplunkStorm::\Piton\Common\Abstracts\Appender::__construct()(string $name, string $target, array $context)
```

The constructor signature will be



* Visibility: **public**

#### Arguments

* $name **string** - &lt;p&gt;The Name of this Appender&lt;/p&gt;
* $target **string** - &lt;p&gt;The Logging Target for this Appender&lt;/p&gt;
* $context **array** - &lt;p&gt;Any additional information for this Appender&lt;/p&gt;



### \Piton\Common\Abstracts\Appender::__destruct()

```
mixed Piton\Appender\SplunkStorm::\Piton\Common\Abstracts\Appender::__destruct()()
```

Gracefully handle destroying any connections, file pointers, resources, etc.



* Visibility: **public**



### \Piton\Common\Abstracts\Appender::interpolate()

```
mixed Piton\Appender\SplunkStorm::\Piton\Common\Abstracts\Appender::interpolate()($message, array $context)
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
string Piton\Appender\SplunkStorm::\Piton\Common\Abstracts\Appender::getName()()
```

Gets the name



* Visibility: **public**



### \Piton\Common\Abstracts\Appender::setName()

```
string Piton\Appender\SplunkStorm::\Piton\Common\Abstracts\Appender::setName()($name)
```

Sets the Name



* Visibility: **public**

#### Arguments

* $name **mixed**



### \Piton\Common\Abstracts\Appender::getTarget()

```
string Piton\Appender\SplunkStorm::\Piton\Common\Abstracts\Appender::getTarget()()
```

Gets the target



* Visibility: **public**



### \Piton\Common\Abstracts\Appender::setTarget()

```
string Piton\Appender\SplunkStorm::\Piton\Common\Abstracts\Appender::setTarget()($target)
```

Sets the target



* Visibility: **public**

#### Arguments

* $target **mixed**



### \Piton\Common\Abstracts\Appender::getContext()

```
array Piton\Appender\SplunkStorm::\Piton\Common\Abstracts\Appender::getContext()()
```

Gets the context



* Visibility: **public**



### \Piton\Common\Abstracts\Appender::setContext()

```
array Piton\Appender\SplunkStorm::\Piton\Common\Abstracts\Appender::setContext()(array $context)
```

Sets the context



* Visibility: **public**

#### Arguments

* $context **array**



### \Piton\Common\Abstracts\Appender::configure()

```
mixed Piton\Appender\SplunkStorm::\Piton\Common\Abstracts\Appender::configure()(array $context)
```

Handles any configuration of context specific settings.



* Visibility: **public**

#### Arguments

* $context **array**



### \Piton\Common\Abstracts\Appender::verifyArrayKey()

```
boolean Piton\Appender\SplunkStorm::\Piton\Common\Abstracts\Appender::verifyArrayKey()(string $key, array $array, string $method)
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


