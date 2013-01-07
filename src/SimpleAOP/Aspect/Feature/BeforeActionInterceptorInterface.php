<?php

namespace SimpleAOP\Aspect\Feature;

use SimpleAOP\Aspect\BeforeInterface;
use Zend\Stdlib\RequestInterface;
use Zend\EventManager\EventInterface;

interface BeforeActionInterceptorInterface extends BeforeInterface
{
    /**
     * Before advice
     * @param string $action action name
     * @param RequestInterface $request
     * @param EventInterface $event
     */
    public function before($action, RequestInterface $request, EventInterface $event);
}
