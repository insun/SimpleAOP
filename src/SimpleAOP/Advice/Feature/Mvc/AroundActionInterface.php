<?php

namespace SimpleAOP\Advice\Feature\Mvc;

use AopJoinpoint;

interface AroundInterface
{
    /**
     * Before advice
     * @param RequestInterface $request
     * @param AopJoinpoint $jp
     */
    public function around(RequestInterface $request, AopJoinpoint $jp);
}