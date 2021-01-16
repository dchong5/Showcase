
<?php
	session_start();
  //Insert
  if (isset($_POST['insert']) && !isset($_POST['logout'])) {
    if (isset($_SESSION['qwerty'])){
      header("Location: admin/insert.php");
  }
  else{
    header("Location: admin/login.php");
  }
  }

  //Edit
  else if (isset($_POST['edit']) && !isset($_POST['logout'])) {
    if (isset($_SESSION['qwerty'])){
      header("Location: admin/edit.php");
  }
  else{
    header("Location: admin/login.php");
  }
  }

  //search
  else if (isset($_POST['search'])){
    header("Location: search.php");
  }

  //list
  else if (isset($_POST['list'])){
    header("Location: list.php");
  }

  else if (isset($_POST['logout'])){
    session_unset();
    header("Location: admin/logout.php");
  }
?>

<style>
td, .youtube, .rating{
  text-align: center;
}

.rating{
  margin-left: 30%;
}
</style>

<?php 	

	include("includes/header.php");
  include("includes/_functions.php");

?>
  
<div class="alert alert-info">

  <div class="displayRating">
<?php

    //get IP Address
    $ip = getenv('HTTP_CLIENT_IP')?:
           getenv('HTTP_X_FORWARDED_FOR')?:
           getenv('HTTP_X_FORWARDED')?:
           getenv('HTTP_FORWARDED_FOR')?:
           getenv('HTTP_FORWARDED')?:
           getenv('REMOTE_ADDR');

    $strIP = strval($ip);

    $msgPreError = "\n<div class = \"alert alert-danger\" role = \"alert \">";
    $msgPreSuccess = "\n<div class = \"alert alert-primary\" role = \"alert \">";
    $msgPost = "\n</div>";

    $pageID = $_GET['id'];

    if (isset($_POST['mysubmit'])) {
      //$car = $pageID;
      $rate = $_POST['rating'];
      $car = $_POST['model'];

      if ($rate > 0) {

        $checkip = mysqli_query($con, "SELECT * FROM cars_rating WHERE ip='$strIP' AND car='$car'");
        while($row = mysqli_fetch_array($checkip)){
          $checkedip = $row['ip'];
        }
        if($checkedip == null){
          mysqli_query($con, "INSERT INTO cars_rating(car, rating, ip) VALUES('$car', '$rate', '$strIP')")or die(mysqli_error($con));
        } 
        else{
          mysqli_query($con, "UPDATE cars_rating SET rating='$rate' WHERE ip='$strIP' AND car='$car'")or die(mysqli_error($con));
        }
      }
      else{
        $valRateMsg = "Please select a value if you wish to submit a rating";
      }

    }

    $pageID = $_GET['id'];

    $result = mysqli_query($con, "SELECT * FROM cars WHERE id = '$pageID'");
    while($row = mysqli_fetch_array($result)){
      $car = $row['model'];
    }

      $rating = mysqli_query($con, "SELECT AVG(rating) AS rated FROM cars_rating WHERE car = '$car'");
      while($row = mysqli_fetch_array($rating)){
        $avgRating = $row['rated'];
      }
      //$entires = mysqli_query($con, "SELECT COUNT(rating) FROM cars_rating WHERE car = '$pageID'");

      if ($avgRating == null)
      {
        echo "<div class=\"display alert alert-info\">";
        echo "\n<h2>There are currently no ratings for this vehicle. Be the first to rate!</h2>";
        echo "</div>";
      }

      else{
        echo "<div class=\"display alert alert-info\">";
        echo "\n<h2>Catalog's User Rating: $avgRating/5</h2>";
        echo "</div>";
      }
?>
  </div>

<div class="carInfo">
<?php 

  $pageID = $_GET['id'];

  $result = mysqli_query($con, "SELECT * FROM cars WHERE id = '$pageID'");

  while($row = mysqli_fetch_array($result)){
    $id = $row['id'];
    $make = $row['make'];
    $model = $row['model'];
    $type = $row['type'];
    $horsepower = $row['horsepower'];
    $fuel_type = $row['fuel_type'];
    $city_econ = $row['city_econ'];
    $highway_econ = $row['highway_econ'];
    $seating = $row['seating'];
    $price = $row['price'];
    $pic = $row['pic'];
    $vid = $row['vid'];
    $imglocation = "admin/display/" . $pic;
  }

  $text = preg_replace("#.*youtube\.com/watch\?v=#", "", $vid);
  $text = '<iframe width="640" height="360" src="https://www.youtube.com/embed/'.$text.'"frameborder="0" allowfullscreen></iframe>';

  echo "<div class=\"display alert alert-info\">";
  echo "\n<h2>$make $model</h2>";

  echo "\n
  
  <table class=\"table table-striped\">\n
  <thead>\n
    <tr>\n
      <th scope=\"col\">Type</th>\n
      <th scope=\"col\">Horsepower</th>\n
      <th scope=\"col\">Fuel Type</th>\n
      <th scope=\"col\">City Economy</th>\n
      <th scope=\"col\">Highway Economy</th>\n
      <th scope=\"col\">Seats</th>\n
      <th scope=\"col\">Starting Price</th>\n
    </tr>\n
  </thead>\n
  <tbody>\n
    <tr>\n
      <td>$type</td>\n
      <td>$horsepower</td>\n
      <td>$fuel_type</td>\n
      <td>$city_econ</td>\n
      <td>$highway_econ</td>\n
      <td>$seating</td>\n
      <td>$$price</td>\n
    </tr>\n
  </tbody>\n
</table>\n

  ";

  echo "\n<div><img src=\"$imglocation\"></div>";
  echo "\n<br>";
  echo "<div class\"youtube\">$text</div>";

  echo "</div>";

?>
</div>


  <div class="rating">
    <form id="myform" name="myform" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
      <div class="form-group">
        <label for="rating">Rate This Car:</label>
        <select name="rating" class="form-control">
          <option value="0">--Select A Rating For This Vehicle--</option>
        <option value="1">Poor(1)</option>
        <option value="2">Fair(2)</option>
        <option value="3">Neutral(3)</option>
        <option value="4">Good(4)</option>
        <option value="5">Excellent(5)</option>
      </select>
      <?php if(isset($valRateMsg)){ echo $msgPreError . $valRateMsg . $msgPost;} ?>
    </div>

      <input type="hidden" name="model" class="form-control" value="<?php echo $model; ?>">

    <div class="form-group">
      <label for="submit">&nbsp;</label>
      <input type="submit" name="mysubmit" class="btn btn-info" value="Submit">
    </div>
    </form>    
  </div>


</div>

<?php include ("includes/footer.php") ?>