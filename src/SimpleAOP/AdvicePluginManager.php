<?php

namespace SimpleAOP;

use Zend\ServiceManager\AbstractPluginManager;

class AdvicePluginManager extends AbstractPluginManager
{
    /**
     * Default set of aop plugins
     *
     * @var array
     */
    protected $invokableClasses = array();

    /**
     * Validate the plugin
     *
     * Checks that the advice loaded is an instance of Advice\AdviceInterface.
     *
     * @param  mixed $plugin
     * @return void
     * @throws Exception\InvalidHelperException if invalid
     */
    public function validatePlugin($plugin)
    {
        if ($plugin instanceof Advice\AdviceInterface) {
            // we're okay
            return;
        }

        throw new Exception\InvalidHelperException(sprintf(
            'Plugin of type %s is invalid; must implement %s\Advice\AdviceInterface',
            (is_object($plugin) ? get_class($plugin) : gettype($plugin)),
            __NAMESPACE__
        ));
    }
}
