<?php

namespace SimpleAOP\Aspect\Feature;

use SimpleAOP\Aspect\AroundInterface;
use Zend\Stdlib\RequestInterface;

interface AroundActionInterceptorInterface extends AroundInterface
{
    /**
     * Before advice
     * @param string $action action name
     * @param RequestInterface $request
     */
    public function around($action, RequestInterface $request);
}
