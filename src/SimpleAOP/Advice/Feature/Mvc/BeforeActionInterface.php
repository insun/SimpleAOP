<?php

namespace SimpleAOP\Advice\Feature\Mvc;

use Zend\Stdlib\RequestInterface;

interface BeforeActionInterface
{
    /**
     * Before advice
     * @param RequestInterface $request
     */
    public function before(RequestInterface $request);
}