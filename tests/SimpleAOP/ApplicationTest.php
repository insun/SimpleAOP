<?php

namespace SimpleAOPTest\Advice;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\Mvc\Application;

class ApplicationTest extends TestCase
{
    public function testCanRunModule()
    {
        $application = Application::init(include __DIR__ . '/../application/application.config.php');
    }
}
