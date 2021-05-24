# fh-request-server

## Introduction

Web Request Server Api для взаимодействия с внутренним RS через брокер сообщений

## Features
* php v7.3
* [Laravel v7.*](https://laravel.com/docs/7.x)
* [vladmeh/rabbitmq-client v2.*](https://github.com/vladmeh/rabbitmq-client)
* [vladmeh/xml-utils v2.*](https://github.com/vladmeh/xml-utils)

> **PHP8.0 support** will be available after php-amqplib is updated to the next major version 3.0. (https://github.com/php-amqplib/php-amqplib/pull/858)

### Version Compatibility

Laravel  | Request Server | min PHP
:---------|:---------------|:----------
6.x      | 1.x            | 7.2
7.x      | 2.x            | 7.3
8.x      | --             | --

## Installation

### Composer

add the following to your require part within the composer.json:

```json
{
    "require": {
        "fitnesshouse/fh-request-server": "^2.0"
    },
    "repositories": [
        {
            "type": "vcs",
            "url":  "https://github.com/fhcs/fh-request-server"
        }
    ]
}
```

and

```bash
$ composer install
```

## Usage
