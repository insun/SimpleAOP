<?php

namespace SimpleAOP\Advice;

use AopJoinpoint;

interface AdviceInterface
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