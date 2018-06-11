

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
  var last = [];
  $(function(){
    
    document.onmousemove = function(e){
      var pageCoords = "( " + e.pageX + ", " + e.pageY + " )";
//      if(iam % 5 == 0){
        coordinate.push([e.pageX,e.pageY]);
        last = [];
        last.push([e.pageX,e.pageY]);
//      }
      iam++;
      console.log(pageCoords);
    };
    window.setInterval(function(){
        cord = coordinate;
        coordinate = [];
        lasts = last;
       $.post("index.php",{"uid":123,coordinate:cord,last:last},function(data){
        });
    }, 5000);
   
  })
</script>
</body>
</html>