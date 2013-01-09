<?php

namespace sample\Around\Action;

use SimpleAOP\Aspect\Around\Action as AroundAspect;
use Zend\Stdlib\RequestInterface;
use Zend\EventManager\EventInterface;

class BadPointCut extends AroundAspect
{
    public function around($action, RequestInterface $request, EventInterface $event)
    {

    }

    public function getPointCut()
    {
        return 'sample\Business::*()';
    }
}
