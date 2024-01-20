
# Offline Manga reader - for www servers like XAMMP
## Because I have a strange habit of saving everything I like offline...
I made it for myself since I just wanted to read certain manga even if my internet is gone, or manga is deleted from internet for strange reason. 
There are probably some other solutions out there, but I wanted something tailored for myself, and here we are.
Since the images are strangely cut, I couldn't simply use the default image app on Windows or any other I had on my PC.
If you like to use it offline on your PC go on and download it.
It's simple, easy and MADE FOR LOCAL USE.
You can use it and modify it for your private needs.
If you make changes to the code and you want to share it, make a fork of this project.
You have to include link to original repository on the top as shown here: 
Original repository: [link]
### Remember if you like something and it's online resource, save it! 

## How to use
Put php files and css file excluding 'readme.md' and '.gitattributes' together or combine them into one file and drop them into directory with episodes. !!READ 'Possible problems.' BELOW!!
(you can put .php file as function instead of calling it I just made it to prevent page reload)
Just put the files inside 'manga name here' folder containing Episodes.
Of course the folder should be placed into htdocs - for example: 'xampp\htdocs\your manga here' or other folder designed for http server.
And http server should be online.
Open browser type 'http://localhost/' or just 'localhost' into your search bar and navigate into your manga folder or enter it manually.
For example, 'localhost/MANGA/Manga name here/'.
If you set up custom port you need to include it. For example: 'localhost:88'.
Folders containing manga must end with INTEGER type number. The folders like 'Chapter 21.1' will create some problems: read 'Possible problems.' below. 

REMEMBER NOT TO PUT: '.gitattributes' AND 'README.md' INTO YOUR MANGA FOLDER!

Proper 'tree' example (where to put the files):
```sh
│   images.php
│   index.php
│   style.css
│
├───Chapter 1
│       01.jpg
│       02.jpg
│       03.jpg
│
├───Chapter 2
│       01.jpg
│       02.jpg
│       03.jpg
│
├───Chapter X
│       01.jpg
│       02.jpg
│       03.jpg
```
## Possible problems.
I wrote it for PC use, so it's not optimized towards mobile devices. (style.css)

If you combine those 3 files (images.php | index.php | style.css) into one file remove -3 from below code and type -1 instead. 
```sh
for($i = 0; $i < $filecount-3; $i++)
```

Your folders must end with INTEGER type number. The folders like 'Chapter 21.1' will be counted, but will not be displayed correctly due to inner workings of the script. The folders will be just skipped, but willcreate additional 'dead' episode buttons on the top of the website. Use program, like 'Advanced Renamer' to rename all folders accordingly.
```sh
https://www.advancedrenamer.com/ | Free tool to rename your folders. 
1. Drag and drop all folders containing images into programm window.
2. Select proper option to only import dragged folders, excluding files and directories inside them.
3. Into 'New Name' enter 'Episode <Inc Nr:1:1>'. 
4. Click 'START' and you are ready to go!

```

If the file format for your 'images' is not supported ~ like '.gif', you can just simply add it in here:
- images.php
```sh
$images = preg_grep('~\.(jpeg|jpg|png|webp)$~', scandir($directory));
```

Have fun reading your manga offline!
///And yes I know running http server just to do so is overkill but I wanted to have it my way + for me it was the fastest way to get what I want.
