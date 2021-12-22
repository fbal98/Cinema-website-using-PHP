<?php
require_once('db/database.php');
include('components/header.php');
include('functions/alert.php');// to use the alert function.

if(isset($_SESSION['loggedIn'])){
  header('Location: index.php');
  //header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <br><br><br><br><br>
    <div class="container-fluid">
      <center>
        <div class="d-block p-3 bg-info text-white" style="width:35%; font-size:35px; line-height:1; border-radius:20px 20px 0px 0px;">Log in</div>
      </center>
      <div class="container-fluid bg-light p-4 border border-light" style="width:35%">
          <?php
            //showAlert('danger', 'You have been signed in.');
            if(isset($_POST['submit'])){
              if($_POST['name'] == '' || $_POST['email'] == '' || $_POST['pwd'] == '' || $_POST['cpwd'] == ''){
                showAlert('danger', 'Fill all the fields');
              }elseif($_POST['pwd'] != $_POST['cpwd']){
                showAlert('danger', "The passwords don't match");
              }else{
                $query = 'SELECT * FROM users WHERE email=:email';
                $statement = $db->prepare($query);
                $statement->bindValue(':email', $_POST['email']);
                $statement->execute();
                $user = $statement->fetch();
                if(empty($user)){//to check if email already exists
                  $query = 'INSERT INTO users (name, email, password, age) VALUES(?, ?, ?, ?)';
                  $statement = $db->prepare($query);
                  $statement->execute([$_POST['name'], $_POST['email'], $_POST['pwd'], $_POST['age']]);
                  $users = $statement->fetchAll();
                  showAlert('success', 'signed up! <a href="login.php">login here</a>');
              }else{
                showAlert('warning', 'The email alrady exists <a href="login.php">login here</a>');
              }

              }
            }

          ?>
          <form class="m-auto" method="post">
              <div class="form-row">

                  <div class="form-group col-md-6">
                      <label>Name</label>
                      <input class="form-control" name="name" placeholder="Enter your name...">
                  </div>
                  <div class="form-group col-md-6">
                      <label>E-mail</label>
                      <input class="form-control" name="email" placeholder="Enter your email...">
                  </div>
              </div>
              <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="pwd" class="form-control">
              </div>
              <div class="form-group">
                  <label>confirm password</label>
                  <input type="password" name="cpwd" class="form-control">
              </div>
              <div class="form-group">
                  <label>Age</label>
                  <select class="form-control" name="age">
                      <option value="0-12">12 or less</option>
                      <option value="13-17">13 to 17</option>
                      <option value="18">18+</option>
                  </select>
              </div>
              <button name="submit" class="btn btn-info btn-lg btn-block">Log in</button>
          </form>
      </div>
    </div>
  </body>
</html>
