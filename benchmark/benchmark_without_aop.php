<?php

defined('ZF2_PATH') || define('ZF2_PATH', realpath(__DIR__ . '/../../zf2-fork/library/'));
require_once '_autoload.php';

use Zend\Mvc\Application;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\View\SendResponseListener;

$opts = getopt('r:d:m:', array('repeat:', 'debug:', 'module:'));

$reset = function() {
    gc_collect_cycles();
    Zend\EventManager\StaticEventManager::resetInstance();
};

/**
 * Without AOP
 */
define('AOP_ENABLE', false);
$i = 0;
$time = microtime(true);
$memory = memory_get_peak_usage();

while($i++ < $opts['repeat']) {
    $reset();
    $config = include __DIR__ . '/application.config.php';
    $config["modules"][] = $opts['module'];
    $application = Application::init($config);
    $application->getRequest()->params()->exchangeArray(array('--tests'));
    $events = $application->getEventManager();
    foreach($events->getListeners(MvcEvent::EVENT_FINISH) as $listener) {
        $callback = $listener->getCallback();
        if (is_array($callback) && $callback[0] instanceof SendResponseListener) {
            $events->detach($listener);
        }
    }
    $response = $application->run();
    if(isset($opts['debug']) && $opts['debug']) {
        echo 'response : ' . $response->getContent() . "\n";
    }
}

$time = microtime(true) - $time;
$memory = memory_get_peak_usage();

echo str_pad('average without AOP : ', 15) . str_pad(round($time/$i*1000, 3), 5, '0') . ' ms, ' . str_pad(round($memory/1024/1024, 2), 2, '0') . 'MB' . "\n";
