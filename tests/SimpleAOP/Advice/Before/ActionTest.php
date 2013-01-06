<?php

namespace SimpleAOPTest\Advice\Before;

use sample;
use SimpleAOPTest\Advice\AbstractAdviceTest;

class ActionTest extends AbstractAdviceTest
{
    protected $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new \Zend\Http\Request();
        $this->aop->getServiceLocator()->setService('Request', $this->request);
    }

    public function testCanInterceptAndSetArguments()
    {
        $this->request->setMetadata('param1', 'bar');

        $this->target->fooAction();
        $this->assertEquals($this->request->getMetaData('param1'), 'bar');

        $this->aop->register(new sample\Before\Action());
        $result = $this->target->fooAction();
        $this->assertEquals($this->request->getMetaData('param1'), 'foo action is intercepted');
        $this->assertEquals($result, array('attr' => 'bar'));
    }
}
