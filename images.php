<?php
if($_POST['ep_number']){
    $ep_number =$_POST['ep_number'];
    $directory = "Episode ".$ep_number;
                 $filecount = count(scandir($directory, SCANDIR_SORT_DESCENDING));
                 $images = preg_grep('~\.(jpeg|jpg|png|webp)$~', scandir($directory));
                 echo(json_encode($images));
}
?>