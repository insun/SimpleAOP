<?php

namespace SimpleAOP\Advice\Feature;

use SimpleAOP\Advice\AfterInterface;

interface AfterActionInterceptorInterface extends AfterInterface
{
    /**
     * After advice in controller
     * @param null|ModelInterface $model
     */
    public function after($model);
}
