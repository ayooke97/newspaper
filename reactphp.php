<?php

use React\EventLoop\Loop;


require __DIR__ . '/vendor/autoload.php';

$interval = 0;
$timer = Loop::addPeriodicTimer(0.1, function () use (&$interval) {
    $interval++;
    echo "Interval count : {$interval} " . PHP_EOL;
});

Loop::addTimer(1.0, function () use ($timer) {
    Loop::cancelTimer($timer);
    echo 'Done' . PHP_EOL;
});

?>