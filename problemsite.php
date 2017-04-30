<html>
    <head>
        <meta charset="utf-8">
        <link href="styles/css.css" rel="stylesheet">
        <title>harald-issues-projekt</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="inlagg">
                <div class="header">
                    <h1>Titel</h1>
                </div>
                <div class="content">
                    <pre>
$(document).ready(function (){
     $("#kontaktbutton").click(function (){
        $('html, body').animate({
              scrollTop: $("#kontakt").offset().top
           }, 1000);
       });
});
$(document).ready(function (){
    $("#nyhetbutton").click(function (){
        $('html, body').animate({
            scrollTop: $("#nyheter").offset().top
        }, 500);
       });
   });
$(document).ready(function (){
     $("#kontaktbutton").click(function (){
        $('html, body').animate({
              scrollTop: $("#kontakt").offset().top
           }, 1000);
       });
});
                    </pre>
                </div>
                <div class="commentfield">
                    <textarea style="float:left; width:85%;"></textarea>
                    <button>Kommentera</button>
                </div>
            </div>
        </div>
    </body>
</html>