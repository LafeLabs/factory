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
    $filename = $_POST["filename"];//name of new directory

    $inputmemejson =json_decode($data);
    $baseimageurl = $inputmemejson->imgurl;  
    $fileextension = substr($baseimageurl,-4);
    mkdir($filename);
        mkdir($filename."/images");
        mkdir($filename."/json");
    copy($baseimageurl,$filename."/images/baseimage".$fileextension);
    
    $file = fopen($filename."/json/memejson.txt","w");// create new file with this name
    fwrite($file,$data); //write data to file
    fclose($file);  //close file

    $topimagesarray = $inputmemejson->topimages;
    $topimageindex = 0;
    foreach($topimagesarray as $value){
        $fileextension = substr($value->url,-4);
        copy($value->url,$filename."/images/topimage".$topimageindex.$fileextension);
        $topimageindex += 1;
    }
    //make index.html
    $indexhtml = "<!doctype html>\n<html>\n<head>\n";
    $indexhtml .= "<title>".$filename."</title>\n";
    $indexhtml .= "</head>\n<body>\n";
    $indexhtml .= "</body>\n</html>";
    $file = fopen($filename."/index.html","w");// create new file with this name
    fwrite($file,$indexhtml); //write data to file
    fclose($file);  //close file
    
?>