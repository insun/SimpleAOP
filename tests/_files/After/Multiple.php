<?php

namespace sample\After;

use AopJoinpoint;
use SimpleAOP\Aspect\After as AfterAspect;

class Multiple extends AfterAspect
{
    public function after(AopJoinpoint $jp)
    {
        $jp->setReturnedValue($jp->getReturnedValue() . " is overrided");
    }

    public function getPointCut()
    {
        return array(
            'sample\Business::mirror()',
            'sample\Business::bar()'
        );
    }
}
