ZF2 AOP module
============

Master: [![Build Status](https://travis-ci.org/blanchonvincent/SimpleAOP.png?branch=master)](https://travis-ci.org/blanchonvincent/SimpleAOP)

Version 0.4.0 Created by [Vincent Blanchon](http://developpeur-zend-framework.fr/)

Introduction
------------

Simple AOP is a ZF2 module which use the [PHP AOP extension](https://github.com/AOP-PHP/AOP). Supported version : 0.3.0.
It's an additional solution to use AOP with PHP. This project can be an alternative of the excellent [Go! framework](https://github.com/lisachenko/go-aop-php).

Why I should use SimpleAOP in ZF2 ?
------------

Because you have to concentrate on your job !
Write in your controller only your business. Imagine, you want update a user in your controller, you want get the user id :

* Before SimpleAOP

```php
public function updateAction()
{
    $userId = $this->getEvent()->getRouteMatch()->getParam('id', null);
    if($userId) {
        // throw exception
    }

    $service = $this->getServiceLocator()->get('service_user');
    $user = $service->getUser($userId);
    if($user) {
        // throw exception
    }

    // here your business !
}
```

* After SimpleAOP

```php
public function updateAction($userId = null)
{
    // here your business !
}

```

```php
use SimpleAOP\Aspect\Before\Action as BeforeAspect;

class ControllerCheckParams extends BeforeAspect
{
    public function beforeUpdateAction($request, $mvcEvent)
    {
        $userId = $mvcEvent->getRouteMatch()->getParam('id', null);
        if($userId) {
            // throw exception
        }

        $service = $this->getServiceLocator()->get('service_user');
        $user = $service->getUser($userId);
        if($user) {
            // throw exception
        }

        return array($userId);
    }

    public function getPointCut()
    {
        return 'path\to\UserController::updateAction()'; 
    }
}

```
Learn more about AOP :
* [PHP AOP extension](https://github.com/AOP-PHP/AOP) [en]
* [Gerald's blod](http://www.croes.org/gerald/blog/aop-php-programmation-orientee-aspect/822/) [fr]
* [developpez.com](http://www.developpez.com/actu/46202/AOP-PHP-la-programmation-orientee-aspect-en-PHP-une-nouvelle-extension-PECL-est-disponible/) [fr]

Configuration
------------

The first step is to configure your application for SimpleAOP. Just add in your application.config.php :

```php
return array(
    'modules' => array(
        'SimpleAOP', // enable your module
    ),
    // provide interface to configure your AOP
    'service_listener_options' => array(
        array(
            'service_manager' => 'AspectPluginManager',
            'config_key' => 'aop_aspects',
            'interface' => 'SimpleAOP\Feature\AopAspectProviderInterface',
            'method' => 'getAopAspectConfig',
        ),
    ),
    'service_manager' => array(
        'invokables' => array(
            'AspectPluginManager' => 'SimpleAOP\AspectPluginManager',
        ),
    ),
);
```

Register with the config :

```php
return array(
    'aop' => array(
        'my_before',
        'other',
        'controller_around',
        'service_after',
    ),
    'aop_aspects' => array(
        'invokables' => array(
            'my_before' => 'sample\Interceptor\MyBefore',
            'other_before' => 'path\to\OtherBefore',
            'controller_around' => 'sample\Interceptor\MyAround',
            'service_after' => 'sample\Interceptor\MyAfter',
        ),
    ),
);
```

You can use your Module to define the aspects :

```php
return array(
    'aop' => array(
        'my_before',
        'other',
        'controller_around',
        'service_after',
    ),
);
```

```php
class Module implements AopAspectProviderInterface
{
    public function getAopAspectConfig()
    {
        return array(
            'invokables' => array(
                'my_before' => 'sample\Interceptor\MyBefore',
                'other_before' => 'path\to\OtherBefore',
                'controller_around' => 'sample\Interceptor\MyAround',
                'service_after' => 'sample\Interceptor\MyAfter',
            ),
        );
    }
}
```

Or in your code :

```php
$aop = $this->getServiceLocator()->get('aop');
$aop->register(new MyBeforeAspect());
```

You can use the "aop_aspects" entry or use the SimpleAOP\Feature\AopAspectProviderInterface in your Module.php.

In the configuration, you must define all your interceptor. The selector will be defined in the method by the getPointCut method :

```php
class MyAfter extends After
{
    // define here your advice

    /**
     * Get the point cut selector
     * @return string
     */
    public function getPointCut()
    {
        return 'path\to\my\class::*()';
    }
}
```

You can use an array if necessary :

```php
class MyAfter extends After
{
    // define here your advice

    /**
     * Get the point cut selector
     * @return string
     */
    public function getPointCut()
    {
        return array(
            'path\to\my\class::*()',
            'path\to\my\service::connect*()'
        );
    }
}
```

Basic usage
------------

The basic usage use classic aspect. An exemple
with a before joint point :

```php
use SimpleAOP\Aspect\Before as BeforeAspect;

class MyBeforeAspect extends BeforeAspect
{
    public function beforeFoo(AopJoinpoint $jp)
    {
        // here a custom advice to intercept the foo method
    }

    public function before(AopJoinpoint $jp)
    {
        // here a generic advice, all methods which not override with custom interceptor
        // will be intercepted here
    }
}
```

Usage with formatted advice
------------

An other usage format the arguments to have pretty advice. An exemple
with a before joint point :

```php
use SimpleAOP\Aspect\Before\Simple as BeforeAspect;

class MyBeforeAspect extends BeforeAspect
{
    public function beforeFoo($arg1, $arg2)
    {
        // here a custom advice to intercept the foo method
    }

    public function before($method, array $arguments = array(), $target = null)
    {
        // here a generic advice, all methods which not override with custom interceptor
        // will be intercepted here
    }
}
```

An exemple with a after joint point :

```php
use SimpleAOP\Aspect\After\Simple as AfterAspect;

class MyAfterAspect extends AfterAspect
{
    public function afterFoo($return)
    {
        // here a custom advice to intercept the foo method

        return 'new value'; // new value will be automatically override the foo() returned value
    }

    public function after($return)
    {
        // here a generic advice, all methods which not override with custom interceptor
        // will be intercepted here
    }
}
```

Usage with the ZF2 controllers
------------

The usage with ZF2 controllers format the arguments to provide request object. An exemple
with a before before joint point :

```php
use SimpleAOP\Aspect\Before\Action as BeforeAspect;

class MyBeforeAspect extends BeforeAspect
{
    public function beforeFooAction($request, $mvcEvent)
    {
        // here a custom advice to intercept the fooaction action method
    }

    public function before($request, $mvcEvent)
    {
        // here a generic advice to intercept all other methods
    }

    public function getPointCut()
    {
        return 'path\to\my\controller::*Action()'; // you can easily filter by action
    }
}
```

The action methods have no parameters, but the application request is passed in 
argument to make life easier for developer.
