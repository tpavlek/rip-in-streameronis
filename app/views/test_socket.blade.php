<html>
<head>

</head>
<body>
    Check your javascript console.
    <script src="http://autobahn.s3.amazonaws.com/js/autobahn.min.js"></script>
    <script>
        var conn = new ab.Session('ws://localhost:9001',
                function() {
                    conn.subscribe('chat_messages', function(topic, data) {
                        console.log(data);
                    });
                },
                function() {
                    console.warn('WebSocket connection closed');
                },
                {'skipSubprotocolCheck': true}
        );
    </script>
</body>
</html>
