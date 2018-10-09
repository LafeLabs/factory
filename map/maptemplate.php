<!doctype html>
<html>
<head>
<title>Map</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.

EVERYTHING IS PHYSICAL
EVERYTHING IS FRACTAL
EVERYTHING IS RECURSIVE

NO MONEY
NO PROPERTY
NO MINING

LOOK AT THE INSECTS
LOOK AT THE FUNGI
LANGUAGE IS HOW THE MIND PARSES REALITY
-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">

</head>
<body>
<div id = "dirlistdiv" style = "display:none"><?php

$files = scandir(getcwd()."/maps");
foreach($files as $value){
    if($value != "." && $value != ".."){
        echo $value.",";
    }
}

?></div>
<div id = "jsondatadiv" style = "display:none"><?php

echo file_get_contents("json/currentjson.txt");

?></div>
<?php
    echo file_get_contents("html/index.txt");
?>

<style>
body{
    font-family:Helvetica;
    font-size:1.5em;
}
h1,h2,h3,h4,h5{
    width:100%;
    text-align:center;
}
</style>

</body>
</html>