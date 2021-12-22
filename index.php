<?php
require_once('db/database.php');
include('components/header.php');
include('functions/alert.php');// to use the alert function.

//get movies
$query = 'SELECT * FROM movies';
$statement = $db->prepare($query);
$statement->execute();
$movies = $statement->fetchAll();


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
        <div class="d-block p-3 bg-info text-white" style="width:70%; font-size:35px; line-height:1; border-radius:20px 20px 0px 0px;">Book A Movie</div>
      </center>

      <div class="container-fluid bg-light p-4 border border-light" style="width:70%">
        <?php
          if(count($movies) < 1 ){
            showAlert('info', 'Sorry there no listed movies right now');
            exit();
          }
          if(isset($_POST['submit'])){
            if($_POST['peopleCount'] == 0){
              showAlert('danger', 'Please choose the numbert of people attending');
            }elseif(!isset($_SESSION['loggedIn'])){
              showAlert('info', 'Please login <a href="login.php">here</a> first');
            }else{
              $query = 'INSERT INTO bookings (userID, movieID , peopleNum) VALUES(?, ?, ?)';
              $statement = $db->prepare($query);
              $statement->execute([$_SESSION['user']['userID'],$_POST['movieID'], $_POST['peopleCount']]);
              showAlert('success', 'Your movie has been booked');
              header('Refresh:0.5; url=booking.php?movieID='. $_POST['movieID'] . '&ppl=' . $_POST['peopleCount']);
            }
          }
        ?>
          <form class="m-auto" method="post">
            <div class="form-group">
                <label>Movie Title: </label>
                <select class="form-control" name="movieID">
                    <?php foreach ($movies as $m) {?>
                      <option value="<?=$m['movieID']?>"><?=$m['name'] . '| $'. $m['price']?></option>
                    <?php } ?>
                </select>
            </div>
              <div class="form-group">
                  <label>count of people?</label>
                  <input type="number" name="peopleCount" class="form-control">
              </div>

              <button type="submit" name="submit" class="btn btn-info btn-lg btn-block">Book Now</button>
          </form>
      </div>
    </div>
  </body>
</html>
