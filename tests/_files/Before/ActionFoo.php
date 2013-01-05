<?php

namespace sample\Before;

use SimpleAOP\Advice\Before\Action as Before;
use Zend\Stdlib\RequestInterface;

class ActionFoo extends Before
{
    /**
     * Before advice
     * @param RequestInterface $request
     */
    public function before($action, RequestInterface $request)
    {
        if($action === 'fooAction') {
            $request->setMetadata('param1', 'foo action is intercepted');
        }
    }
    
    /**
     * Get the point cut selector
     * @return string
     */
    public function getPointCut()
    {
        return 'sample\Before\Foo::*Action()';
    }
}