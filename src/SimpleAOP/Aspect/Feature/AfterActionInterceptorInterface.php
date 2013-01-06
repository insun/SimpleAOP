<?php

namespace SimpleAOP\Aspect\Feature;

use SimpleAOP\Aspect\AfterInterface;

interface AfterActionInterceptorInterface extends AfterInterface
{
    /**
     * After advice in controller
     * @param null|ModelInterface $model
     */
    public function after($model);
}
