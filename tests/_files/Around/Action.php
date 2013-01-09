<?php

namespace sample\Around;

use SimpleAOP\Aspect\Around\Action as AroundAspect;
use Zend\Stdlib\RequestInterface;
use Zend\EventManager\EventInterface;

class Action extends AroundAspect
{
    public function aroundCustomAction(RequestInterface $request, EventInterface $event)
    {
        $args = implode('', $this->getJoinPoint()->getArguments());
        $request->setMetadata('param1', 'custom in progress' . $args);
    }

    public function around($action, RequestInterface $request, EventInterface $event)
    {
        if($action === 'fooAction') {
            $request->setMetadata('param1', 'foo action is intercepted');
        }

        $jp = $this->getJoinPoint();
        $jp->process();

        $model = $jp->getReturnedValue();
        return $model['attr'] . " is overrided";
    }

    public function getPointCut()
    {
        return 'sample\Business::*Action()';
    }
}
