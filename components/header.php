<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Theater</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  </head>
  <body  style="background-color:#DBDBDB">
    <nav class="navbar navbar-expand-sm navbar-dark bg-info">
      <a class="navbar-brand" href="#">Theater</a>
      <div>
        <div class="navbar-nav">
          <a class="nav-link" href="./index.php">Home</span></a>
          <?php
          if(!isset($_SESSION['loggedIn'])){?>
          <a class="nav-link" href="./login.php">Login</a>
          <a class="nav-link" href="./signup.php">sign up</a>
        <?php }else{ ?>
          <a class="nav-link" href="./logout.php">Log Out</a>
        <?php } ?>
        <?php

        if(isset($_SESSION['loggedIn']) && $_SESSION['user']['isAdmin']){?>
        <a class="nav-link" href="control_panel/cp.php">control panel</a>
      <?php } ?>
        </div>
      </div>
    </nav>
  </body>
</html>
