<?php

namespace SimpleAOP\Aspect\Feature;

use AopJoinpoint;
use SimpleAOP\Aspect\AfterInterface;

interface AfterInterceptorInterface extends AfterInterface
{
    /**
     * After advice
     * @param AopJoinpoint $jp
     */
    public function after(AopJoinpoint $jp);
}
