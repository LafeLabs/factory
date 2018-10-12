<!doctype html>
<html>
<head>
<title>Map List</title>
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
<table id = "linktable">
    <tr>
        <td>
            <a href = "index.php">
                <img src = "../factory_symbols/map.svg"/>
            </a>
        </td>
        <td>
            <a href = "mapalign.php">
                <img src = "../factory_symbols/mapalign.svg"/>
            </a>
        </td>
        <td>
            <a href = "meme2map.php">
                <img src = "../factory_symbols/meme2map.svg"/>
            </a>
        </td>
        <td>
            <a href = "editor.php">
                <img src = "../factory_symbols/editor.svg"/>
            </a>
        </td>
        <td>
            <a href = "../">
                <img src = "../factory_symbols/factory.svg"/>
            </a>
        </td>
    </tr>

</table>

<h1>Map List</h1>
    
<ul id = "maplist">
</ul>

<script>
maps = document.getElementById("dirlistdiv").innerHTML.split(",");
if(maps.length > 0){
    for(var index  = 0;index < maps.length;index++){
        if(maps[index].length > 0){
            var newli = document.createElement("LI");
            var newa = document.createElement("A");
            newa.innerHTML = "maps/" + maps[index] + "/";
            newa.href = "maps/" + maps[index] + "/";
            newli.appendChild(newa);
            document.getElementById("maplist").appendChild(newli);
        }
    }
}
</script>
<style>
body{
    font-family:Helvetica;
    font-size:24px;
}
h1{
    width:100%;
    text-align:center;
    position:absolute;
    z-index:-1;
    top:0px;
    left:0px;
    
}
#linktable{
    position:absolute;
    right:0px;
    top:0px;
}
#linktable img{
    width:80px;
}
#maplist{
    list-style:none;
    position:absolute;
    top:150px;
    left:150px;
}
</style>

</body>
</html>