<?php

namespace sample\Before;

use SimpleAOP\Advice\Before\Simple as BeforeAdvice;

class Simple extends BeforeAdvice
{
    /**
     * Before advice
     * @param string $method
     * @param array $arguments
     * @param object $target
     */
    public function before($method, array $arguments = array(), $target = null)
    {
        if($method === 'mirror') {
            $jp = $this->getJoinPoint();
            $jp->setArguments(array('intercepted'));
        }
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