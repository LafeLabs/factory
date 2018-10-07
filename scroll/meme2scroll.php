<!doctype html>
<html>
<head>
    <title>Meme 2 Page</title>
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
<div id = "memedatadiv" style = "display:none"><?php

$files = scandir(getcwd()."/../aligner/memes");

$datatext = "[\n";

foreach(array_reverse($files) as $value){
    if($value != "." && $value != ".." && substr($value,-4) == ".txt"){
        $datatext .= file_get_contents("../aligner/memes/".$value);
        $datatext .= ",\n";
    }
}
$datatext = rtrim($datatext, ",\n");
$datatext .= "\n]";
echo $datatext;

?></div>        
<?php
echo file_get_contents("html/meme2scrollpage.txt");
?>

</body>
</html>
