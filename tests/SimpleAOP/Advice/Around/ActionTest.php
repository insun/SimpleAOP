<?php

namespace SimpleAOPTest\Advice\Around;

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

    public function testCanIntercept()
    {
        $this->request->setMetadata('param1', 'bar');

        $result = $this->target->fooAction();
        $this->assertEquals($result, array('attr' => 'foo'));
        $this->assertEquals($this->request->getMetaData('param1'), 'bar');

        $this->aop->register(new sample\Around\Action());
        $result = $this->target->fooAction();
        $this->assertEquals($result, "foo is overrided");
        $this->assertEquals($this->request->getMetaData('param1'), 'foo action is intercepted');
    }
}
