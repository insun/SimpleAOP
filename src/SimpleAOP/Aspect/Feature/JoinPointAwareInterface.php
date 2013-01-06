<?php

namespace SimpleAOP\Aspect\Feature;

use AopJoinpoint;

interface JoinPointAwareInterface
{
    /**
     * Get the join point
     * @return AopJoinpoint
     */
    public function getJoinPoint();

    /**
     * Set the joint point
     * @param AopJoinpoint $jp
     */
    public function setJoinPoint(AopJoinpoint $jp);
}
