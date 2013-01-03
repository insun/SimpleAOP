<?php

namespace SimpleAOP\Advice\Feature;

use SimpleAOP\Advice\BeforeInterface;
use Zend\Stdlib\RequestInterface;

interface BeforeActionInterceptorInterface extends BeforeInterface
{
    /**
     * Before advice
     * @param RequestInterface $request
     */
    public function before(RequestInterface $request);
}