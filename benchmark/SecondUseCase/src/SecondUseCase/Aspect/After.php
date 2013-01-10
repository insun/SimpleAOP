<?php

namespace SecondUseCase\Aspect;

use SimpleAOP\Aspect\After\Action as AfterAspect;
use Zend\Stdlib\RequestInterface;
use Zend\EventManager\EventInterface;

class After extends AfterAspect
{
    public function after($model)
    {
        return $model . ' overrided';
    }

    public function getPointCut()
    {
        return 'SecondUseCase\Controller\TestController::*Action()';
    }
}
