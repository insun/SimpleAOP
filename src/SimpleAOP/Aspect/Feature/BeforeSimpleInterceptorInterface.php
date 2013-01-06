<?php

namespace SimpleAOP\Aspect\Feature;

use SimpleAOP\Aspect\BeforeInterface;

interface BeforeSimpleInterceptorInterface extends BeforeInterface
{
    /**
     * Before advice
     * @param string $method
     * @param array $arguments
     * @param object $target
     */
    public function before($method, array $arguments = array(), $target = null);
}
