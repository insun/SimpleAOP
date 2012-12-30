<?php

namespace mock;

use SimpleAOP\Advice\After;

class FooAfter extends After
{
    public function after($return)
    {
        if($return === "foo") {
            return "bar";
        }
    }
}