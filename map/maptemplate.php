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
<div id = "jsondatadiv" style = "display:none"><?php

echo file_get_contents("json/currentjson.txt");

?></div>

<table id = "linktable">
    <tr>
        <td>
            <a href = "../../maplist.php">
                <img style = "width:80px" src = "../../../factory_symbols/maplist.svg"/>
            </a>
        </td>
        <td>
            <a href = "../../">
                <img style = "width:80px" src = "../../../factory_symbols/map.svg"/>
            </a>
        </td>
        <td>
            <a href=  "../../../"><img style = "height:80px" src = "../../../factory_symbols/factory.svg"></a>
        </td>

    </tr>
</table>

<div id = "memebox">
    <img id = "mainImage"/>
</div>



<script>
if(document.getElementById("jsondatadiv").innerHTML.length>0){
    memejson = JSON.parse(document.getElementById("jsondatadiv").innerHTML);
}
else{
    memejson = {};
}


document.getElementById("mainImage").src = memejson.imgurl;
document.getElementById("mainImage").onload = function(){
    if(this.width > innerWidth){
        var aspectRatio = this.width/this.height; 
        this.width = innerWidth;
        this.style.height = (this.width/aspectRatio).toString() + "px";
        feedwidth = innerWidth;
    }
    else{
        feedwidth = this.width;
    }

    init();
}


function init(){
    for(var index = 0;index < memejson.topimages.length;index++){
        var newimg = document.createElement("img");
        newimg.className = "topimage";
        newimg.src = memejson.topimages[index].url;
        if(memejson.topimages[index].href.length > 1){
            var newa = document.createElement("a");
            newa.href = memejson.topimages[index].href;
            newa.style.width = (memejson.topimages[index].woverw*feedwidth).toString() + "px";
            newa.style.left = (memejson.topimages[index].xoverw*feedwidth).toString() + "px";
            newa.style.top = (memejson.topimages[index].yoverw*feedwidth).toString() + "px";
            newa.style.transform = "rotate(" + (memejson.topimages[index].angle).toString() + "deg)";       
            newa.style.position = "absolute";
            newimg.style.left = "0px";
            newimg.style.top = "0px";
            newimg.style.width = "100%";
            newimg.onload = function(){
                this.parentElement.style.height = (this.height).toString() + "px";
            }
            newa.appendChild(newimg);
            document.getElementById("memebox").appendChild(newa);
        }
        else{
            newimg.style.width = (memejson.topimages[index].woverw*feedwidth).toString() + "px";
            newimg.style.left = (memejson.topimages[index].xoverw*feedwidth).toString() + "px";
            newimg.style.top = (memejson.topimages[index].yoverw*feedwidth).toString() + "px";
            newimg.style.transform = "rotate(" + (memejson.topimages[index].angle).toString() + "deg)";
            document.getElementById("memebox").appendChild(newimg);   
        }
    }
}



</script>
<style>
body{
    overflow:hidden;
}
#mainImage{
    position:absolute;
    height:100%;
    left:0px;
    top:0px;
    z-index:-1;
}
#linktable{
    position:absolute;
    right:0px;
    top:0px;
}  
.topimage{
    position:absolute;
    z-index:0;
}
#memebox{
    position:absolute;
    top:0px;
    left:0px;
    right:0px;
    bottom:0px;
    overflow:hidden;
    z-index:-1;
}
</style>

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