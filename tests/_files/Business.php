<?php

namespace sample;

class Business
{
    public function custom()
    {
        return "custom";
    }
    
    public function foo($arg)
    {
        return $arg;
    }
    
    public function bar()
    {
        return "bar";
    }
    
    public function fooAction()
    {
        return array('attr' => 'foo');
    }
    
    public function customAction()
    {
        return array('attr' => 'custom');
    }
}