<?php

namespace Depotwarehouse\Streameroni;

use React\EventLoop\Factory;
use React\Socket\Server;
use React\ZMQ\Context;
use ZMQ;

class ChatServer
{

    protected $loop;

    public function __construct() {
        $this->loop = Factory::create();

        $context = new Context($this->loop);

        $pull = $context->getSocket(ZMQ::SOCKET_PULL);
        $pull->bind('tcp://127.0.0.1:5555');

        $pull->on('error', function ($e) {
            var_dump($e->getMessage());
        });

        $pusher = new Pusher();

        $pull->on('message', function($json_msg) use ($pusher) {
            $chatMessage = ChatMessage::fromJson($json_msg);
            $pusher->onChatMessage($chatMessage);
        });

        $socket = new Server($this->loop);
        $socket->listen(9001, '0.0.0.0');

        $webServer = new \Ratchet\Server\IoServer(
            new \Ratchet\Http\HttpServer(
                new \Ratchet\WebSocket\WsServer(
                    new \Ratchet\Wamp\WampServer(
                        $pusher
                    )
                )
            ),
            $socket
        );
    }

    public function run() {
        $this->loop->run();
    }

}
