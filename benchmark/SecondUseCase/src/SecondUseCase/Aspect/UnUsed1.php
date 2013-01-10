<?php

namespace SecondUseCase\Aspect;

use AopJoinpoint;
use SimpleAOP\Aspect\Before as BeforeAspect;

class UnUsed1 extends BeforeAspect
{
    public function before(AopJoinpoint $jp)
    {
        $jp->setArguments(array('error'));
    }

    public function getPointCut()
    {
        return 'SecondUseCase\Controller\Baz*::*()';
    }
}
