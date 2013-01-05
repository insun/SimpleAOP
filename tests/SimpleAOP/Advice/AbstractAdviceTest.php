<?php

namespace SimpleAOPTest\Advice;

use PHPUnit_Framework_TestCase as TestCase;
use SimpleAOP\Aop;
use sample;
use Zend\ServiceManager\ServiceManager;

abstract class AbstractAdviceTest extends TestCase
{
    protected $aop;
    protected $target;

    public function setUp()
    {
        $this->aop = new Aop();
        $this->aop->setServiceLocator(new ServiceManager());
        $this->target = new sample\Business();
    }
}
