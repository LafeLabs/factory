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
<table id = "linktable">
    <tr>
        <td>
            <a href=  "editor.php">EDIT CODE</a>
        </td>
        <td>
            <a href=  "../aligner/index.php"><img style = "width:100px" src = "../factory_symbols/aligner.svg"></a>
        </td>
    </tr>
</table>
<table id = "toptable">
    <tr>
        <td>PAGE NAME:</td>
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

feedwidth = 0.4*innerWidth;
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
        document.getElementById("memeoutbox").innerHTML = this.innerHTML;
        localmemeindex = parseInt(this.id.substr(1));
        localmemejson = memejson[localmemeindex];
        document.getElementById("imagelinktable").innerHTML = "";
        for(var bindex = 0;bindex < localmemejson.topimages.length;bindex++){
            var newtr = document.createElement("TR");
            var newtd = document.createElement("TD");
            var newimg = document.createElement("IMG");
            newimg.src = localmemejson.topimages[bindex].url;
            newtd.appendChild(newimg);
            newtr.appendChild(newtd);
            var newtd = document.createElement("TD");
            newtr.appendChild(newtd);
            newtd.innerHTML = "<input/>";
            document.getElementById("imagelinktable").appendChild(newtr);
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
        var url = "makenewpage.php";        
        httpc.open("POST", url, true);
        httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
        httpc.send("data="+data+"&filename="+currentFile);//send text to makenewpage.php
        
        newa = document.createElement("a");
        newa.innerHTML = currentFile;
        newa.href = currentFile + "/";
        document.getElementById("pagelink").appendChild(newa);
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
        width:40%;
        border:solid;
        text-align:center;
        overflow:scroll;
    }
    #memeoutbox{
        position:absolute;
        right:0px;
        top:5em;
        bottom:5em;
        width:40%;
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
        left:41%;
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


</style>
</body>
</html>
