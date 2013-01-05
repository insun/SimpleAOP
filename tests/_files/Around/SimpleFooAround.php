<?php

namespace sample\Around;

use AopJoinpoint;
use SimpleAOP\Advice\Around\Simple as Around;

class SimpleFooAround extends Around
{
    /**
     * Around advice
     * @param string $method
     * @param array $arguments
     * @param object $target
     */
    public function around($method, array $arguments = array(), $target = null)
    {
        if($method === 'foo') {
            $jp = $this->getJoinPoint();
            $jp->setArguments(array('before', 'intercepted'));
        }
        
        $jp->process();
        $return = $jp->getReturnedValue();
        
        return  $return . " is overrided";
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