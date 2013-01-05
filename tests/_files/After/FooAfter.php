<?php

namespace sample\After;

use AopJoinpoint;
use SimpleAOP\Advice\After;

class FooAfter extends After
{
    /**
     * After advice for custom method
     * @param AopJoinpoint $jp
     */
    public function afterCustom(AopJoinpoint $jp)
    {
        $jp->setReturnedValue("customisation in progress");
    }
    
    /**
     * After advice
     * @param AopJoinpoint $jp
     */
    public function after(AopJoinpoint $jp)
    {
        if($jp->getReturnedValue() === "foo") {
            $jp->setReturnedValue($jp->getReturnedValue() . " is overrided");
        }
    }
    
    /**
     * Get the point cut selector
     * @return string
     */
    public function getPointCut()
    {
        return 'sample\After\Foo::*()';
    }
}