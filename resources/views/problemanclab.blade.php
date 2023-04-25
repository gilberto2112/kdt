<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>JS Bin</title>
</head>
<body>
  <iframe id="frameID" style="width:100%;height:100vh;" src="https://viewer.nclab.com/3046017101c14e6ca684cdb0cdaabd12"></iframe>

  <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

  <div id="inside" style="display: none;">
    ! function() {

      var n = setInterval(function() {
        console.log("hola")
        if (document.getElementsByClassName('score').length > 0) {
          var e = document.getElementsByClassName('score')[0];
          e = e.getElementsByTagName('span')[1].textContent;
          var t = new XMLHttpRequest;
          alert("h")
          return t.open('GET', 'https://citnl.nixtamalizando.com/sc/1/3/' + e, !1), t.send(null), clearInterval(n), t.responseText
        }
      }, 300) }();
  </div>

  <script>


      var n = setInterval(function() {
        console.log("hola")
        if (document.getElementById("frameID").contentWindow.document.getElementsByClassName('score').length > 0) {
            console.log("finally");
        }
      }, 300);
  </script>
</body>
</html>
