<?php
if($_POST['ep_number']){
    $ep_number =$_POST['ep_number'];
    $folder_prefix =$_POST['folder_prefix'];
    $directory = $folder_prefix.$ep_number;
    $directory = str_replace(PHP_EOL, '', $directory);
                 $filecount = count(scandir($directory, SCANDIR_SORT_DESCENDING));
                 $images = preg_grep('~\.(jpeg|jpg|png|webp)$~', scandir($directory));
                 echo(json_encode($images));
}
?>