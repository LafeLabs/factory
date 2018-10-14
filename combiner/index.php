<!doctype html>
<html>
<head>
<title>Combiner</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.

-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">

</head>
<body>
<div id = "curvesdatadiv" style = "display:none"><?php

$files = scandir(getcwd()."/../curve/svg");
$listtext = "";
foreach(array_reverse($files) as $value){
    if($value != "." && $value != ".." && substr($value,-4) == ".svg"){
        $listtext .= $value.",";
    }
}
echo $listtext;

?></div>
<div id = "symbolssymbolsdatadiv" style = "display:none"><?php

$symbolsfiles = scandir(getcwd()."/../symbol/symbols");

foreach($symbolsfiles as $derp){
    if($derp != ".." && $derp != "."){
        $listtext = "";  
        $files = scandir(getcwd()."/../symbol/symbols/".$derp."/svg");
        foreach(array_reverse($files) as $value){
            if($value != "." && $value != ".." && substr($value,-4) == ".svg"){
                $listtext .= $derp."/svg/".$value.",";
            }
        }
        echo $listtext;    
        
    }
}


?></div>

<div id = "symbolsdatadiv" style = "display:none"><?php

$files = scandir(getcwd()."/../symbol/svg");
$listtext = "";
foreach(array_reverse($files) as $value){
    if($value != "." && $value != ".." && substr($value,-4) == ".svg"){
        $listtext .= $value.",";
    }
}
echo $listtext;

?></div>

<div id = "imagesdatadiv" style = "display:none"><?php

$files = scandir(getcwd()."/../images/images");
$listtext = "";
foreach(array_reverse($files) as $value){
    if($value != "." && $value != ".."){
        $listtext .= $value.",";
    }
}
echo $listtext;

?></div>
<?php
echo file_get_contents("html/index.txt")
?>

</body>
</html>