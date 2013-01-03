<?php

namespace mock;

use SimpleAOP\Advice\After;

class FooAfter extends After
{
    /**
     * After advice
     * @param AopJoinpoint $jp
     */
    public function after(AopJoinpoint $jp)
    {
        if($jp->getReturnedValue() === "foo") {
            return "bar";
        }
    }
    
    /**
     * Get the point cut selector
     * @return string
     */
    public function getPointCut()
    {
        return 'mock\After\Foo::foo()';
    }
}