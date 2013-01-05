<?php

namespace SimpleAOP\Advice\Feature;

use SimpleAOP\Advice\BeforeInterface;
use Zend\Stdlib\RequestInterface;

interface BeforeActionInterceptorInterface extends BeforeInterface
{
    /**
     * Before advice
     * @param string $action action name
     * @param RequestInterface $request
     */
    public function before($action, RequestInterface $request);
}
