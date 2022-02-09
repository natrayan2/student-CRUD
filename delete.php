<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT']."/default/conn.php");

$did=$_REQUEST['id'];

$query = "DELETE FROM register WHERE id=$did"; 
$result = mysqli_query($conn,$query) or die ( mysqli_error());
header("Location: view.php"); 
?>
