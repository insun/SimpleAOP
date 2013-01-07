<?php

namespace sample\Before;

use SimpleAOP\Aspect\Before\Simple as BeforeAspect;

class Simple extends BeforeAspect
{
    public function beforeCustom($arg = '')
    {
        return array('customisation in progress');
    }

    public function before($method, array $arguments = array(), $target = null)
    {
        if($method === 'mirror') {
            $jp = $this->getJoinPoint();
            $jp->setArguments(array('intercepted'));
        }
    }

    public function getPointCut()
    {
        return array(
            'sample\Business::custom()',
            'sample\Business::mirror()'
        );
    }
}
