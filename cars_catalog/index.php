<?php

  session_start();

?>

<?php 

include("includes/header.php");
include("includes/_functions.php");

//Pagination
//////////// pagination
$getcount = mysqli_query ($con,"SELECT COUNT(*) FROM cars");
$postnum = mysqli_result($getcount,0);// this needs a fix for MySQLi upgrade; see custom function below
$limit = 9;

if($postnum > $limit){
  $tagend = round($postnum % $limit,0);
  $splits = round(($postnum - $tagend)/$limit,0);

  if($tagend == 0){
    $num_pages = $splits;
  }else{
    $num_pages = $splits + 1;
  }

  if(isset($_GET['pg'])){
    $pg = $_GET['pg'];
  }else{
    $pg = 1;
  }
    $startpos = ($pg*$limit)-$limit;
    $limstring = "LIMIT $startpos,$limit";
}else{
  $limstring = "LIMIT 0,$limit";
}
// MySQLi upgrade: we need this for mysql_result() equivalent
function mysqli_result($res, $row, $field=0) {
  $res->data_seek($row);
  $datarow = $res->fetch_array();
  return $datarow[$field];
}

?>

<?php

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

  //home
  else if (isset($_POST['home'])){
    header("Location: index.php");
  }

  else if (isset($_POST['logout'])){
    session_unset();
    header("Location: admin/logout.php");
  }
?>

<div class="gallery alert alert-info">
<br>

<div class="info">
  
  <h2>Welcome to my Cars Catalog Project</h2>
  <p>
    This project contains a catalog of cars that are on the market today that are relatively in the budget for most consumers. In this catalog you will find some specs of the cars that you choose to further investigate. This will highlight some general specifications of cars in a quick way to view certain details you may be looking for. Perhaps this can aid you in purchasing a vehicle for the future.
  </p>
  <br>
  
  <h3>Home Page</h3>
  <p>
    Currently this is the home page, you will find a brief description of the cars catalog above.
  </p>
  <br>
  
  <h3>List Page</h3>
  <p>
    Here you will find a list of available cars in the current database. This page will also include the searches, which can also be done via filters.
  </p>
  <ul>
    <li><h4>Filters</h4></li>
    <li>All Filters generated dynamically</li>
    <li>Budget Choices filter is the filter with the between clause</li>
  </ul>
  <br>

  <h3>Specification Pages (Results Page)</h3>
  <p>
    Here you will be able to find all the specs currently available in the database. Included is a youtube embedded review of the car. You will also notice the average ratings posted by the users that have used this page.
  </p>
  <ul>
    <li><h4>Neat little extras:</h4></li>
    <li>The Youtube videos are embedded via the insert or edit page by simply copying and pasting the youtube URL.</li>
    <li>The ratings page records users' IP to uniquely identify the person so that they can only vote once per car. This is done using another table in phpMyAdmin. I chose the car make as the value to be included because the database can be deleted and updated and the car id may change, but it is far less likelier a manufacturer will change their car's model name or even have competitors name their models after competing manufacturers.</li>
  </ul>
  <br>

  <h3>Admin Pages</h3>
  <p>
    Admin pages are reserved for admins for CRUD applications. 
  </p>

</div>

<?php include ("includes/footer.php") ?>