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

    public function before(AopJoinpoint $jp)
    {
        if($jp->getMethodName() === 'mirror') {
            $jp->setArguments(array('intercepted'));
        }
    }

    public function getPointCut()
    {
        return array(
            'sample\Business::custom()',
            'sample\Business::mirror()'
        );
    }
}
