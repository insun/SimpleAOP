<?php

namespace mock;

use SimpleAOP\Advice\Before\Simple as BeforeAdvice;

class FooBefore extends BeforeAdvice
{
    public function before($method, array $arguments = array())
    {
        if($method === "foo") {
            return array("bar", "baz");
        }
    }
}