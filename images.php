<?php
if($_POST['directory']){
    $directory =$_POST['directory'];
    $directory = str_replace(PHP_EOL, '', $directory);
                 $filecount = count(scandir($directory, SCANDIR_SORT_DESCENDING));
                 $images = preg_grep('~\.(jpeg|jpg|png|webp)$~i', scandir($directory));
                 echo(json_encode($images));
}
?>