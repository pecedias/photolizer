<?php
$config = array("base_url" => "https://ads.deskbr.com/login/", 
        "providers" => array ( 
            "Google" => array ( 
                "enabled" => true,
                "keys"    => array ( "id" => "965193543260-uub9npqecu3mk5p9epa0sheg1obkvbeg.apps.googleusercontent.com", "secret" => "F1fO7ErI5hRo_3jt7NNuyuqk" ), 
 
            ),
 
            "Facebook" => array ( 
                "enabled" => true,
                "keys"    => array ( "id" => "1634965423265207", "secret" => "7746728c3784ddba0e74ee20ea21d0a0" ),
                "scope" => "email, user_about_me, user_birthday, user_hometown"  //optional.              
            ),
 
            "Twitter" => array ( 
                "enabled" => true,
                "keys"    => array ( "key" => "TWITTER_DEVELOPER_KEY", "secret" => "TWITTER_SECRET" ) 
            ),
        ),
        // if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
        "debug_mode" => false,
        "debug_file" => "debug.log",
    );