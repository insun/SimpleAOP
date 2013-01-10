<?php

namespace SecondUseCase\Aspect;

use AopJoinpoint;
use SimpleAOP\Aspect\After as AfterAspect;

class UnUsed3 extends AfterAspect
{
    public function after(AopJoinpoint $jp)
    {
        return 'error';
    }

    public function getPointCut()
    {
        return 'SecondUseCase\Controller\Foo*::*()';
    }
}
