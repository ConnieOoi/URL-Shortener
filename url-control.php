<?php

    include "config.php";
    //receive value from js ajax
    $originalURL = mysqli_real_escape_string($conn, $_POST['full-url']);

    if(!empty($originalURL) && filter_var($originalURL, FILTER_VALIDATE_URL)){
        //generating random 5 characters URL
        $ran_URL = substr(md5(microtime()), rand(0,26), 5);
        //checking generated URL already exist?
        $sql = mysqli_query($conn, "SELECT shorten_url FROM url WHERE shorten_url = '{$ran_URL}'");

        if(mysqli_num_rows($sql) > 0){
            echo "Something went wrong. Please regenerate URL again!";
        } else {
            $sql2 = mysqli_query($conn, "INSERT INTO url (shorten_url, original_url, clicks) VALUES ('{$ran_URL}', '{$originalURL}', '0')");
            
            if($sql2){
                //selecting recently inserted short link/url
                
                $sql3 = mysqli_query($conn, "SELECT shorten_url FROM url WHERE shorten_url = '{$ran_URL}'");
                if(mysqli_num_rows($sql3) > 0){
                    $shorten_url = mysqli_fetch_assoc($sql3);
                    echo $shorten_url['shorten_url'];
                }

            }

        }

    } else {

        echo "$originalURL - Please enter a valid URL";

    }

?>