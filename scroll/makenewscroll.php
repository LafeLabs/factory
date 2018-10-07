<?php
/* javascript this pairs with:

        currentFile = document.getElementById("pagename").value;
        data = encodeURIComponent(JSON.stringify(localmemejson,null,"    "));
        var httpc = new XMLHttpRequest();
        var url = "makenewpage.php";        
        httpc.open("POST", url, true);
        httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
        httpc.send("data="+data+"&filename="+currentFile);//send text to makenewpage.php
        
*/
    $data = $_POST["data"]; //get data 
    $filename = "scrolls/".$_POST["filename"];//name of new directory

    //make the new directory, and the subdirectory for images
    mkdir($filename);

    //make index.html
    $indextemplate = file_get_contents("html/template.txt");
    
    $indextop = explode("<!--<memedata/>-->",$indextemplate)[0];
    $indexbottom = explode("<!--<memedata/>-->",$indextemplate)[1];

    $indexhtml = $indextop.$data.$indexbottom;
    $file = fopen($filename."/index.html","w");// create new file with this name
    fwrite($file,$indexhtml); //write data to file
    fclose($file);  //close file
    
?>