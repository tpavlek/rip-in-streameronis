<?php

require __DIR__.'/vendor/autoload.php';

$bot = new \Depotwarehouse\Streameroni\ChatBot();
$bot->setUsername("sc2ctl");
$bot->setPassword("oauth:yfq19g3z8tirn2xzbxyo1bvj1gdfjq");
$bot->setChannel("#sc2ctl");
$bot->setup();
$bot->run();
