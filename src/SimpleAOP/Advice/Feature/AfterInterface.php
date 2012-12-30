<?php

namespace SimpleAOP\Advice\Feature;

interface AfterInterface
{
    /**
     * After advice
     * @param mixed $return
     */
    public function after($return);
}