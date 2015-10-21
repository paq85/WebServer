<?php

namespace Paq85\WebServer;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

/**
 * Class helps running PHP Built-in web server from PHP code
 *
 * Can be used for testing purposes
 *
 * @see http://php.net/manual/en/features.commandline.webserver.php
 */
class PhpBuiltInWebServer
{
    /**
     * @var int how many seconds should it wait for the startup process to complete
     */
    private $timeout;

    /**
     * @var Process
     */
    private $serverProcess;

    /**
     * @var string
     */
    private $host;

    /**
     * @var int
     */
    private $port;

    /**
     * @var string
     */
    private $webRoot;

    /**
     * @param string $host eg. localhost
     * @param int $port eg. 8484
     * @param string $webRoot eg. /var/www/html
     * @param int $timeout eg. 10 - waits 10 seconds for server to be ready
     */
    public function __construct($host, $port, $webRoot, $timeout = 10)
    {
        $this->host = $host;
        $this->port = $port;
        $this->webRoot = $webRoot;
        $this->timeout = $timeout;
    }

    /**
     * @throws \RuntimeException if server could not be started within $this->timeout seconds
     */
    public function start()
    {
        if ($this->isRunning()) {
            return;
        }

        $processBuilder = new ProcessBuilder(['/usr/bin/php', '-S', "{$this->host}:{$this->port}", '-t', $this->webRoot]);
        $this->serverProcess = $processBuilder->getProcess();
        $this->serverProcess->start();
        // server needs some time to boot up
        $serverIsBooting = true;
        $timeoutAt = time() + $this->timeout;
        while ($this->serverProcess->isRunning() && $serverIsBooting) {
            try {
                $socket = fsockopen($this->host, $this->port);
                if ($socket) {
                    $serverIsBooting = false;
                }
            } catch (\Exception $ex) {
                // server not ready
                if ($timeoutAt < time()) {
                    throw new \RuntimeException("Could not start Web Server [host = {$this->host}; port = {$this->port}; web root = {$this->webRoot}]");
                }
            }
            usleep(10);
        }
    }

    public function stop()
    {
        while ($this->isRunning()) {
            $this->serverProcess->signal(SIGQUIT);
            // it needs some time to stop
            usleep(10);
        }
    }

    /**
     * @return bool
     */
    public function isRunning()
    {
        return ($this->serverProcess && $this->serverProcess->isRunning());
    }
}