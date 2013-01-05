<?php

namespace SimpleAOP\Advice\Feature;

use AopJoinpoint;
use SimpleAOP\Advice\AroundInterface;

interface AroundActionInterceptorInterface extends AroundInterface
{
    /**
     * Around advice
     * @param RequestInterface $request
     * @param AopJoinpoint $jp
     */
    public function around(RequestInterface $request, AopJoinpoint $jp);
}
