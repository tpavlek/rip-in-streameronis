<?php

namespace Depotwarehouse\Streameroni\Controllers;

use Auth;
use Depotwarehouse\OAuth2\Client\Twitch\Entity\TwitchUser;
use Depotwarehouse\OAuth2\Client\Twitch\Provider\Twitch;
use Depotwarehouse\Streameroni\User\UserRepository;
use Depotwarehouse\Toolbox\Exceptions\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Routing\Controller;
use Illuminate\Support\MessageBag;
use Input;
use Redirect;
use View;

class AuthController extends Controller
{

    protected $twitchProvider;
    protected $userRepository;

    public function __construct(Twitch $twitchProvider, UserRepository $userRepository)
    {
        $this->twitchProvider = $twitchProvider;
        $this->userRepository = $userRepository;
    }

    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function login()
    {
        return View::make('login.login');
    }

    /**
     * Redirect to the twitch authorization server.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function twitchUrl()
    {
        return Redirect::to($this->twitchProvider->getAuthorizationUrl());
    }


    /**
     * Authenticates a user via their twitch credentials.
     *
     * @return Redirect
     */
    public function twitchAuth()
    {
        if (isset($_GET['code']) && $_GET['code']) {
            $token = $this->twitchProvider->getAccessToken("authorization_code", [
                'code' => $_GET['code']
            ]);

            /** @var TwitchUser $user */
            $user = $this->twitchProvider->getUserDetails($token);

            try {
                $userLocal = $this->userRepository->find($user->getId());

                // If the account already exists, we'll attempt to update the details.
                $this->userRepository->update($user->getId(), (array)$user);

                return $this->redirectToUser($user->getId(), $user->getUsername());

            } catch (ModelNotFoundException $exception) {

                try {
                    $userLocal = $this->userRepository->create($user->toArray());
                    return $this->redirectToUser($user->getId(), $userLocal->username);

                } catch (ValidationException $exception) {

                    return Redirect::route('home.index')
                        ->withErrors($exception->get());
                }

            }

        }
        return Redirect::route('home')
            ->withErrors(new MessageBag([
                'errors' => "Could not associate with your Twitch Account"
            ]));
    }

    /**
     * Logs in a user and redirects to his/her profile page.
     *
     * @param $user_id
     * @param $username
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectToUser($user_id, $username)
    {
        Auth::loginUsingId($user_id);
        return Redirect::route('user.show', $username);
    }

    /**
     * Logs out a user
     *
     * @return Redirect
     */
    public function logout()
    {
        Auth::logout();
        return Redirect::route('home.index');
    }

    /**
     * Displays the register form.
     *
     * @return \Illuminate\View\View
     */
    public function register()
    {
        return View::make('login.register');
    }


}
