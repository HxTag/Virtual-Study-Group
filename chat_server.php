<?php
require __DIR__ . '/vendor/autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class ChatServer implements MessageComponentInterface {
    protected $clients;
    protected $groupConnections;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->groupConnections = [];
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        parse_str($conn->httpRequest->getUri()->getQuery(), $query);
        
        if (isset($query['group_id']) && isset($query['user_id'])) {
            $groupId = $query['group_id'];
            $userId = $query['user_id'];
            
            if (!isset($this->groupConnections[$groupId])) {
                $this->groupConnections[$groupId] = new \SplObjectStorage;
            }
            $this->groupConnections[$groupId]->attach($conn);
            
            echo "New connection! ({$conn->resourceId}) - Group: {$groupId}, User: {$userId}\n";
        }
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $data = json_decode($msg);
        
        if (isset($data->group_id) && isset($this->groupConnections[$data->group_id])) {
            foreach ($this->groupConnections[$data->group_id] as $client) {
                // Send to all clients in the group, including the sender
                $client->send($msg);
            }
            echo "Message broadcasted to group {$data->group_id}\n";
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        
        foreach ($this->groupConnections as $groupId => $connections) {
            if ($connections->contains($conn)) {
                $connections->detach($conn);
                if ($connections->count() === 0) {
                    unset($this->groupConnections[$groupId]);
                }
                echo "Connection {$conn->resourceId} removed from group {$groupId}\n";
            }
        }
        
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new ChatServer()
        )
    ),
    8080
);

echo "Chat server started on port 8080\n";
$server->run();