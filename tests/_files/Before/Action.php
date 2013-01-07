<?php

namespace sample\Before;

use SimpleAOP\Aspect\Before\Action as BeforeAspect;
use Zend\Stdlib\RequestInterface;
use Zend\EventManager\EventInterface;

class Action extends BeforeAspect
{
    public function beforeCustomAction(RequestInterface $request, EventInterface $mvcEvent)
    {
        $request->setMetadata('param1', 'custom in progress');
    }

    public function before($action, RequestInterface $request, EventInterface $mvcEvent)
    {
        if($action === 'fooAction') {
            $request->setMetadata('param1', 'foo action is intercepted');
            $id = 'bar';
            return array($id);
        }
    }

    public function getPointCut()
    {
        return 'sample\Business::*Action()';
    }
}
