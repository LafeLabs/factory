<?php
//delete all files in memes directory
//DANGER!  SMASH! FIRE!!! BLODD!!!! EXPECT DESTRUCTIONS!

$files = scandir(getcwd()."/memes");
foreach(array_reverse($files) as $value){
    if($value != "." && $value != ".."){
        //delete file:
        unlink("memes/".$value);
    }
}
?>