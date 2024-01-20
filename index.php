<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div id="list">
<?php

             $directory = "";
             $file = glob("" . "*");
             natsort($file);
             $filecount =  count(glob("" . "*"));

             $i = 0;

             try{
                foreach($file as $folder){
                    $i++;
                    if($i <= ($filecount-3)){
                        ?>
                            <button class="episode_button" id="<?php echo($i); ?>" onclick="load_images('<?php echo($folder); ?>');episode_id(<?php echo($i); ?>);"> <?php echo($folder); ?> </button>
                        <?php
                    }
                }
             }
             catch(Exception $e){
                echo("END ".$e);
             }

?>
</div>
    <div id="holder">
        <div id="init_settings">
            <h1>This text will vanish after properly loading the images.</h1>
            <h1>Use 'Ctrl'+'mouse wheel' to make images (website) bigger or smaller.</h1>
            <h1>If you encounter any problems visit https://github.com/0AwsD0/Offline-Manga-Reader-for-www-servers-like-XAMPP </h1>
            <h1>...or try files from 'OLD VERSION' directory - remember to read its readme.md! </h1>
        </div>
    </div>
    </div>
    <a href="#holder"><div id="return_to_top">Return to top</div></a>
    <a href="#holder"><div id="next_ep" onclick="">NEXT EP</div></a>
</body>

    <script>

            let ep_id = 0;

            function episode_id(id){
                ep_id = id;
            }

            function img_number(directory){
                xmlhttp = new XMLHttpRequest();
                xmlhttp.open("POST", "images.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("directory="+directory);
                //setTimeout(() => { console.log(xmlhttp.response);}, 500);
                setTimeout(() => {

                            file_list = xmlhttp.response;
                            console.log(file_list);

                            let jsonData = JSON.parse(file_list);

                            console.log("Json data object below: ");
                            console.log(jsonData);
                            console.log("Possibly array below: ");
                            let file_array = Object.values(jsonData);
                            console.log(file_array);
                            console.log(file_array.length);

                            const containing = document.querySelector("#holder");
                                while (containing.hasChildNodes()) {
                                    containing.removeChild(containing.firstChild);
                                }

                            for(let i = 0; i < file_array.length; i++)
                            {
                                //console.log("Iteration: "+i);
                                const div = document.createElement("div");
                                const img = document.createElement("img");

                                img.setAttribute('src', directory+"/"+file_array[i]);
                                img.setAttribute('class', 'diaplay');

                                div.setAttribute('class', 'imgholder');

                                div.appendChild(img);
                                containing.appendChild(div);
                            }
                    ;}, 500);

            }

    function load_images(ep_number){

            //setTimeout(()=>{let images_inside = img_number(ep_number);} , 500)
            let images_inside = img_number(ep_number);

            const rtn = document.querySelector("#return_to_top");
            rtn.innerHTML="";
            rtn.innerHTML="Return to top. Curently EP: "+ep_number;

            const nxt = document.querySelector("#next_ep");
            nxt.onclick = function(){
                                        document.getElementById(ep_id+1).click();
                                        //THE FLOW OF ABOVE CODE = every episode button have its ID from PHP loop ($i). When clicking the episode the function changes variable "ep_id" to corresponding div id (episode_id).
                                        //That allows the code above to work, but why I need it? - natural sorted array made by php function on the begging do not reassign keys in order (you can see this by inserting 'print_r($file);' on line 17),
                                        //so I had to do this work around by numbering BY ID the divs handling episodes so I can reliably determine next chapter to load.
                                    };
        }
    </script>
</html>
