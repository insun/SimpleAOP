<?php

namespace SimpleAOPTest\Advice\Before;

use PHPUnit_Framework_TestCase as TestCase;
use SimpleAOP\Aop;
use sample;
use Zend\ServiceManager\ServiceManager;

class ActionTest extends TestCase
{
    protected $aop;
    protected $target;
    protected $request;

    public function setUp()
    {
        $this->aop = new Aop();
        $this->aop->setServiceLocator(new ServiceManager());
        $this->request = new \Zend\Http\Request();
        $this->aop->getServiceLocator()->setService('Request', $this->request);
        $this->target = new sample\Business\Before();
    }

    public function testCanInterceptAndSetArguments()
    {
        $this->request->setMetadata('param1', 'bar');

        $this->target->fooAction();
        $this->assertEquals($this->request->getMetaData('param1'), 'bar');

        $this->aop->register(new sample\Before\Action());
        $this->target->fooAction();
        $this->assertEquals($this->request->getMetaData('param1'), 'foo action is intercepted');
    }
}
