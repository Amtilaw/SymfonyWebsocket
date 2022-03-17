<?php

namespace App\Command;

use App\Service\DataHandler;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SocketServerCommand extends Command
{
    protected function configure()
    {
        $this->setName('socket:run');
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $app = new HttpServer(
            new WsServer(
                new DataHandler()
            )
        );
        $server = IoServer::factory($app, 8080);
        $server->run();
        return 0;
    }
}
