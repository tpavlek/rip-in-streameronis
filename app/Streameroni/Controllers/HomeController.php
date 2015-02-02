<?php

namespace Depotwarehouse\Streameroni\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\MessageBag;
use View;

class HomeController extends Controller
{

    public function index()
    {
        return View::make('index');
    }

}
