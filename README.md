ZF2 AOP module
============

Version 0.0.1 Created by [Vincent Blanchon](http://developpeur-zend-framework.fr/)

Introduction
------------

Simple AOP is a ZF2 module which use the [PHP AOP extension](https://github.com/AOP-PHP/AOP).
It's an additional solution to use AOP with PHP. This project can be an alternative of the excellent [Go! framework](https://github.com/lisachenko/go-aop-php).

Usage
------------

Create your advice :

```php
use SimpleAOP\Advice\Before;

class MyBeforeAdvice extends Before
{
    public function beforeFoo($arg1, $arg2)
    {
        // here a custom advice to intercept the foo method
    }

    public function before($method, array $arguments = array())
    {
        // here a generic advice
    }
}
```

On your own business class :

```php
use SimpleAOP\Advice\Before;

class MyBusiness
{
    public function foo($arg1, $arg2)
    {
        // your code
    }
}
```

Register your advice :

```php
$aop = $this->getServiceLocator()->get('aop');
$aop->register('MyBusiness::*()', new MyBeforeAdvice());
```

Or use the config :

```php
return array(
    'aop' => array(
        'Foo::foo()' => 'mock\FooBefore',
    ),
);
```
