<?php
require '../vendor/autoload.php';
date_default_timezone_set('PRC');
use Monolog\Logger;
// Create the logger
$logger = new Logger('my_logger');
// Now add some handlers
$logger->pushHandler(new \Monolog\Handler\ErrorLogHandler());

$config = \Kafka\ConsumerConfig::getInstance();
$config->setMetadataRefreshIntervalMs(10000);
$config->setMetadataBrokerList('localhost:29092');
$config->setGroupId('test');
$config->setBrokerVersion('1.0.0');
$config->setTopics(['test']);
//$config->setOffsetReset('earliest');
$consumer = new \Kafka\Consumer();
$consumer->setLogger($logger);
$consumer->start(function($topic, $part, $message) {
    var_dump($message);
});