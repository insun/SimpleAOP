<?php

namespace SimpleAOP\Advice;

use AopJoinpoint;

interface AdviceInterceptorInterface extends AdviceInterface
{
    /**
     * Advice callback
     * @param AopJoinpoint $jp
     */
    public function __invoke(AopJoinpoint $jp);
}