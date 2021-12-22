<?php
require_once('../db/database.php');
include('components/header.php');
include('../functions/alert.php');// to use the alert function.

//fetch movies
$query = 'SELECT * FROM movies';
$statement = $db->prepare($query);
$statement->execute();
$movies = $statement->fetchAll();


?>
    <br><br>
    <div class="container-fluid">
      <center>
        <div class="d-block p-3 bg-info text-white" style="width:50%; font-size:35px; line-height:1; border-radius:20px 20px 0px 0px;">Add a movie</div>
      </center>

      <div class="container-fluid bg-light p-4 border border-light" style="width:50%">
          <?php
          //handle submit
          if(isset($_POST['add'])){
            if($_POST['mname'] == '' || $_POST['mdesc'] == '' || $_POST['mage'] == '' || $_POST['mprice'] == ''){
              showAlert('danger', 'fill all the fields');
            }else{
              $query = 'INSERT INTO movies (name, description, ageRestriction, price) VALUES(?,?,?,?)';
              $statement = $db->prepare($query);
              $statement->execute([$_POST['mname'],$_POST['mdesc'],$_POST['mage'], $_POST['mprice']]);
              showAlert('success', 'Done');
              header('refresh:0.3');
            }
          }
          ?>
          <form class="m-auto" method="post">

              <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="mname" class="form-control">
              </div>
              <div class="form-group">
                  <label>Description</label>
                  <input type="text" name="mdesc" class="form-control">
              </div>
              <div class="form-group">
                  <label>Age Restriction</label>
                  <input type="text" name="mage" class="form-control">
              </div>
              <div class="form-group">
                  <label>Price</label>
                  <input type="number" name="mprice" class="form-control">
              </div>
              <button type="submit" name="add" class="btn btn-info btn-lg btn-block">Add</button>
          </form>
      </div>
    </div>

    <div class="container-fluid">
      <center>
        <div class="d-block p-3 bg-info text-white" style="width:50%; font-size:35px; line-height:0.7;">Edit movies</div>
      </center>

      <div class="container-fluid bg-light p-4 border border-light" style="width:50%">
        <?php
        //handle edit
        if(isset($_POST['edit'])){
          if (isset($_POST['delete'])) {
            $query = 'DELETE FROM movies WHERE movieID=?';
            $statement = $db->prepare($query);
            $statement->execute([$_POST['mid']]);
            showAlert('warning', 'Deleted');
            header('refresh:0.3');
          }else{
            if($_POST['mdesc'] == '' || $_POST['mage'] == '' || $_POST['mprice'] == ''){
              showAlert('danger', 'fill all the fields');
            }else{

              $query = 'UPDATE movies SET name=?, description=?, ageRestriction=?, price=? WHERE movieID=?';
              $statement = $db->prepare($query);
              $statement->execute([$_POST['mname'],$_POST['mdesc'],$_POST['mage'], $_POST['mprice'], $_POST['mid']]);
              showAlert('success', 'Done');
            }
          }

        }
        ?>
          <form class="m-auto" method="post">

            <select class="form-control" name="mid">
                <?php foreach ($movies as $m) {?>
                  <option value="<?=$m['movieID']?>"><?=$m['name'] . '| $'. $m['price']?></option>
                <?php } ?>

            </select>
            <input type="checkbox" id="delete" name="delete">
            <label for="delete"> Delete</label><br>
            <br>
            <div class="form-group">
                <label>Name</label>
                <input type="text" id='mname' name="mname" class="form-control">
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" id='mdesc' name="mdesc" class="form-control">
            </div>
            <div class="form-group">
                <label>Age Restriction</label>
                <input type="text" id='mage' name="mage" class="form-control">
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="number" id='mprice' name="mprice" class="form-control">
            </div>
              <button type="submit" name="edit" class="btn btn-info btn-lg btn-block">Update</button>
          </form>
      </div>
    </div>
<br><br><br>
<script>
  let deleteBtn = document.getElementById('delete');
  deleteBtn.addEventListener('change', ()=>{
    if (deleteBtn.checked) {
      document.getElementById('mname').disabled = true;
      document.getElementById('mdesc').disabled = true;
      document.getElementById('mage').disabled = true;
      document.getElementById('mprice').disabled = true;
    }else{
      document.getElementById('mname').disabled = false;
      document.getElementById('mdesc').disabled = false;
      document.getElementById('mage').disabled = false;
      document.getElementById('mprice').disabled = false;
    }
  })


</script>
