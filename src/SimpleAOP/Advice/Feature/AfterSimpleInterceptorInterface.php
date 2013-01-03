<?php

namespace SimpleAOP\Advice\Feature;

use SimpleAOP\Advice\AfterInterface;

interface AfterSimpleInterceptorInterface extends AfterInterface
{
    /**
     * After advice
     * @param mixed $return
     */
    public function after($return);
}