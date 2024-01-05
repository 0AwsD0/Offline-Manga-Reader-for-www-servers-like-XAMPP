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
Put those files together or combine them into one file and drop them into directory with episodes. !!READ 'Possible problems.' BELOW!!
(you can put .php file as function instead of calling it I just made it outside for fun)
Just put the files inside 'manga name here' folder containing Episodes.
Of course the folder should be placed into htdocs - for example: 'xampp\htdocs\your manga here' or other folder designed for http server.
And http server should be online.
Open browser type 'http://localhost/' or just 'localhost' into your search bar and navigate into your manga folder or enter it manually.
For example, 'localhost/MANGA/Manga name here/'.
If you set up custom port you need to include it. For example: 'localhost:88'.

## Possible problems.
I wrote it on Windows for windows, I didn't test it on Linux. It should be fine.

If you combine those 3 files into one file remove -3 from below code and type -1 instead. 
```sh
for($i = 0; $i < $filecount-3; $i++)
```

As shown below the hard-coded name for folders containing image files for manga is constructed like this: 'Episode X'
That requires you to have folders named properly: 'Episode 1' 'Episode 2' ... 'Episode 171' ...
I made it that way because downloader that I use - HakuNeko Desktop - is making folders like that while downloading manga. //not always - sometimes it goes 'Chapter X' etc. - replace 'Episode ' witch 'Chapter ' in code below:
- images.php
```sh
$directory = "Episode ".$ep_number;
                 $filecount = count(scandir($directory, SCANDIR_SORT_DESCENDING));
                 $images = preg_grep('~\.(jpeg|jpg|png)$~', scandir($directory));
                 echo(json_encode($images));
```
- index.php
```sh
img.setAttribute('src', 'Episode '+ep_number+"/"+file_array[i]);
```

Have fun reading your manga offline!
///And yes I know running http server just to do so is overkill but I wanted to have it my way + for me it was the fastest way to get what I want.
