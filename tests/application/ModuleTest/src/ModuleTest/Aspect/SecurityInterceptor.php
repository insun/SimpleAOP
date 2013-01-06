<?php

namespace ModuleTest\Aspect;

use SimpleAOP\Aspect\Before\Action as BeforeAspect;
use Zend\Stdlib\RequestInterface;

class SecurityInterceptor extends BeforeAspect
{
    public function before($action, RequestInterface $request)
    {
        $token = $request->getQuery('token');
        if(null === $token) {
            throw new \RuntimeException('Token do not exists');
        }
    }
    
    public function getPointCut()
    {
        return 'Foo\Controller\*::*Action()';
    }
}
