<?php

namespace SimpleAOP\Aspect\Feature;

use SimpleAOP\Aspect\BeforeInterface;
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
