<?php

namespace sample\Before\Simple;

use AopJoinpoint;
use SimpleAOP\Advice\Before\Simple as Before;

class FooBefore extends Before
{
    /**
     * Before advice
     * @param string $method
     * @param array $arguments
     * @param object $target
     */
    public function before($method, array $arguments = array(), $target = null)
    {
        if($method === 'foo') {
            $jp = $this->getJoinPoint();
            $jp->setArguments(array('before', 'intercepted'));
        }
    }
    
    /**
     * Get the point cut selector
     * @return string
     */
    public function getPointCut()
    {
        return 'sample\Before\Foo::foo()';
    }
}