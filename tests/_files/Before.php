<?php

namespace sample;

use AopJoinpoint;
use SimpleAOP\Aspect\Before as BeforeAspect;

class Before extends BeforeAspect
{
    public function beforeCustom(AopJoinpoint $jp)
    {
        $jp->setArguments(array(' in progress'));
    }

    /**
     * Advice callback
     * @param AopJoinpoint $jp
     * @return mixed
     */
    public function before(AopJoinpoint $jp)
    {
        if($jp->getMethodName() === 'mirror') {
            $jp->setArguments(array('intercepted'));
        }
    }

    /**
     * Get the point cut selector
     * @return string
     */
    public function getPointCut()
    {
        return array(
            'sample\Business::custom()',
            'sample\Business::mirror()'
        );
    }
}
