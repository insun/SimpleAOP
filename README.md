ZF2 AOP module
============

Version 3.1.0 Created by [Vincent Blanchon](http://developpeur-zend-framework.fr/)

Introduction
------------

Simple AOP is a ZF2 module which use the [PHP AOP extension](https://github.com/AOP-PHP/AOP).
It's an additional solution to use AOP with PHP. This project can be an alternative of the excellent [Go! framework](https://github.com/lisachenko/go-aop-php).

Why I should use SimpleAOP in ZF2 ?
------------

Because you have to concentrate on your job !
Write in your controller only your business. Imagine, you want update a user in your controller, you want get the user id :

• Before SimpleAOP

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

• After SimpleAOP

```php
public function updateAction($userId = null)
{
    // here your business !
}

```

```php
use SimpleAOP\Advice\Before\Action as BeforeAdvice;

class ControllerCheckParams extends BeforeAdvice
{
    public function beforeUpdateAction($request, $mvcEvent)
    {
        $id = $mvcEvent->getRouteMatch()->getParam('id', null);
        if($id) {
            // throw exception
        }

        $service = $this->getServiceLocator()->get('service_user');
        $user = $service->getUser($id);
        if($user) {
            // throw exception
        }

        return array($id);
    }

    public function getPointCut()
    {
        return 'path\to\UserController::updateAction()'; 
    }
}

```
Learn more about AOP :
• [PHP AOP extension](https://github.com/AOP-PHP/AOP) [en]
• [Gerald's blod](http://www.croes.org/gerald/blog/aop-php-programmation-orientee-aspect/822/) [fr]
• [developpez.com](http://www.developpez.com/actu/46202/AOP-PHP-la-programmation-orientee-aspect-en-PHP-une-nouvelle-extension-PECL-est-disponible/) [fr]

Configuration
------------

The first step is to configure your application for SimpleAOP. Just add in your application.config.php :

```php
$aop = $this->getServiceLocator()->get('aop');
$aop->register(new MyBeforeAdvice());
```


Register your advice :

```php
$aop = $this->getServiceLocator()->get('aop');
$aop->register(new MyBeforeAdvice());
```

Or use the config :

```php
return array(
    'aop' => array(
        'my_before',
        'other',
        'controller_around',
        'service_after',
    ),
    'aop_plugins' => array(
        'invokables' => array(
            'my_before' => 'sample\Interceptor\MyBefore',
            'other_before' => 'path\to\OtherBefore',
            'controller_around' => 'sample\Interceptor\MyAround',
            'service_after' => 'sample\Interceptor\MyAfter',
        ),
    ),
);
```

You can use the "aop_plugins" entry or use the SimpleAOP\Feature\AopPluginProviderInterface in your Module.php.

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

The basic usage use classic advice. An exemple
with a before advice :

```php
use SimpleAOP\Advice\Before as BeforeAdvice;

class MyBeforeAdvice extends BeforeAdvice
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
with a before advice :

```php
use SimpleAOP\Advice\Before\Simple as BeforeAdvice;

class MyBeforeAdvice extends BeforeAdvice
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

An exemple with a after advice :
`
```php
use SimpleAOP\Advice\After\Simple as AfterAdvice;

class MyAfterAdvice extends AfterAdvice
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
with a before advice :

```php
use SimpleAOP\Advice\Before\Action as BeforeAdvice;

class MyBeforeAdvice extends BeforeAdvice
{
    public function beforeFooAction($request)
    {
        // here a custom advice to intercept the fooaction action method
    }

    public function before($request)
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