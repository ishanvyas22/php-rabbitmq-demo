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

echo " [*] Waiting for messages. To exit press CTRL+C\n";

$callback = function ($msg) {
    echo ' [x] Received ', $msg->body, "\n";
};

$channel->basic_consume('hello', '', false, true, false, false, $callback);
  
while ($channel->is_open()) {
    $channel->wait();
}

// Close the channel connection
$channel->close();
// Close the server connection
$connection->close();
