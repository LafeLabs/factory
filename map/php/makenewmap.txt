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
    $filename = "maps/".$_POST["filename"];//name of new directory

    mkdir($filename);
        mkdir($filename."/json");  
        
    $file = fopen($filename."/json/currentjson.txt","w");// create new file with this name
    fwrite($file,$data); //write data to file
    fclose($file);  //close file

    //make index.php
    $indextemplate = file_get_contents("php/template.txt");
    
    $file = fopen($filename."/index.php","w");// create new file with this name
    fwrite($file,$indextemplate); //write data to file
    fclose($file);  //close file
    
?>