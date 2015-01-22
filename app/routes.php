<?php

Route::get('test', function() {

        return View::make('test_socket');
});

Route::get('test_pull', function() {

        $script = "<script>alert('foo')</script>";
        $ext_site = file_get_contents('http://twitch.tv/chat/embed?channel=imaqtpie&amp;popout_chat=true');
        $ext_site = str_replace("twitch.tv", "localhost:8000", $ext_site);
        $start_position = strpos($ext_site, "</script>") + strlen("</script>");
        $injected = substr($ext_site, 0, $start_position) . $script . substr($ext_site, $start_position);
        return $ext_site;
});


Route::get('/', function()
{

        return View::make('index');
});
