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
    $filename = "pages/".$_POST["filename"];//name of new directory

    $inputmemejson =json_decode($data);
    $baseimageurl = $inputmemejson->imgurl; 
    $patharray = explode("/",$baseimageurl);
    
    $fullfilename = "../".$patharray[count($patharray) - 3]."/".$patharray[count($patharray) - 2]."/".$patharray[count($patharray) - 1];
    $fileextension = substr($fullfilename,-4);

    mkdir($filename);
        mkdir($filename."/images");
        mkdir($filename."/json");  
        
    $deletedfiles = scandir(getcwd()."/".$filename."/images");
    foreach($deletedfiles as $value){
        if($value != "." && $value != ".."){
            //delete file:
            unlink($filename."/images/".$value);
        }
    }

        
    copy($fullfilename,$filename."/images/baseimage".$fileextension);
    
    $file = fopen($filename."/json/memejson.txt","w");// create new file with this name
    fwrite($file,$data); //write data to file
    fclose($file);  //close file

    $topimagesarray = $inputmemejson->topimages;
    $topimageindex = 0;
    foreach($topimagesarray as $value){
        $patharray = explode("/",$value->url);
        $fullfilename = "../".$patharray[count($patharray) - 3]."/".$patharray[count($patharray) - 2]."/".$patharray[count($patharray) - 1];   
        $fileextension = substr($fullfilename,-4);
        copy($fullfilename,$filename."/images/topimage".$topimageindex.$fileextension);
        $topimageindex += 1;
    }   
    
    //make index.html
    $indextemplate = file_get_contents("html/template.txt");
    
    $indextop = explode("<!--<memedata/>-->",$indextemplate)[0];
    $indexbottom = explode("<!--<memedata/>-->",$indextemplate)[1];

    $indexhtml = $indextop.$data.$indexbottom;
    $file = fopen($filename."/index.html","w");// create new file with this name
    fwrite($file,$indexhtml); //write data to file
    fclose($file);  //close file
    
?>