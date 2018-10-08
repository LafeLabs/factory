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
        mkdir($filename."/html");

    //make index.html
    $indextemplate = file_get_contents("php/template.txt");
    
    $indextop = explode("<!--<memedata/>-->",$indextemplate)[0];
    $indexbottom = explode("<!--<memedata/>-->",$indextemplate)[1];

    $indexhtml = $indextop.$data.$indexbottom;
    
    $file = fopen($filename."/index.php","w");// create new file with this name
    fwrite($file,$indexhtml); //write data to file
    fclose($file);  //close file
    
    $filesaver = file_get_contents("php/filesaver.txt");
    $fileloader = file_get_contents("php/fileloader.txt");
    file_put_contents($filename."/filesaver.php",$filesaver);
    file_put_contents($filename."/fileloader.php",$fileloader);
    
    //delete any exisitng caption files
    $deletedfiles = scandir(getcwd()."/".$filename."/html");
    foreach($deletedfiles as $value){
        if($value != "." && $value != ".."){
            //delete file:
            unlink($filename."/html/".$value);
        }
    }
    
    for ($index = 0; $index < count(json_decode($data)); $index++) {
        file_put_contents($filename."/html/caption".$index.".txt","");
    } 


?>