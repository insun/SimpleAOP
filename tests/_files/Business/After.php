<?php

namespace sample\Business;

class After
{
    public function custom()
    {
        return "custom";
    }
    
    public function customAction()
    {
        return array('attr' => 'custom');
    }
    
    public function foo()
    {
        return "foo";
    }
    
    public function fooAction()
    {
        return array('attr' => 'foo');
    }
    
    public function bar()
    {
        return "bar";
    }
}