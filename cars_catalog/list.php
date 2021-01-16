<?php

  session_start();

?>

<style>
.filtermenu{
  border-radius: 25px;
  background-color: rgb(235, 105, 101);
  width: 350px;
  padding: 1rem;
  position: absolute;
  right: 30;
  top: 300;
}
</style>

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
<?php 
$result = mysqli_query($con, "SELECT * FROM cars ORDER BY make DESC $limstring"); 

$displayby = $_GET['displayby'];
$displayvalue = $_GET['displayvalue'];

if(isset($displayby) && isset($displayvalue)) {
  $result = mysqli_query($con,"SELECT * FROM cars WHERE $displayby LIKE '$displayvalue' ") or die (mysqli_error($con));
  
}

while ($row = mysqli_fetch_array($result)): 


  $thisId = $row['id'];
  $resultLinks = "<a href=\"result.php?id=$thisId\">View Info</a><br>";
  //$thisDate = strtotime($row['dan_timedate']);
  //$thisDate = date("F j, Y g:i a", $thisDate);
  $pic = $row['pic'];
  $imglocation = "admin/thumbs/" . $pic


?>

	<div class="items alert alert-info clearfix">
    <a href="result.php?id=<?php echo $row['id'] ?>">
    <img src="admin/thumbs/<?php echo $row['pic'] ?>">
		<p><?php echo $row['model']; ?></p>
   <!--  <p><?php //echo $row['dan_message'] ?></p> -->
  <!-- append emoticon img -->
  <!-- New line break nl2br -->
    </a>
  </div>
	
<?php endwhile; ?>
</div>




<!-- FILTER -->
<div class="filtermenu">
<h2>Filter Search</h2>
<a href="http://dchong5.dmitstudent.ca/dmit2025/project/cars_catalog/list.php">All Cars</a>
<br><br>

<h3>Make</h3>
<!-- Make Dropdown Menu -->
<div class="form-group">

  <select class="custom-select" name="entryselect" id="entryselect" onchange="go()">
    <option value="#" disabled selected>--Select Car--</option>
    <?php 
      $result = mysqli_query($con, "SELECT DISTINCT make FROM cars ORDER BY make DESC");
      while ($rows = $result->fetch_assoc()) {
        $thismake = $rows['make'];
        echo "<option value=\"http://dchong5.dmitstudent.ca/dmit2025/project/cars_catalog/list.php?displayby=make&displayvalue=$thismake\">$thismake</option>";
      }
    ?>
  </select>
</div>

<!-- script to make dropdown work -->
<script> 
function go() { 
  box = document.getElementById('entryselect'); // gets form element by the id. 
  destination = box.options[box.selectedIndex].value; 
  if (destination) location.href = destination;
  return false;
} 
</script>


<h3>Type</h3>
<?php  
$qry = "SELECT DISTINCT type AS first_char FROM cars 
        ORDER BY model";
$result = mysqli_query($con,$qry);
$current_char = '';
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['first_char'] != $current_char) {
        $current_char = $row['first_char'];

        $thisChar = strtoupper($current_char);

        echo "<a href=\"list.php?displayby=type&displayvalue=$thisChar%\">$thisChar</a> | ";
    }

}
?>

<h3>Seating</h3>
<?php  
$qry = "SELECT DISTINCT seating AS first_char FROM cars
        ORDER BY model";
$result = mysqli_query($con,$qry);
$current_char = '';
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['first_char'] != $current_char) {
        $current_char = $row['first_char'];

        $thisChar = strtoupper($current_char);

        echo "<a href=\"list.php?displayby=seating&displayvalue=$thisChar%\">$thisChar</a><br>";
    }

}
?>

<h3>Alphabetical</h3>
<?php  
$qry = "SELECT DISTINCT LEFT(model, 1) AS first_char FROM cars
        WHERE UPPER(model) BETWEEN 'A' AND 'Z'
        ORDER BY model";
$result = mysqli_query($con,$qry);
$current_char = '';
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['first_char'] != $current_char) {
        $current_char = $row['first_char'];

        $thisChar = strtoupper($current_char);

        echo "<a href=\"list.php?displayby=model&displayvalue=$thisChar%\">$thisChar</a> | ";
    }

}

?>


<h3>Price</h3>
<?php  
// $qry = "SELECT DISTINCT *, LEFT(price, 1) AS first_char FROM cars
$qry = "SELECT DISTINCT LEFT(price, 1) AS first_char FROM cars
       
        ORDER BY first_char ASC";
$result = mysqli_query($con,$qry);
$current_char = '';
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['first_char'] != $current_char) {
        $current_char = $row['first_char'];

        $thisChar = strtoupper($current_char);
        $thisChars = strtoupper($current_char)."0k";

        echo "<a href=\"list.php?displayby=price&displayvalue=$thisChar%\"> $thisChars</a> |";
    }

}

?>

<h3>Budget Choices</h3>
<?php  

$min = 0;
$max = 40000;
$qry = "SELECT model AS first_char FROM cars WHERE price BETWEEN '$min' AND '$max'";
$result = mysqli_query($con,$qry);
$current_char = '';
while ($row = mysqli_fetch_assoc($result)) {
  if ($row['first_char'] != $current_char) {
    $current_char = $row['first_char'];

    $thisChar = strtoupper($current_char);

    echo "<a href=\"list.php?displayby=model&displayvalue=$thisChar%\">$thisChar</a> | ";
}

}

?>

</div>



<nav aria-label="Page navigation example">
  <ul class="pagination">
<!-- Pagination -->
<?php
///////////////// pagination links: perhaps put these BELOW where your results are echo'd out.
if($postnum > $limit){
  $n = $pg + 1;
  $p = $pg - 1;
  $thisroot = $_SERVER['PHP_SELF'];
  
  if($pg > 1){
    echo "<li class=\"page-item\"><a class=\"page-link\" href=\"$thisroot?pg=$p\" aria-label=\"Previous\"><span aria-hidden=\"true\">&laquo;</span><span class=\"sr-only\">Previous</span></a></li>";
  }
  
  for($i=1; $i<=$num_pages; $i++){
    if($i!= $pg){
      echo "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"$thisroot?pg=$i\">$i</a></li>;";
    }else{
      echo "<a class=\"page-link active\" href=\"#\">$i<span class=\"sr-only\">(current)</span></a>";
    }
  }
    
  if($pg < $num_pages){
    echo "<li class=\"page-item\"><a class=\"page-link\" href=\"$thisroot?pg=$n\" aria-label=\"Previous\"><span aria-hidden=\"true\">&laquo;</span><span class=\"sr-only\">Next</span></a></li>";
  }

}
// ambitious students may want to reformat this. Perhaps use Bootstraps pagination markup.
////////////// end pagination
?>
</ul>
</nav>

<?php include ("includes/footer.php") ?>