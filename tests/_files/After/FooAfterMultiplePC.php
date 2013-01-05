<?php

namespace sample\After;

use AopJoinpoint;
use SimpleAOP\Advice\After;

class FooAfterMultiplePC extends After
{
    /**
     * After advice
     * @param AopJoinpoint $jp
     */
    public function after(AopJoinpoint $jp)
    {
        $jp->setReturnedValue($jp->getReturnedValue() . " is overrided");
    }
    
    /**
     * Get the point cut selector
     * @return string
     */
    public function getPointCut()
    {
        return array('sample\After\Foo::foo()', 'sample\After\Foo::bar()');
    }
}