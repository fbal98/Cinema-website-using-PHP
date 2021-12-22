<?php
require_once('db/database.php');
include('components/header.php');
include('functions/alert.php');// to use the alert function.

if(!isset($_SESSION['loggedIn'])){
  header('Location: index.php');
}
?>
<?php if(isset($_GET['movieID']) && isset($_GET['ppl'])) {
  //get movie data
  $query = 'SELECT * FROM movies WHERE movieID=:id';
  $statement = $db->prepare($query);
  $statement->bindValue(':id', $_GET['movieID']);
  $statement->execute();
  $movie = $statement->fetch();

?>
  <br><br><br><br><br>
  <div class="container-fluid">
    <center>
      <div class="d-block p-3 bg-info text-white" style="width:50%; font-size:35px; line-height:1; border-radius:20px 20px 0px 0px;">You booked a movie!</div>
    </center>

    <div class="container-fluid bg-light p-4 border border-light" style="width:50%">
      <h4>You booked: <?=$movie['name']?></h4>
      <h4>For <?=$_GET['ppl']?> persons</h4>
      <h4>The price will be $<?=$movie['price'] * $_GET['ppl']?></h4>
      <br>
      <a href="booking.php">See All Bookings</a>
    </div>
  </div>
<?php }else{ ?>
  <br><br><br><br><br>
  <div class="container-fluid" style="padding:0;">
    <center>
      <div class="d-block p-3 bg-info text-white" style="width:50%; font-size:35px; line-height:1; border-radius:20px 20px 0px 0px;">You booked a movie!</div>
    </center>

    <div class="container-fluid bg-light p-4 border border-light" style="width:50%; padding:0;">
      <table class="table table-info table-hover w-100" style="width:100%; margin:0; padding:0;">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Movie Name</th>
            <th scope="col">Price</th>
            <th scope="col">Booking Time</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = 'SELECT movies.name, movies.price, movies.ageRestriction, bookings.peopleNum, bookings.bookingTime
                    From movies INNER JOIN bookings ON movies.movieID=bookings.movieID';
          $statement = $db->prepare($query);
          $statement->execute();
          $bookings = $statement->fetchAll();
          if(count($bookings) <= 0){
            showAlert('warning', 'you have no bookings yet');
          }else{
            foreach ($bookings as $key => $b) {
              echo '
              <tr>
                <th scope="row">'.($key+1).'</th>
                <td>'.($b['name']).'</td>
                <td>$'.($b['price']*$b['peopleNum']).' (for'.$b['peopleNum'].') '.'</td>
                <td>'.($b['bookingTime']).'</td>
              </tr>
              ';
            }
          }
          ?>

        </tbody>
      </table>

    </div>

  </div>
<?php } ?>
