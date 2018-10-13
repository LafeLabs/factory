<?php
/* javascript this pairs with:



*/

    $filename = $_POST["filename"];//name of new directory

    $currentpath = getcwd();
    $imagefiles = scandir($currentpath."/pages/".$filename."/images");
    foreach($imagefiles as $value){
        if($value != "." && $value != ".."){
            //delete file:
            unlink($currentpath."/pages/".$filename."/images/".$value);
        }
    }

    unlink($currentpath."/pages/".$filename."/index.html");
    unlink($currentpath."/pages/".$filename."/json/memejson.txt");
    rmdir($currentpath."/pages/".$filename."/json");
    rmdir($currentpath."/pages/".$filename."/images");
    rmdir($currentpath."/pages/".$filename);
    
?>