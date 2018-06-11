

<!DOCTYPE html>
<html>
<head>
    <title>Sample</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div id="yourDivId" style="background-color: red;width: 20px;height: 20px;position: absolute">

</div>


<a href="http://somegreatsite.com">Link Name</a>

is a link to another nifty site

<H1>This is a Header</H1>

<H2>This is a Medium Header</H2>

Send me mail at <a href="mailto:support@yourcompany.com">

    support@yourcompany.com</a>.

<P> This is a new paragraph!

<P> <B>This is a new paragraph!</B>

    <BR> <B><I>This is a new sentence without a paragraph break, in bold italics.</I></B>

<HR>

<script type="text/javascript">
    var iam=0;
    var coordinate=[];
    var len = 0;
    var diff = 0;
    $(function(){


        function Timer(fn, t) {
            var timerObj = setInterval(fn, t);

            this.stop = function() {
                if (timerObj) {
                    clearInterval(timerObj);
                    timerObj = null;
                }
                return this;
            }

            // start timer using current settings (if it's not already running)
            this.start = function() {
                if (!timerObj) {
                    this.stop();
                    timerObj = setInterval(fn, t);
                }
                return this;
            }

            // start with new interval, stop current interval
            this.reset = function(newT) {
                t = newT;
                return this.stop().start();
            }
        }
        var timer = new Timer(function() {
            if(iam>len){
                iam = 0;
                this.stop();
            }
            placeDivider(coordinate[iam])
            iam = iam +diff;
        }, 250);

        fss = [["260","20"],["269","30"],["281","42"],["299","63"],["322","95"],["326","105"],["324","120"],["314","131"],["298","142"],["289","146"],["283","148"],["279","148"],["282","146"],["298","137"],["336","125"],["366","124"],["430","138"],["488","182"],["525","232"],["530","267"],["511","288"],["489","298"],["468","298"],["451","294"],["439","280"],["438","267"],["437","257"],["437","228"],["441","214"],["446","212"],["449","212"],["450","212"],["451","212"],["452","212"],["450","213"],["437","215"],["418","215"],["383","205"],["356","193"],["349","183"],["349","174"],["363","151"],["364","150"],["368","150"]];
//        var refreshIntervalId = window.setInterval(function(){
//            if(iam>len){
//                iam = 0;
//                clearInterval(refreshIntervalId);
//            }
//            placeDivider(coordinate[iam])
//            iam = iam +diff;
//
//        },250)
//        $.each(fss,function(ii,ele){
//                setTimeout(function(){
//                        console.log("ss");
//                        placeDiv(ele[0],ele[1])
//                    }
//                    , 100);
//
//
//        })
        window.setInterval(function(){
            $.get("index.php",{"puid":123},function(data){
//                if(data.length<0){
//                    intre = 5/data.length;
//                }else{
//                    intre = parseInt(5/data.length);
//                }
                coordinate = data;
                len = data.length;
                iam=0;
                diff = parseInt(data.length/20);
                timer.reset(250);

//                console.log(intre,data.length);
//                $.each(data,function(ii,ele){
//                    if(ii%intre == 0 || ii==0){
//                        console.log(ii);
//                        setTimeout(function(){
//                                console.log("ss");
//                                placeDiv(ele[0],ele[1])
//                            }
//                            , 1000);
//                    }
//
//
//                })
            });
            coordinate=[];
        }, 5000);

        function positionCards() {
            var $cards = $('#gameboard .card');

            var time = 500;

            setTimeout(function(){
                $(el).animate({
                    'opacity':1.0
                }, 450);
            },500 + ( i * 500 ));
        }

        function placeDiv(x_pos, y_pos) {
//            console.log(x_pos);
            var d = document.getElementById('yourDivId');
            d.style.position = "absolute";
            d.style.left = x_pos+'px';
            d.style.top = y_pos+'px';
        }
        function placeDivider(ls) {
            if (typeof ls == "undefined"){
                return true;
            }
//            console.log(x_pos);
            x_pos = ls[0];
            y_pos = ls[1];
            var d = document.getElementById('yourDivId');
            d.style.position = "absolute";
            d.style.left = x_pos+'px';
            d.style.top = y_pos+'px';
        }
    })
</script>
</body>
</html>