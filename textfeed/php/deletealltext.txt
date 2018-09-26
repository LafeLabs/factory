<?php
//delete all files in html directory
//DANGER!  SMASH! FIRE!!! BLODD!!!! EXPECT DESTRUCTIONS!

$files = scandir(getcwd()."/html");
foreach(array_reverse($files) as $value){
    if($value != "." && $value != ".."){
        //delete file:
        unlink("html/".$value);
    }
}
?>