<?php

namespace sample\After;

use SimpleAOP\Aspect\After\Simple as AfterAspect;

class Simple extends AfterAspect
{
    public function afterCustom($return)
    {
        return "customisation in progress";
    }

    public function after($return)
    {
        $jp = $this->getJoinPoint();
        return $jp->getReturnedValue() . " is overrided";
    }

    public function getPointCut()
    {
        return 'sample\Business::*()';
    }
}
