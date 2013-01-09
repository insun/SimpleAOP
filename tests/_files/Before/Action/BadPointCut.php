<?php

namespace sample\Before\Action;

use SimpleAOP\Aspect\Before\Action as BeforeAspect;
use Zend\Stdlib\RequestInterface;
use Zend\EventManager\EventInterface;

class BadPointCut extends BeforeAspect
{
    public function before($action, RequestInterface $request, EventInterface $mvcEvent)
    {

    }

    public function getPointCut()
    {
        return 'sample\Business::*()';
    }
}
