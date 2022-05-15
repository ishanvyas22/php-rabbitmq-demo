<?php

require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

// Create a connection to the RabbitMQ server
$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

/**
 * Create a channel/queue to push messages.
 * 
 * Declaring a queue is idempotent - it will only be created if it doesn't exist already.
 */
$channel->queue_declare('hello', false, false, false, false);

// Specify message to send, and then publish it to created channel
$text = 'Hello World!';
$msg = new AMQPMessage($text);
$channel->basic_publish($msg, '', 'hello');

echo sprintf(' [x] Sent "%s"', $text), PHP_EOL;

// Close the channel connection
$channel->close();
// Close the server connection
$connection->close();
