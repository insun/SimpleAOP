<?php

namespace sample\After\Action;

use SimpleAOP\Aspect\After\Action as AfterAspect;

class BadPointCut extends AfterAspect
{
    public function after($model)
    {

    }

    public function getPointCut()
    {
        return 'sample\Business::*()';
    }
}
