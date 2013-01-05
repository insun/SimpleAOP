<?php

namespace sample\Around;

use SimpleAOP\Advice\Around\Action as Around;
use Zend\Stdlib\RequestInterface;

class ActionFooAround extends Around
{
    /**
     * Around advice
     * @param string $action action name
     * @param RequestInterface $request
     */
    public function aroundCustomAction($action, RequestInterface $request)
    {
        return "customisation in progress";
    }
    
    /**
     * Around advice
     * @param string $action action name
     * @param RequestInterface $request
     */
    public function around($action, RequestInterface $request)
    {
        if($action === 'fooAction') {
            $request->setMetadata('param1', 'foo action is intercepted');
        }
        
        $jp = $this->getJoinPoint();
        $jp->process();
        
        $model = $jp->getReturnedValue();
        return $model['attr'] . " is overrided";
    }
    
    /**
     * Get the point cut selector
     * @return string
     */
    public function getPointCut()
    {
        return 'sample\Around\Foo::*Action()';
    }
}