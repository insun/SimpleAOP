<?php

namespace SimpleAOP\Advice\Feature;

use AopJoinpoint;
use SimpleAOP\Advice\AroundInterface;

interface AroundSimpleInterceptorInterface extends AroundInterface
{
    /**
     * Around advice
     * @param AopJoinpoint $jp
     */
    public function around(AopJoinpoint $jp);
}
