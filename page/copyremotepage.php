<?php

$filename = "pages/".$_POST["filename"];//name of new directory
$url = $_POST["url"];//url of source page
$url = rstrip($url,"index.html");
$memejson = json_decode($url."json/memejson.txt");

mkdir($filename);
    mkdir($filename."/images");
    mkdir($filename."/json");  

$sourcefile = $memejson->imgurl;

$dotbits = explode(".",$sourcefile);
$extension = $dotbits[count($dotbits) - 1];
$outfile =  "baseimage.".$extension;

copy($sourcefile,$outfile);

$topimagesarray = $memejson->topimages;
$topimageindex = 0;
foreach($topimagesarray as $value){
    $patharray = explode("/",$value->url);
    $extension = substr($value,-4);
    copy($value->url,$filename."/images/topimage".$topimageindex.$extension);
    $topimageindex += 1;
}   
    

?>