<?php

namespace SimpleAOP\Aspect\Feature;

use AopJoinpoint;
use SimpleAOP\Aspect\BeforeInterface;

interface BeforeInterceptorInterface extends BeforeInterface
{
    /**
     * Before advice
     * @param AopJoinpoint $jp
     */
    public function before(AopJoinpoint $jp);
}
