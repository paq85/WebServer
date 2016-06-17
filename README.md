# PHP Wrapper for web servers

Currently supported web (HTTP) servers:
- PHP Built-in web server

[![Build Status](https://img.shields.io/travis/paq85/web-server/master.svg?style=flat-square)](https://travis-ci.org/paq85/WebServer)
[![Packagist Version](https://img.shields.io/packagist/v/paq85/web-server.svg?style=flat-square)](https://packagist.org/packages/paq85/WebServer)

## Usage

It can be used for end-to-end tests.

Eg. run web server from PHPUnit to make sure your project works properly when used over HTTP.

See /src/Tests/Large/PHPBuiltInWebServerTest.php for an example.

## Installation

Use composer

    composer require "paq85/web-server":"^0.1"

## Setup

    composer install

## Testing

    bin/phpunit
