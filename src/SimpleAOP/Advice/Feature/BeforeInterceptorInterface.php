<?php

namespace SimpleAOP\Advice\Feature;

use AopJoinpoint;
use SimpleAOP\Advice\BeforeInterface;

interface BeforeInterceptorInterface extends BeforeInterface
{
    /**
     * Before advice
     * @param AopJoinpoint $jp
     */
    public function before(AopJoinpoint $jp);
}
