<html>
<head>
    <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
    <style>

        .chat-header {
            display: none;
        }</style>
</head>
<body>
<iframe frameborder="0"
        scrolling="no"
        id="chat_embed"
        src="http://twitch.tv/chat/embed?channel=imaqtpie"
        height="600"
        width="400">
</iframe>
<div>
    chat room
</div>


<script>
    $(document).ready(function() {
        //logStuff();
        //setTimeout(logStuff, 1000);
        setInterval(replaceStuff, 50);



    });

    function replaceStuff() {
        $("body").children().each(function () {
            $(this).html( $(this).html().replace(/chat room/g,"$") );
        });
    }

    function logStuff() {
        console.log("logging stuff");
        console.log($("#chat_embed").contents().find("body").html());
    }
</script>



</body>
</html>
