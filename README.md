# PHP Wrapper for web servers

Currently supported web (HTTP) servers:
- PHP Built-in web server

## Usage

It can be used for end-to-end tests.

Eg. run web server from PHPUnit to make sure your project works properly when used over HTTP.

See /src/Tests/Large/PHPBuiltInWebServerTest.php for an example.

## Installation

Use composer

    composer require "Paq85/WebServer":"^0.1"

## Setup

    composer install

## Testing

    bin/phpunit
