<?php

namespace Depotwarehouse\Streameroni;

use Phoebe\Connection;
use Phoebe\ConnectionManager;
use Phoebe\Event\Event;
use Phoebe\Plugin\PingPong\PingPongPlugin;

class ChatBot
{

    protected $connection;
    protected $channel;

    public function __construct()
    {
        $this->connection = new Connection();
        $this->connection->setServerHostname("irc.twitch.tv");
        $this->connection->setServerPort(6667);
    }

    public function setUsername($username)
    {
        $this->connection->setNickname($username);
        $this->connection->setUsername($username);
        $this->connection->setRealname($username);

    }

    public function setPassword($password)
    {
        $this->connection->setPassword($password);
    }

    public function setChannel($channel) {
        $this->channel = $channel;
    }

    public function setup()
    {
        $context = new \ZMQContext();
        $socket = $context->getSocket(\ZMQ::SOCKET_PUSH);
        $socket->connect("tcp://localhost:5555");

        // Create shortcut to EventDispatcher
        $phoebeEventDispatch = $this->connection->getEventDispatcher();

        // Add PingPongPlugin to avoid being kicked from server
        $phoebeEventDispatch->addSubscriber(new PingPongPlugin());

        // Join a startup channel.
        $channel = $this->channel;
        $phoebeEventDispatch->addListener('irc.received.001', function (Event $event) use ($channel) {
            $event->getWriteStream()->ircJoin($channel);
        });

        // Handle any messages recieved in chat.
        $phoebeEventDispatch->addListener('irc.received.PRIVMSG', function (Event $event) use ($socket) {
            $message = $event->getMessage();
            $chatMessage = new ChatMessage($message['nick'], $message['params']['text']);
            $socket->send($chatMessage->toJson());
        });

    }

    public function run()
    {
        $phoebe = new ConnectionManager();
        $phoebe->addConnection($this->connection);
        $phoebe->run();
    }


}
