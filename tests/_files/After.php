<?php

namespace sample;

use AopJoinpoint;
use SimpleAOP\Aspect\After as AfterAspect;

class After extends AfterAspect
{
    public function afterCustom(AopJoinpoint $jp)
    {
        $jp->setReturnedValue("customisation in progress");
    }

    public function after(AopJoinpoint $jp)
    {
        if($jp->getReturnedValue() === "foo") {
            $jp->setReturnedValue($jp->getReturnedValue() . " is overrided");
        }
    }

    public function getPointCut()
    {
        return 'sample\Business::*()';
    }
}
