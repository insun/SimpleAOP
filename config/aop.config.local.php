<?php

return array(
    'aop' => array(
        'Foo::foo()' => 'mock\FooBefore',
        'Foo::bar()' => 'mock\FooAround',
        'Foo::baz()' => 'mock\FooAfter',
    ),
);