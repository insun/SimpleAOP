<?php

namespace SimpleAOP\Aspect\Feature;

use SimpleAOP\Aspect\AroundInterface;
use Zend\Stdlib\RequestInterface;
use Zend\EventManager\EventInterface;

interface AroundActionInterceptorInterface extends AroundInterface
{
    /**
     * Around advice
     * @param string $action action name
     * @param RequestInterface $request
     * @param EventInterface $event
     */
    public function around($action, RequestInterface $request, EventInterface $event);
}
