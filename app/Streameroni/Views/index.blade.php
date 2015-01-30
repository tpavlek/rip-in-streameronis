@extends('layout')

@section('title')
    View Stream
@stop

@section('content')
    <div class="video-player-wrapper">
        <div class="video-player-overlay"></div>
        <div class="video-player">
            <iframe class="stream"
                    src="http://www.twitch.tv/sc2ctl/embed"
                    frameborder="0"
                    scrolling="no"
                    >
            </iframe>
        </div>
        <div class="control-buttons">
            <a href="#" class="button">Subscribe ($5)</a>
        </div>
    </div>

    <div class="chat-wrapper">
        <div class="chat-holder">
            <div class="chat-box">
                @include('partials.seedChatMessages')

            </div>
            <iframe frameborder="0"
                    scrolling="no"
                    id="chat_embed"
                    src="http://twitch.tv/chat/embed?channel=sc2ctl"
                    height="100%"
                    width="400">
            </iframe>
        </div>
    </div>
    <script src="http://autobahn.s3.amazonaws.com/js/autobahn.min.js"></script>
    <script>

        function chat(user, message) {
            var chatBox = $(".chat-box");

            // We don't want to include padding, so we get the innerHeight.
            var chat_height = chatBox.innerHeight();
            var cur_scroll = chatBox.scrollTop();
            var scroll_height = chatBox.prop("scrollHeight");

            chatBox.append(
                    "<div class='chat-message'>" +
                    "<span class='chat-user'>" + user + "</span>: " + message +
                    "</div>"
            );

            /* We only want to scroll if the user was at the bottom of the page when the new message came in. */
            // We give 10 pixels of buffer room, if you have less than 10 pixels to the bottom, you're at the bottom.
            if (scroll_height - (chat_height + cur_scroll) < 10) {
                chatBox.animate({ scrollTop: chatBox.prop("scrollHeight")}, 500);
            }

        }

        var conn = new ab.Session('ws://test.sc2ctl.com:9001',
                function() {
                    conn.subscribe('chat_messages', function(topic, data) {
                        chat(data.author, data.message);
                    });
                },
                function() {
                    console.warn('WebSocket connection closed');
                },
                {'skipSubprotocolCheck': true}
        );


    </script>
@stop
