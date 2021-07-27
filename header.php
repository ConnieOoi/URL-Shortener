<?php
    include "config.php";
    
    $new_url = "";

    if(isset($_GET)){
        foreach($_GET as $key => $val){
            $u = mysqli_real_escape_string($conn, $key);
            //remove / from url
            $new_url = str_replace('/', '', $u); 
        }

        $sql = mysqli_query($conn, "SELECT original_url FROM url WHERE shorten_url = '{$new_url}'");

        if(mysqli_num_rows($sql) > 0){
            $count = mysqli_query($conn, "UPDATE url SET clicks = clicks + 1 WHERE shorten_url = '{$new_url}'");

            if($count){
                $original_url = mysqli_fetch_assoc($sql);
                header("Location:".$original_url['original_url']);
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
</head>