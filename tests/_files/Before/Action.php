<?php

namespace sample\Before;

use SimpleAOP\Aspect\Before\Action as BeforeAspect;
use Zend\Stdlib\RequestInterface;

class Action extends BeforeAspect
{
    public function beforeCustomAction($action, RequestInterface $request)
    {
        $request->setMetadata('param1', 'custom in progress');
    }

    /**
     * Before advice
     * @param RequestInterface $request
     */
    public function before($action, RequestInterface $request)
    {
        if($action === 'fooAction') {
            $request->setMetadata('param1', 'foo action is intercepted');
            $id = 'bar';
            return array($id);
        }
    }

    /**
     * Get the point cut selector
     * @return string
     */
    public function getPointCut()
    {
        return 'sample\Business::*Action()';
    }
}
