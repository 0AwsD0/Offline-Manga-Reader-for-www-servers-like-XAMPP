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
             $filecount = count(glob("" . "*"));

             try{
                for($i = 0; $i < $filecount-3; $i++){
                    ?>
                        <button class="episode_button" onclick="load_images(<?php echo($i+1); ?>);"> <?php echo($i+1); ?> </button>
                    <?php
                }
             }
             catch(Exception $e){
                echo("END ".$e);
             }

        ?>
</div>
    <div id="holder">
        <div id="init_settings">
            <h1>Settings below (and this text) will vanish after properly loading the images. If folders containing your manga are starting with 'Chapter', click the 'Change folders prefix to 'Chapter'' button. For anything else: enter value into text field below and click 'Change prefix to value below'. Default value is 'Episode'. The space is added by the script! Do not add space to the field below.</h1>
            <h1>Remember to name folders correctly! The folders containing '.' ~like '21.1' will not work. The folders have to end with INTIGER type number to properly work here. You can rename them by programs like 'Advance Renamer'. There is a chance I will add support for this and other cases in the future. </h1>
            <h1>Use 'Ctrl'+'mouse wheel' to make images (website) bigger or smaller.</h1>
            <div class="chapter_button" onclick="set_folder_prefix('Chapter ');">Change folders prefix to 'Chapter'</div>
            <div class="chapter_button" onclick="set_folder_prefix('Episode ');">Change folders prefix to 'Episode' (Default)</div>
            <div class="chapter_button" onclick="set_folder_prefix(document.getElementById('prefix').value+' ');">Change folders prefix to value below</div>
                <input type="text" name="prefix" id="prefix">
        </div>
    </div>
    </div>
    <a href="#holder"><div id="return_to_top">Return to top</div></a>
    <a href="#holder"><div id="next_ep" onclick="">NEXT EP</div></a>
</body>

    <script>

            folder_prefix = "Episode ";
            function set_folder_prefix(prefix){
                folder_prefix = prefix;
            }

            function img_number(ep_number){
                xmlhttp = new XMLHttpRequest();
                xmlhttp.open("POST", "images.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("ep_number="+ep_number+"&"+"folder_prefix="+folder_prefix);
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

                                img.setAttribute('src', 'Chapter '+ep_number+"/"+file_array[i]);
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
            nxt.onclick = function(){load_images(ep_number+1);};
        }
    </script>
</html>
