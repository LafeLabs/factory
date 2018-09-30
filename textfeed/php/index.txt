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
$files = scandir(getcwd()."/html");
foreach(array_reverse($files) as $value){
    if($value != "." && $value != ".."){
        echo "\n<feedbox id = \"".substr($value,0,-4)."\">\n";
        echo file_get_contents("html/".$value);
        echo "\n</feedbox>\n";
    }
}
?></div>

<table id = "toptable">
    <tr>
        <td>color:</td><td><input id = "colorinput" value = "black"></td>
    </tr>
    <tr>
        <td>fontSize:</td><td><input id = "sizeinput" value = "22px"></td>
    </tr>
    <tr>
        <td>fontFamily:</td><td><input id = "fontinput" value = "Helvetica"></td>
    </tr>
    <tr>
        <td>ENTER WORDS:</td>
        <td><input id = "wordsinput"/></td>
        <td class = "button" id = "delete">CLEAR</td>
    </tr>

</table>

<div id = "scrolldiv"  class = "mathjax"></div>


<table id = "bottomtable">
    <tr>
        <td>
            <a href = "../images/">
                <img src = "../factory_symbols/images.svg">
            </a>
        </td>
        <td>
            <a href = "../combiner/">
                <img src = "../factory_symbols/combiner.svg">
            </a>
        </td>
        <td>
            <a href = "editor.php"><img src = "../factory_symbols/editor.svg"></a>
        </td>
        <td>
            <a href = "../"><img src = "../factory_symbols/factory.svg"></a>
        </td>
    </tr>
</table>

<script>

document.getElementById("wordsinput").select();


init();
function init(){
    mathIndex = 0;
    htmldatadivs = document.getElementById("datadiv").getElementsByTagName("feedbox");
    for(var index = 0;index < htmldatadivs.length;index++){
        var newp = document.createElement("p");
        newp.innerHTML = htmldatadivs[index].innerHTML;
        document.getElementById("scrolldiv").appendChild(newp);
    }
    MathJax.Hub.Typeset();//tell Mathjax to update the math
}

document.getElementById("wordsinput").onchange = function(){
    

    data = encodeURIComponent(this.value);
    timestamp = Math.round((new Date().getTime())/1000);
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data=" + data + "&filename=" + "html/html" + timestamp + ".txt");//send text to filesaver.php
    var httpc = new XMLHttpRequest();

    var oldhtml = document.getElementById("datadiv").innerHTML;
    var newhtml = "\n<feedbox id = \"html" + timestamp.toString() + "\">\n" + this.value + "\n</feedbox>\n" + oldhtml;
    document.getElementById("datadiv").innerHTML = newhtml;
    
    htmldatadivs = document.getElementById("datadiv").getElementsByTagName("feedbox");
    mathIndex = 0;

    var newp = document.createElement("P");
    newp.innerHTML = this.value;
    newp.style.fontSize = document.getElementById("sizeinput").value;
    newp.style.color = document.getElementById("colorinput").value;
    newp.style.fontFamily = document.getElementById("fontinput").value;
    if(document.getElementById("scrolldiv").innerHTML.length > 0){
        var ps = document.getElementById("scrolldiv").getElementsByTagName("P");
        document.getElementById("scrolldiv").insertBefore(newp,ps[0]);
    }
    else{
        document.getElementById("scrolldiv").appendChild(newp);
    }
    MathJax.Hub.Typeset();//tell Mathjax to update the math
    this.value = "";
}

document.getElementById("wordsinput").onkeydown = function(e) {
    charCode = e.keyCode || e.which;
    if(charCode == 050){
        this.value = htmldatadivs[mathIndex].innerHTML;
        mathIndex++;
        if(mathIndex > htmldatadivs.length - 1){
            mathIndex = 0;
        }
    }
    if(charCode == 046){
        this.value = htmldatadivs[mathIndex].innerHTML;
        mathIndex--;
        if(mathIndex < 0){
            mathIndex = htmldatadivs.length - 1;
        }
    }
}


document.getElementById("delete").onclick = function(){
    var httpc = new XMLHttpRequest();
    var url = "deletealltext.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send();//
    document.getElementById("datadiv").innerHTML = "";
    document.getElementById("scrolldiv").innerHTML = "";
    document.getElementById("wordsinput").value = "";
    
}

</script>

<style>
    body{
        font-family:Helvetica;
        font-size:22px;
    }

    .button{
        cursor:pointer;
        font-size:22px;
        padding-left:1em;
        padding-right:1em;
        padding-top:10px;
        padding-bottom:10px;
    }
    .button:hover{
        background-color:green;
    }
    .button:active{
        background-color:yellow;
    }
    #wordsinput{
        width:25em;
        font-size:22px;
    }
    #wordsinputbox{
        position:absolute;
        top:3em;
        left:1em;
    }
    #linktable{
        position:absolute;
        right:10px;
        top:10px;
    }
    #scrolldiv{
        position:absolute;
        top:8em;
        bottom:5em;
        right:0px;
        left:0px;
        overflow:scroll;
        padding:1em 1em 1em 1em;
        border-top:solid;
    }
    #bottomtable{
        position:absolute;
        left:0px;
        bottom:0px;
    }
    #bottomtable img{
        width:80px;
    }
    #toptable{
        position:absolute;
        left:0px;
        top:0px;
    }
</style>

</body>
</html>