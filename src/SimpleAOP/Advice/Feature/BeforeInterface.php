<?php

namespace SimpleAOP\Advice\Feature;

interface BeforeInterface
{
    /**
     * Before advice
     * @param string $method
     * @param array $arguments
     */
    public function before($method, array $arguments = array());
}