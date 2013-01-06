<?php

namespace Foo\Advice;

use SimpleAOP\Advice\Before\Action as BeforeAdvice;
use Zend\Stdlib\RequestInterface;

class SecurityInterceptor extends BeforeAdvice
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
