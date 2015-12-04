# mbinfo-video WordPress plugin

Insert MBInfo video.

## Using 

YouTube video are inserted into the new web site by using `video-box` or `youtube` shortcode, as follow:

    [video-box id="7RrrIBHAbXE"]

Or 

    [youtube id="7RrrIBHAbXE"]
   

Where id is YouTube id, which is the last part of youtube url. Generally that is all. It will pull out YouTube video title and description and format accordingly. To change title and description, please update in YouTube.

However, if you really need to change title and description, here is

    [video-box id="7RrrIBHAbXE" title="New Title"]Description override[/video-box]

## Requirement

PHP curl function is required. To install in Debian distro:

    sudo apt-get install php5-curl
    sudo service apache2 restart    


    

    
