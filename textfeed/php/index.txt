<!doctype html>
<html>
<head>
<title>Text Feed</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">
<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
   <script>
	MathJax.Hub.Config({
		tex2jax: {
		inlineMath: [['$','$'], ['\\(','\\)']],
		processEscapes: true,
		processClass: "mathjax",
        ignoreClass: "no-mathjax"
		}
	});//			MathJax.Hub.Typeset();//tell Mathjax to update the math
</script>
</head>
<body>
<div  class="no-mathjax" id = "datadiv" style = "display:none"><?php
$files = scandir(getcwd()."/text");
foreach($files as $value){
    if($value != "." && $value != ".."){
        echo "\n<feedbox id = \"".substr($value,0,-4)."\">\n";
        echo file_get_contents("text/".$value);
        echo "\n</feedbox>\n";
    }
}
?></div>

<?php

echo file_get_contents("html/index.txt");

?>

</body>
</html>