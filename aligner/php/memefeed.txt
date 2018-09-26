<!doctype html>
<html>
<head>
    <title>Meme Feed</title>
</head>
<body>
<div id = "memefilediv" style = "display:none"><?php

$files = scandir(getcwd()."/memes");
$listtext = "";
foreach(array_reverse($files) as $value){
    if($value != "." && $value != ".." && substr($value,-4) == ".txt"){
        $listtext .= $value.",";
    }
}
echo $listtext;

?></div>        
<div id = "memedatadiv" style = "display:none"><?php

$files = scandir(getcwd()."/memes");

$datatext = "[\n";

foreach(array_reverse($files) as $value){
    if($value != "." && $value != ".." && substr($value,-4) == ".txt"){
        $datatext .= file_get_contents("memes/".$value);
        $datatext .= ",\n";
    }
}
$datatext = rtrim($datatext, ",\n");
$datatext .= "\n]";
echo $datatext;



?></div>        
<table id = "linktable">
    <tr>
        <td>
            <a href=  "editor.php">EDIT CODE</a>
        </td>
    </tr>
    <tr>
        <td>
            <a href=  "index.php">ALIGNER</a>
        </td>
    </tr>
</table>
<div id = "delete">!DELETE ALL!</div>
<div id = "feedbox">
    
</div>
<script>

feedwidth = innerWidth*0.8;
memejson = JSON.parse(document.getElementById("memedatadiv").innerHTML);
for(var index = 0;index < memejson.length;index++){
    var newdiv = document.createElement("DIV");
    newdiv.className = "memebox";
    document.getElementById("feedbox").appendChild(newdiv);
    var newimg = document.createElement("IMG");
    newimg.src = memejson[index].imgurl;
    newimg.className = "bottomimage";
    newdiv.appendChild(newimg);
    for(var imgindex = 0;imgindex < memejson[index].topimages.length;imgindex++){
        var newimg2 = document.createElement("img");
        newimg2.className = "topimage";
        newimg2.src = memejson[index].topimages[imgindex].url;
        newimg2.style.width = (memejson[index].topimages[imgindex].woverw*feedwidth).toString() + "px";
        newimg2.style.left = (memejson[index].topimages[imgindex].xoverw*feedwidth).toString() + "px";
        newimg2.style.top = (memejson[index].topimages[imgindex].yoverw*feedwidth).toString() + "px";
        newimg2.style.transform = "rotate(" + (memejson[index].topimages[imgindex].angle).toString() + "deg)";
        newdiv.appendChild(newimg2);
    }
    
}

document.getElementById("delete").onclick = function(){
    var httpc = new XMLHttpRequest();
    var url = "deleteallmemes.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send();//
    document.getElementById("feedbox").innerHTML = "";
}

</script>


<style>
    body{
        font-size:22px;
        font-family:helvetica;
    }
    #feedbox{
        position:absolute;
        left:5%;
        top:5em;
        bottom:10px;
        width:80%;
        border:solid;
        text-align:center;
        overflow:scroll;
    }
    .memebox{
        width:100%;
        position:relative;
    }
    .bottomimage{
        width:100%;
        position:relative;
        z-index:-1;
    }
    .topimage{
        position:absolute;
        z-index:0;
    }
    #linktable{
        position:absolute;
        right:0px;
        top:0px;
    }
    #delete{
        position:absolute;
        z-index:2;
        right:0px;
        bottom:0px;
        cursor:pointer;
        border:solid;
        border-color:red;
        color:red;
    }
    #delete:active{
        background-color:yellow;
    }
</style>
</body>
</html>
