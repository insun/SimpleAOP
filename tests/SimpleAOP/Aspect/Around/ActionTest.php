<?php

namespace SimpleAOPTest\Aspect\Around;

use sample;
use SimpleAOPTest\Aspect\AbstractAspectTest;

class ActionTest extends AbstractAspectTest
{
    protected $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new \Zend\Http\Request();
        $this->aop->getServiceLocator()->setService('Request', $this->request);
    }

    public function testCanIntercept()
    {
        $this->request->setMetadata('param1', 'bar');

        $result = $this->target->fooAction('foo');
        $this->assertEquals($result, array('attr' => 'foo'));
        $this->assertEquals($this->request->getMetaData('param1'), 'bar');

        $this->aop->register(new sample\Around\Action());
        $result = $this->target->fooAction('foo');
        $this->assertEquals($result, "foo is overrided");
        $this->assertEquals($this->request->getMetaData('param1'), 'foo action is intercepted');
    }

    public function testCanInterceptInCustomeMethod()
    {
        $this->request->setMetadata('param1', 'bar');
        $result = $this->target->customAction();
        $this->assertEquals($this->request->getMetaData('param1'), 'bar');

        $this->aop->register(new sample\Around\Action());
        $result = $this->target->customAction();
        $this->assertEquals($this->request->getMetaData('param1'), "custom in progress");
    }
}
