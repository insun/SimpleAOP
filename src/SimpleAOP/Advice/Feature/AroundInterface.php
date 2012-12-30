<?php

namespace SimpleAOP\Advice\Feature;

use AopJoinpoint;

interface AroundInterface
{
    /**
     * Around advice
     * @param AopJoinpoint $jp
     */
    public function around(AopJoinpoint $jp);
}