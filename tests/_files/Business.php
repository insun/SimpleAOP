<?php

namespace sample;

use Zend\Mvc\MvcEvent;

class Business
{
    public function custom($arg = '')
    {
        return "custom" . $arg;
    }

    public function mirror($arg)
    {
        return $arg;
    }

    public function bar()
    {
        return "bar";
    }

    public function fooAction($id = null)
    {
        return array('attr' => $id);
    }

    public function customAction()
    {
        return array('attr' => 'custom');
    }

    public function getEvent()
    {
        return new MvcEvent();
    }
}
