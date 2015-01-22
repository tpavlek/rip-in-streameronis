<?php

require __DIR__.'/vendor/autoload.php';

$bot = new \Depotwarehouse\Streameroni\ChatBot();
$bot->setUsername("sc2ctl");
$bot->setPassword("");
$bot->setup();
$bot->run();
