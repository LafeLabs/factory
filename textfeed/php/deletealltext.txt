<?php
//delete all files in html directory
//DANGER!  SMASH! FIRE!!! BLODD!!!! EXPECT DESTRUCTIONS!

$files = scandir(getcwd()."/text");
foreach(array_reverse($files) as $value){
    if($value != "." && $value != ".."){
        //delete file:
        unlink("text/".$value);
    }
}
?>