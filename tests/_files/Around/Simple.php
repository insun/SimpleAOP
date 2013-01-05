<?php

namespace sample\Around;

use SimpleAOP\Advice\Around\Simple as AroundAdvice;

class Simple extends AroundAdvice
{
    /**
     * Around advice
     * @param string $method
     * @param array $arguments
     * @param object $target
     */
    public function around($method, array $arguments = array(), $target = null)
    {
        $jp = $this->getJoinPoint();
        if($method === 'mirror') {
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
        return 'sample\Business::mirror()';
    }
}