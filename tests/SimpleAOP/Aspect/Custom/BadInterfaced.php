<?php

namespace SimpleAOPTest\Aspect\Custom;

use SimpleAOP\Aspect\AspectInterface;

class BadInterfaced implements AspectInterface
{
    /**
     * Advice callback
     * @param AopJoinpoint $jp
     */
    public function __invoke(AopJoinpoint $jp)
    {

    }

    /**
     * Get the point cut selector
     * @return string
     */
    public function getPointCut()
    {

    }
}
