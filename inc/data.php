<?php

    $conn = new mysqli('localhost','root','','crud-v');
    $data = $conn -> query("SELECT * FROM crud ORDER by id DESC");

    $all_users = [];

    while( $user = $data -> fetch_assoc() ){
        array_push($all_users, $user);
    }


   echo json_encode($all_users);


















