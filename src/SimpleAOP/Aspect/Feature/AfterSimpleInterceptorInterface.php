<?php

namespace SimpleAOP\Aspect\Feature;

use SimpleAOP\Aspect\AfterInterface;

interface AfterSimpleInterceptorInterface extends AfterInterface
{
    /**
     * After advice
     * @param mixed $return
     */
    public function after($return);
}
