<?php

namespace SecondUseCase\Aspect;

use SimpleAOP\Aspect\Before\Action as BeforeAspect;
use Zend\Stdlib\RequestInterface;
use Zend\EventManager\EventInterface;

class Before extends BeforeAspect
{
    public function before($action, RequestInterface $request, EventInterface $event)
    {
        $msg = 'success';
        return array($msg);
    }

    public function getPointCut()
    {
        return 'SecondUseCase\Controller\*::*Action()';
    }
}
