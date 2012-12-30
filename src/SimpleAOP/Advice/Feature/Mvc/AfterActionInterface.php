<?php

namespace SimpleAOP\Advice\Feature\Mvc;

interface AfterActionInterface
{
    /**
     * After advice in controller
     * @param null|ModelInterface $return
     */
    public function after($model);
}