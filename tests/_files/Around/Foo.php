<?php

namespace sample\Around;

class Foo
{
    public function foo($arg1, $arg2)
    {
        return $arg1 . ' ' . $arg2;
    }
    
    public function fooAction()
    {
        return array('attr' => 'foo');
    }
}