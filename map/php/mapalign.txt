<!doctype html>
<html>
<head>
<title>Map Align</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.

-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">

</head>
<body>
<div id = "markerjsondatadiv" style = "display:none"><?php

echo file_get_contents("marker/json/currentjson.txt");

?></div>
<div id = "meme2mapdatadiv" style = "display:none"><?php

echo file_get_contents("json/meme2map.txt");

?></div>
<div id = "jsondatadiv" style = "display:none"><?php

echo file_get_contents("json/currentjson.txt");

?></div>
<?php
echo file_get_contents("html/mapalign.txt")
?>
<style>

body{
    font-size:1.5em;
    font-family:helvetica;
}
</style>
</body>
</html>