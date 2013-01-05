<?php

namespace sample\Around;

use AopJoinpoint;
use SimpleAOP\Advice\Around;

class FooAround extends Around
{
    /**
     * Advice callback
     * @param AopJoinpoint $jp
     * @return mixed
     */
    public function around(AopJoinpoint $jp)
    {
        if($jp->getMethodName() === 'foo') {
            $jp->setArguments(array('before', 'intercepted'));
        }
        
        $jp->process();
        
        if($jp->getMethodName() === 'foo') {
            $jp->setReturnedValue($jp->getReturnedValue() . " is overrided");
        }
    }
    
    /**
     * Get the point cut selector
     * @return string
     */
    public function getPointCut()
    {
        return 'sample\Around\Foo::foo()';
    }
}