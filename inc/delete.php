<?php


$id = $_GET['id'];

$conn = new mysqli('localhost','root','','crud-v');
$data = $conn -> query("DELETE FROM crud WHERE id='$id'");