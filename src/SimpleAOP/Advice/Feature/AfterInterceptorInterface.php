<?php

namespace SimpleAOP\Advice\Feature;

use AopJoinpoint;
use SimpleAOP\Advice\AfterInterface;

interface AfterInterceptorInterface extends AfterInterface
{
    /**
     * After advice
     * @param AopJoinpoint $jp
     */
    public function after(AopJoinpoint $jp);
}