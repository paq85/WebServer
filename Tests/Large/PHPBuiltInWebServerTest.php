<?php

namespace Paq85\WebServer\Tests\Large;

use Paq85\WebServer\PhpBuiltInWebServer;

class PHPBuiltInWebServerTest extends \PHPUnit_Framework_TestCase
{
    public function testItWorks()
    {
        $server = new PhpBuiltInWebServer('localhost', 8578, __DIR__.'/../foo_public_html');
        
        $server->start();
        $this->assertTrue($server->isRunning(), 'Server should be running.');
        
        $this->assertEquals('It works!', file_get_contents('http://localhost:8578/index.php'), 'Server should be serving content.');
        
        $server->stop();
        $this->assertFalse($server->isRunning(), 'Server should not be running.');
    }
}
