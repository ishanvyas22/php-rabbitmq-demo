# php-rabbitmq-demo
A demo repo to implement things related to RabbitMQ

## Installation

Install & run RabbitMQ via docker:

```sh
docker run -it --rm --name rabbitmq -p 5672:5672 -p 15672:15672 rabbitmq:3.10-management
```

#### RabbitMQ credentials

**Username:** guest

**Password:** guest

## Usage

**To produce/send a message:**

```sh
php producer.php
```

**To consume a message sent by `producer.php` file:**

```sh
php consumer.php
```

To exit press CTRL+C.
