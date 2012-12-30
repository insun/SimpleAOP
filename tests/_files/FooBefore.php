<?php

namespace mock;

use SimpleAOP\Advice\Before;

class FooBefore extends Before
{
    public function before($method, array $arguments = array())
    {
        if($method === "foo") {
            return array("bar", "baz");
        }
    }
}