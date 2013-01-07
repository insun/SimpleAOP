<?php

namespace sample\Around;

use SimpleAOP\Aspect\Around\Simple as AroundAspect;

class Simple extends AroundAspect
{
    public function aroundCustom($arg = '')
    {
        return "customisation in progress";
    }

    public function around($method, array $arguments = array(), $target = null)
    {
        $jp = $this->getJoinPoint();
        if($method === 'mirror') {
            $jp->setArguments(array('before', 'intercepted'));
        }

        $jp->process();
        $return = $jp->getReturnedValue();

        return  $return . " is overrided";
    }

    public function getPointCut()
    {
        return array(
            'sample\Business::custom()',
            'sample\Business::mirror()'
        );
    }
}
