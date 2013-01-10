<?php

namespace SecondUseCase\Aspect;

use AopJoinpoint;
use SimpleAOP\Aspect\Around as AroundAspect;

class UnUsed2 extends AroundAspect
{
    public function around(AopJoinpoint $jp)
    {
        $jp->process();
        return 'error';
    }

    public function getPointCut()
    {
        return 'SecondUseCase\Controller\Bar*::*()';
    }
}
