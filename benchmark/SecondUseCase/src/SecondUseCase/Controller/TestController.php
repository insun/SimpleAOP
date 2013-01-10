<?php

namespace SecondUseCase\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class TestController extends AbstractActionController
{
    public function testAction($state = 'failed')
    {
        return $state . ' !';
    }
}
