<html>
<head>
    <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
    <style>

        .chat-header {
            display: none;
        }</style>
</head>
<body>

    <div id="my-cool-div">testwi</div>

    <script>
        function httpGet(theUrl)
        {
            var xmlHttp = null;

            xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", theUrl, false );
            xmlHttp.send( null );
            return xmlHttp.responseText;
        }

        console.log(httpGet("http://www.twitch.tv/p/about"));
        /*$.ajax({
            url: "http://www.twitch.tv/p/about",
            dataType: "html",
            method: "GET",
            success: function(data) {
                $('#my-cool-div').html(data);
            },
            error: function(jqxhr) {
                console.log(jqxhr);
            }
        });*/
    </script>
</body>
</html>
