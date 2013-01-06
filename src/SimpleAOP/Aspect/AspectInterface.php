<?php

namespace SimpleAOP\Aspect;

use AopJoinpoint;

interface AspectInterface
{
    /**
     * Advice callback
     * @param AopJoinpoint $jp
     */
    public function __invoke(AopJoinpoint $jp);

    /**
     * Get the point cut selector
     * @return string
     */
    public function getPointCut();
}
