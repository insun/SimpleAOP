<?php

namespace sample\Before;

use AopJoinpoint;
use SimpleAOP\Advice\Before;

class FooBefore extends Before
{
    /**
     * Advice callback
     * @param AopJoinpoint $jp
     * @return mixed
     */
    public function before(AopJoinpoint $jp)
    {
        if($jp->getMethodName() === 'foo') {
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