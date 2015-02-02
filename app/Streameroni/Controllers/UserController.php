<?php

namespace Depotwarehouse\Streameroni\Controllers;

use Depotwarehouse\Streameroni\User\UserRepository;
use Illuminate\Routing\Controller;
use View;

class UserController extends Controller
{

    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function show($username)
    {
        $user = $this->userRepository->getByUsername($username);
        return View::make('user.show')
            ->with('user', $user);
    }
}
