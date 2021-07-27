<?php

    include "config.php";
    //get these values which are sent from ajax to php
    $original_URL = mysqli_real_escape_string($conn, $_POST['shorten_url']);
    //removing space from url if user entered
    $full_url = str_replace(' ', '', $original_URL);
    $hidden_url = mysqli_real_escape_string($conn, $_POST['hidden_url']);

    if(!empty($full_url)){

        $domain = "localhost";

        //check is the domain still there
        if(preg_match("/{$domain}/i", $full_url) && preg_match("/\//i", $full_url)){
            $explodeURL = explode('/', $full_url);
            //getting last value of full URL
            $shortURL = end($explodeURL);

            if($shortURL != ""){
                //select randomly created URL to update with user entered new value;
                $sql = mysqli_query($conn, "SELECT shorten_url FROM url WHERE shorten_url = '{$shortURL}' && shorten_url != '{$hidden_url}'");

                if(mysqli_num_rows($sql) == 0){ //if user entered url not exist in db

                    $sql2 = mysqli_query($conn, "UPDATE url SET shorten_url = '{$shortURL}' WHERE shorten_url = '{$hidden_url}'");

                    if($sql2){

                        echo "success";

                    } else {

                        echo "Error - Something went wrong!";

                    }

                } else {

                    echo "Error - URL already existed!";

                }

            }

        } else {
            echo "Invalid URL - You can't edit domain name!";
        }

    } else {
        
        echo "Invalid URL!";

    }

?>