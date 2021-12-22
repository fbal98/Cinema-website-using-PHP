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
              if($_POST['email'] == '' || $_POST['pwd'] == ''){
                showAlert('danger', 'Fill all the fields');
              }else{
                $query = 'SELECT * FROM users WHERE email=:email AND password=:pwd';
                $statement = $db->prepare($query);
                $statement->bindValue(':email', $_POST['email']);
                $statement->bindValue(':pwd', $_POST['pwd']);
                $statement->execute();
                $user = $statement->fetch();
                if(!empty($user)){
                  $_SESSION['loggedIn'] = true;
                  $_SESSION['user'] = $user;
                  Header('Refresh:0.6; url=index.php');
                  showAlert('success', 'Logged In');
                }else{
                  $msg = 'Something went wrong with the info you entered | <a href="signup.php">signup</a>';
                  showAlert('danger', $msg);
                }
              }
            }
          ?>
          <form class="m-auto" method="post">
            <div class="form-group">
                <label>E-mail</label>
                <input type="email" name="email" class="form-control">
            </div>
              <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="pwd" class="form-control">
              </div>

              <button type="submit" name="submit" class="btn btn-info btn-lg btn-block">Log in</button>
          </form>
      </div>
    </div>
  </body>
</html>
