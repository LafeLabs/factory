<!doctype html>
<html>
<head>
<title></title>
</head>
<div id = "memedatadiv" style = "display:none">
<!--<memedata/>-->    
</div>
<div id = "captiondata" style = "display:none"><?php

$files = scandir(getcwd()."/html");
foreach($files as $value){
    if($value != "." && $value != ".."){
        echo "\n<div class = \"captiondatacell\">\n";
        echo file_get_contents("html/".$value);
        echo "\n</div>\n";
    }
}

?></div>
<body>

<div id = "feedbox"></div>
<textarea id = "editbox"></textarea>
<div id = "closebutton"></div>
<script>
feedwidth = innerWidth;
memejson = JSON.parse(document.getElementById("memedatadiv").innerHTML);
captiondata = document.getElementById("captiondata").getElementsByClassName("captiondatacell");

memeIndex = 0;
document.getElementById("editbox").style.display = "none";
document.getElementById("feedbox").style.bottom = "0px";

for(var index = 0;index < memejson.length;index++){
    var newdiv = document.createElement("DIV");
    newdiv.className = "memebox";
    newdiv.id = "m" + index.toString();
    newdiv.onclick = function(){
        //edit caption
        memeIndex = parseInt(this.id.substr(1));
        document.getElementById("editbox").value = captions[memeIndex].innerHTML;

        document.getElementById("editbox").style.display = "block";
        document.getElementById("feedbox").style.bottom = "120px";
        document.getElementById("editbox").onkeyup = function(){
            captions[memeIndex].innerHTML = this.value;
            data = encodeURIComponent(this.value);
            currentFile = "html/caption" + memeIndex + ".txt";
            var httpc = new XMLHttpRequest();
            var url = "filesaver.php";        
            httpc.open("POST", url, true);
            httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
            httpc.send("data="+data+"&filename="+currentFile);//send text to filesaver.php
            //save html/captions.txt
        }
    }
    document.getElementById("feedbox").appendChild(newdiv);
    var newimg = document.createElement("IMG");
    newimg.src = memejson[index].imgurl;
    newimg.className = "bottomimage";
    newimg.onload = function(){
        this.parentNode.style.height = (this.height + 200).toString() + "px";
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
    
    var newcap = document.createElement("DIV");
    newcap.className = "caption";
    newdiv.appendChild(newcap);
}

captions = document.getElementById("feedbox").getElementsByClassName("caption");
for(var index = 0;index < captions.length;index++){
    captions[index].innerHTML = captiondata[index].innerHTML;
}
document.getElementById("closebutton").onclick = function(){
    document.getElementById("editbox").style.display = "none";
    document.getElementById("feedbox").style.bottom = "0px";
}

</script>
<style>
.topimage{
    position:absolute;
    z-index:0;
}
.bottomimage{
    width:100%;
    position:absolute;
    z-index:-1;
}
   
   
h1{
    position:absolute;
    top:1em;
    font-size:2em;
    font-family:Arial;
    width:100%;
    text-align:center;
}
.caption{
    text-align:justify;
    font-family:Helvetica;
    font-size:36px;
    padding-left:20%;
    padding-right:20%;
    position:absolute;
    bottom:0px;
    height:100px;
}
#feedbox{
    position:absolute;
    left:0px;
    top:0px;
    bottom:120px;
    right:0px;
    overflow:scroll;
}
#editbox{
    position:absolute;
    bottom:0px;
    height:100px;
    left:0px;
    width:50%;
    font-size:36px;
    font-family:Helvetica;
}
#closebutton{
    position:absolute;
    right:0px;
    bottom:0px;
    height:100px;
    width:49%;
    cursor:pointer;
    z-index:-4;
}
    .memebox{
        width:100%;
        position:relative;
        overflow:hidden;
        margin-bottom:1em;
        cursor:pointer;
        z-index:3;
        border-bottom:solid;
        border-width:10px;
    }

</style>
</body>
</html>