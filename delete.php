<?php

    include "config.php";

    if(isset($_GET['id'])){

        $delete_id = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = mysqli_query($conn, "DELETE FROM url WHERE shorten_url = '{$delete_id}'");

        if($sql){
            header("Location: index.php");
        } else {
            header("Location: index.php?error");
        }

    } elseif(isset($_GET['delete'])){

        $sql2 = mysqli_query($conn, "DELETE FROM url");

        if($sql2){
            header("Location: index.php");
        } else {
            header("Location: index.php?error");
        }

    } else {

        header("Location: index.php?error");

    }

?>