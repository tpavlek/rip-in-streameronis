<?php

Route::get('test', function () {
   dd(getenv('TWITCH_CLIENT_ID'));
});

Route::get('test_pull', function () {

    $script = "<script>alert('foo')</script>";
    $ext_site = file_get_contents('http://twitch.tv/chat/embed?channel=imaqtpie&amp;popout_chat=true');
    $ext_site = str_replace("twitch.tv", "localhost:8000", $ext_site);
    $start_position = strpos($ext_site, "</script>") + strlen("</script>");
    $injected = substr($ext_site, 0, $start_position) . $script . substr($ext_site, $start_position);
    return $ext_site;
});


Route::group([ 'namespace' => '\Depotwarehouse\Streameroni\Controllers' ], function () {

    Route::get('/', [ 'as' => 'home.index', 'uses' => 'HomeController@index' ]);
    Route::get('user/{username}', [ 'as' => 'user.show', 'uses' => 'UserController@show' ]);

    Route::group([ 'before' => 'guest' ], function() {
        Route::get('login', [ 'as' => 'login', 'uses' => 'AuthController@twitchUrl' ]);
        Route::get('login/twitch', [ 'as' => 'login.twitch', 'uses' => 'AuthController@twitchUrl' ]);
        Route::get('twitch_auth', [ 'as' => 'login.twitch_auth', 'uses' => 'AuthController@twitchAuth' ]);
    });


});
