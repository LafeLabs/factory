<!doctype html>
<html>
<head>
    <title>Meme 2 Map</title>
</head>
<body>
<div id = "linkdatadiv" style = "display:none">
<?php

$files = scandir(getcwd()."/../linkfeed/html");

foreach(array_reverse($files) as $value){
    if($value != "." && $value != ".." && substr($value,-4) == ".txt"){
        echo "<a>";
        echo file_get_contents("../linkfeed/html/".$value);
        echo "</a>\n";
    }
}



?></div>
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
echo file_get_contents("html/meme2map.txt");
?>

</body>
</html>
