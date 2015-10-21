<?php

namespace Paq85\WebServer\Tests\Large;

use Paq85\WebServer\PhpBuiltInWebServer;

class PHPBuiltInWebServerTest extends \PHPUnit_Framework_TestCase
{
    public function testItWorks()
    {
        $server = new PhpBuiltInWebServer('localhost', 8578, __DIR__);
        $server->start();
        $this->assertTrue($server->isRunning());
        $server->stop();
        $this->assertFalse($server->isRunning());
    }
}
