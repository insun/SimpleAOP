<?php

namespace SimpleAOP\Aspect\Feature;

use AopJoinpoint;
use SimpleAOP\Aspect\AroundInterface;

interface AroundInterceptorInterface extends AroundInterface
{
    /**
     * Around advice
     * @param AopJoinpoint $jp
     */
    public function around(AopJoinpoint $jp);
}
