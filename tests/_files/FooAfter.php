<?php

namespace mock;

use SimpleAOP\Advice\After\Simple as AfterAdvice;

class FooAfter extends AfterAdvice
{
    public function after($return)
    {
        if($return === "foo") {
            return "bar";
        }
    }
}