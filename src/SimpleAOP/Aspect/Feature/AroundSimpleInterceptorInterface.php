<?php

namespace SimpleAOP\Aspect\Feature;

use AopJoinpoint;
use SimpleAOP\Aspect\AroundInterface;

interface AroundSimpleInterceptorInterface extends AroundInterface
{
    /**
     * Before advice
     * @param string $method
     * @param array $arguments
     * @param object $target
     */
    public function around($method, array $arguments = array(), $target = null);
}
