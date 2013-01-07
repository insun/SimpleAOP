<?php

namespace sample;

use AopJoinpoint;
use SimpleAOP\Aspect\Around as AroundAspect;

class Around extends AroundAspect
{
    public function aroundCustom(AopJoinpoint $jp)
    {
        $jp->setReturnedValue("customisation in progress");
    }

    /**
     * Advice callback
     * @param AopJoinpoint $jp
     * @return mixed
     */
    public function around(AopJoinpoint $jp)
    {
        if($jp->getMethodName() === 'mirror') {
            $jp->setArguments(array('intercepted'));
        }

        $jp->process();

        if($jp->getMethodName() === 'mirror') {
            $jp->setReturnedValue($jp->getReturnedValue() . " is overrided");
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
