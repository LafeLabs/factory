<!doctype html>
<html>
<head>
<title>Image Upload</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">
</head>
<body>
<div id = "listdiv" style = "display:none"><?php

//echo file_get_contents("list.txt");
$files = scandir(getcwd()."/images");
$listtext = "";
foreach(array_reverse($files) as $value){
    if($value != "." && $value != ".."){
        $listtext .= $value.",";
    }
}
echo $listtext;

?></div>
<?php
echo file_get_contents("html/index.txt");
?>
</body>
</html>