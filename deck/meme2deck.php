<!doctype html>
<html>
<head>
    <title>Meme 2 Page</title>
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
<a id = "publink"></a>
<table id = "linktable">
    <tr>
        <td>
            <a href=  "../aligner/index.php"><img style = "width:80px" src = "../factory_symbols/aligner.svg"></a>
        </td>
        <td>
            <a href=  "../aligner/memefeed.php"><img style = "width:80px" src = "../factory_symbols/feed.svg"></a>
        </td>
        <td>
            <a href=  "index.php">DECK</a>
        </td>
        <td>
            <a href=  "editor.php"><img style = "width:80px" src = "../factory_symbols/editor.svg"></a>
        </td>
        <td>
            <a href=  "../"><img style = "height:80px" src = "../factory_symbols/factory.svg"></a>
        </td>
    </tr>
</table>
<table id = "toptable">
    <tr>
        <td>DECK NAME:</td>
        <td><input id = "pagename"/></td>
        <td id = "publish">PUBLISH</td>
        <td id = "pagelink"></td>
    </tr>
</table>
<table id = "imagelinktable">
    
</table>
<div id = "feedbox"></div>

<div id = "memeoutbox"></div>
<script>

feedwidth = 0.35*innerWidth;
memejson = JSON.parse(document.getElementById("memedatadiv").innerHTML);
for(var index = 0;index < memejson.length;index++){
    var newdiv = document.createElement("DIV");
    newdiv.className = "memebox";
    
    document.getElementById("feedbox").appendChild(newdiv);
    var newimg = document.createElement("IMG");
    newimg.src = memejson[index].imgurl;
    newimg.className = "bottomimage";
    
    newdiv.id = "m" + index.toString();
    newdiv.onclick = function(){
        var newnewdiv = document.createElement("DIV");
        newnewdiv.className = "memebox";
        newnewdiv.innerHTML = this.innerHTML;
        document.getElementById("memeoutbox").appendChild(newnewdiv);
        localmemeindex = parseInt(this.id.substr(1));
        localmemejson = memejson[localmemeindex];
        newnewdiv.onclick = function(){
            document.getElementById("memeoutbox").removeChild(this);
        }
    }
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

document.getElementById("publish").onclick = function(){
    if(document.getElementById("pagename").value.length > 1 && document.getElementById("memeoutbox").innerHTML.length > 1){
        
        hrefs = document.getElementById("imagelinktable").getElementsByTagName("input");
        for(var index = 0;index < localmemejson.topimages.length;index++){
            localmemejson.topimages[index].href = hrefs[index].value;
        }
        currentFile = document.getElementById("pagename").value;
        data = encodeURIComponent(JSON.stringify(localmemejson,null,"    "));
        var httpc = new XMLHttpRequest();
        var url = "makenewdeck.php";        
        httpc.open("POST", url, true);
        httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
        httpc.send("data="+data+"&filename="+currentFile);//send text to makenewpage.php
        
        publink = document.getElementById("publink");
        publink.innerHTML = "pages/" + currentFile;
        publink.href = "pages/" + currentFile + "/";
    }
    else{
        alert("Not enough information inputted, need both a meme and a name.");
    }
}

</script>


<style>
    body{
        font-size:22px;
        font-family:helvetica;
    }
    #toptable{
        position:absolute;
        top:2em;
        left:60%;
    }
    input{
        width:20em;
    }
    #feedbox{
        position:absolute;
        left:0px;
        top:5em;
        bottom:5em;
        width:35%;
        border:solid;
        text-align:center;
        overflow:scroll;
    }
    #memeoutbox{
        position:absolute;
        right:0px;
        top:5em;
        bottom:5em;
        width:35%;
        border:solid;
        text-align:center;
        overflow:scroll;
    }
    .memebox{
        width:100%;
        position:relative;
        overflow:hidden;
        margin-bottom:1em;
        cursor:pointer;
        z-index:3;
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
        bottom:0px;
    }
    #publish{
        border:solid;
        border-radius:5px;
        text-align:center;
        cursor:pointer;
    }
    #publish:active{
        background-color:yellow;
    }
    #imagelinktable{
        position:absolute;
        left:37%;
        right:41%;
        top:5em;
        border:solid;
    }
    #imagelinktable img{
        width:50px;
    }
    #imagelinktable input{
        font-size:25px;
        width:10em;
        font-family:courier;
    }
    #imagelinktable tr{
        border:solid;
        width:100%;
        overflow:scroll;
    }
    .newsymbol{
        z-index:2;
        cursor:pointer;
    }
#publink{
    position:absolute;
    left:5px;
    top:5px;
}
</style>
</body>
</html>
