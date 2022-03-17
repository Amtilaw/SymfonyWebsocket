<?php
// src/Service/DataHandler.php
namespace App\Service;

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class DataHandler implements MessageComponentInterface
{
    private $connections =  [];
    function onOpen(ConnectionInterface $conn)
    {
        echo "Connected new client with Id:" . $conn->resourceId . "\n";
        $this->connections[] = $conn;
        echo count($this->connections) . " active connections\n";
    }
    function onClose(ConnectionInterface $conn)
    {
        echo "Closing Connection with Id:" . $conn->resourceId . "\n";
        foreach ($this->connections as $key => $connection) {
            if ($connection->resourceId == $conn->resourceId) {
                $connection->close();
                array_splice($this->connections, $key, 1);
                break;
            }
        }
        echo count($this->connections) . " active connections\n";
    }
    function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Error: " . $e->getMessage() . "\n";
        echo "Closing Connection with Id:" . $conn->resourceId . "\n";
        foreach ($this->connections as $key => $connection) {
            if ($connection->resourceId == $conn->resourceId) {
                array_splice($this->connections, $key, 1);
                break;
            }
        }
        $conn->close();
        echo count($this->connections) . " active connections\n";
    }
    function onMessage(ConnectionInterface $from, $msg)
    {
        echo "Message: " . $msg . "\nreceived from " . $from->resourceId . "\n";
        $from->send('Message Received On Server: ' . $msg);
    }
}
