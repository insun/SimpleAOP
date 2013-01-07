<?php

namespace SimpleAOP;

use Zend\ServiceManager\AbstractPluginManager;

class AspectPluginManager extends AbstractPluginManager
{
    /**
     * Default set of aop plugins
     *
     * @var array
     */
    protected $invokableClasses = array();

    /**
     * Validate the aspect
     *
     * Checks that the aspect loaded is an instance of Aspect\AspectInterface.
     *
     * @param  mixed $plugin
     * @return void
     * @throws Exception\InvalidHelperException if invalid
     */
    public function validatePlugin($plugin)
    {
        if ($plugin instanceof Aspect\AspectInterface) {
            // we're okay
            return;
        }

        throw new Exception\InvalidAspectException(sprintf(
            'Plugin of type %s is invalid; must implement %s\Aspect\AspectInterface',
            (is_object($plugin) ? get_class($plugin) : gettype($plugin)),
            __NAMESPACE__
        ));
    }
}
