# fh-request-server

## Introduction

Web Request Server Api для взаимодействия с внутренним RS через брокер сообщений

## Features
* php v7.2
* [Laravel v6.*](https://laravel.com/docs/6.x)
* [vladmeh/rabbitmq-client v1.*](https://github.com/vladmeh/rabbitmq-client)
* [vladmeh/xml-utils v1.*](https://github.com/vladmeh/xml-utils)

## Installation

### Composer

add the following to your require part within the composer.json:

```json
{
    "require": {
        "fitnesshouse/fh-request-server": "^1.0"
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
