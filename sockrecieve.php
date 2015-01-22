<?php

require __DIR__.'/vendor/autoload.php';

$loop = React\EventLoop\Factory::create();

$context = new React\ZMQ\Context($loop);

$pull = $context->getSocket(ZMQ::SOCKET_PULL);
$pull->bind('tcp://127.0.0.1:5555');

$pull->on('error', function ($e) {
    var_dump($e->getMessage());
});

$pusher = new \Depotwarehouse\Streameroni\Pusher();

$pull->on('message', [ $pusher, 'onChatMessage' ]);

$socket = new React\Socket\Server($loop);
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

$loop->run();
