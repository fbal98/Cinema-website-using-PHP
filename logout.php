<?php
require_once('db/database.php');
include('components/header.php');
include('functions/alert.php');

if(isset($_SESSION['loggedIn'])){
  showAlert('success', '<center><h1>You have been logged out, See you soon!</h1></center>');
  session_destroy();
  header('Refresh: 1; url=index.php');
}else{
  header('Location: index.php');
}
?>
