<?php

//server connetion
$conn = new mysqli('localhost','root','','crud-v');

//get all fetch data
$data = json_decode(file_get_contents('php://input') );

//get action
$action = 'read';
if(isset($_GET['action']) ){
    $action = $_GET['action'];
}

/**
 * get all user data
 */

if($action == 'read'){
    $data = $conn -> query("SELECT * FROM crud ORDER by id DESC");

    $all_users = [];
    while( $user = $data -> fetch_assoc() ){
        array_push($all_users, $user);
    }
   echo json_encode($all_users);



 }


/**
 * creta new user action
 */

if($action == 'create'){
    
    //get val

    // $name  = $data -> name;
    // $email  = $data -> email;
    // $cell  = $data -> cell;

    $file_name = $_FILES['photo']['name'];
    $file_tmp_name = $_FILES['photo']['tmp_name'];

    //photo upload 
    move_uploaded_file( $file_tmp_name, '../photos/users/' . $file_name);

    //get valus
    $name = $_POST['name'];
    $email = $_POST['email'];
    $cell = $_POST['cell'];
    //send data
    $conn -> query("INSERT INTO crud ( name, email, cell, photo) VALUES ('$name','$email','$cell', '$file_name') ");
    
    
    
    }
/**
 * delete user action
 */

if($action == 'delete'){
    //get delete id
    $id = $_GET['id'];

    //delete user data query
    $conn -> query("DELETE FROM crud WHERE id='$id'");

}
/**
 * single view data action
 */

if($action == 'single'){

    //get user id
   $id = $_GET['id'];

   //show single user data query
   $data = $conn -> query("SELECT * FROM crud WHERE id='$id'");

   $single_user_data = $data -> fetch_assoc();

   echo json_encode($single_user_data);



}
/**
 * search data action
 */

if($action == 'search'){

    //get user id
   $search = $_GET['s'];

   //show single user data query
   $data = $conn -> query("SELECT * FROM crud WHERE name LIKE'%$search%'");

  
$search_result = [];

   while($result = $data -> fetch_assoc() ){
    array_push($search_result, $result);
   }

   echo json_encode($search_result);


}



















