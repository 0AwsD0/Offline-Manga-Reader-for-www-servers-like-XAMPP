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
                for($i = 0; $i < $filecount-4; $i++){
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

    </div>
    <a href="#holder"><div id="return_to_top">Return to top</div></a>
    <a href="#holder"><div id="next_ep" onclick="">NEXT EP</div></a>
</body>

    <script>
            function img_number(ep_number){
                xmlhttp = new XMLHttpRequest();
                xmlhttp.open("POST", "images.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("ep_number=" + ep_number);
                //setTimeout(() => { console.log(xmlhttp.response);}, 500);
                setTimeout(() => { 
                        
                            file_list = xmlhttp.response
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

                                img.setAttribute('src', 'Episode '+ep_number+"/"+file_array[i]);
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
