<html>
<head>
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        .iframe-holder {
            position:relative;
            height: 100%;
        }
        .black-box {
            position: absolute; top: 0;
            height: calc(100% - 131px);
            width:400px;
            background: black;
            overflow-y: scroll;
            color:white;
        }
    </style>
</head>
<body>
<script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>


    <div class="iframe-holder">
        <div class="black-box">

        </div>
        <iframe frameborder="0"
                scrolling="no"
                id="chat_embed"
                src="http://twitch.tv/chat/embed?channel=imaqtpie"
                height="100%"
                width="400">
        </iframe>
    </div>
    <!--<script src="http://autobahn.s3.amazonaws.com/js/autobahn.min.js"></script>
    <script>
        var conn = new ab.Session('ws://localhost:9001',
                function() {
                    conn.subscribe('chat_messages', function(topic, data) {
                        $('.black-box').append(data + "<br />");
                        console.log(data);
                    });
                },
                function() {
                    console.warn('WebSocket connection closed');
                },
                {'skipSubprotocolCheck': true}
        );
    </script>-->
</body>
</html>
