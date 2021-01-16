<?php

	session_start();

	if (!isset($_SESSION['qwerty'])){
      header("Location: login.php");
  	}

?>

<?php 

	include("../includes/header.php");
	include("../includes/_functions.php");
	include("../includes/watermark.php");
?>


<?php

	//Lets retrieve our "apge setter" variable that will define the content. Inn this case, which item do we edit.
	$pageID = $_GET['id'];
	//echo "<h1>$pageID</h1>";

	//but, what happens if we just come to edit and havent yet selected an item to edit? Let's have a default item that is chosen as soon as we load the page.

	if (!isset($pageID)) {
		$tmp = mysqli_query($con, "SELECT id FROM cars LIMIT 1");
		while ($row = mysqli_fetch_array($tmp)) {
			$pageID = $row['id']; //here is our default value
		}
	}

	//************************** So update Links at top will refresh to correct

		//Step 3: If user submits form, then do UPDATE
	if (isset($_POST['mysubmit'])) {
		
		if (isset($_POST['mysubmit'])) {
			$id = trim($_POST['id']);
			$make = trim($_POST['make']);
			$model = trim($_POST['model']);
			$type = trim($_POST['type']);
			$horsepower = trim($_POST['horsepower']);
			$fuel_type = trim($_POST['fuel_type']);
			$city_econ = trim($_POST['city_econ']);
			$highway_econ = trim($_POST['highway_econ']);
			$seating = trim($_POST['seating']);
			$price = trim($_POST['price']);
			$pic = trim($_POST['pic']);
			$vid = trim($_POST['vid']);
			$myfile = ($_FILES['myfile']['name']); //File name

			$target_dir = "originals/";
			$target_file = $target_dir . basename($_FILES["myfile"]["name"]);
			// Valid file extensions
	  		$extensions_arr = array("image/jpg","image/jpeg","image/png","image/gif");
	  		// Select file type
	  		//$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	  		$imageFileType =$_FILES['myfile']['type'];

			$skipImage = 0;
			$valid = 1;
			$msgPreError = "\n<div class = \"alert alert-danger\" role = \"alert \">";
			$msgPreSuccess = "\n<div class = \"alert alert-primary\" role = \"alert \">";
			$msgPost = "\n</div>";

			//make
			if ((strlen($make) < 3) || (strlen($make) > 100)) {
				$valid = 0;
				$valMakeMsg= "Please enter the manufacturer of the vehicle";
			}
			//make
			if ((strlen($model) < 1) || (strlen($model) > 100)) {
				$valid = 0;
				$valModelMsg= "Please enter the model of the vehicle";
			}
			//type
			if($type == "")
		    {
				$valid = 0;
				$valTypeMsg = "Please make a selection on vehicle type";
			}
			//horsepower
			if (!is_numeric($horsepower))
			{
				$valid = 0;
				$valHorseMsg = "Please enter a numeric input";
			}

			//fuel type
			if($fuel_type == "")
		    {
				$valid = 0;
				$valFuelMsg = "Please make a selection on vehicle type";
			}

			//City Econ
			if (!is_numeric($city_econ))
			{
				$valid = 0;
				$valCityMsg = "Please enter a numeric input";
			}

			//Highway Econ
			if (!is_numeric($highway_econ))
			{
				$valid = 0;
				$valHighMsg = "Please enter a numeric input";
			}

			//Seating
			if (!is_numeric($seating))
			{
				$valid = 0;
				$valSeatMsg = "Please enter a integer input";
			}

			//Price
			if (!is_numeric($price))
			{
				$valid = 0;
				$valPriceMsg = "Please enter a numeric input";
			}

			if (isset($myfile)){

				if($myfile == $pic){
					$skipImage = 1;
				}
				else{

					//PNG, GIF, JPEG?
					if(!in_array($imageFileType,$extensions_arr) ){
					    $valid = 0;
						$valUpMsg = "Wrong file type: that is NOT a JPEG image.";

					}

					//is it too big? set to decent size
					if ($_FILES['myfile']['size'] /1024/1024 > 8) {
						$valid = 0;
						$valUpMsg = "Size too big. Please upload smaller than 8MB";
					}
				}
				
			}
			else{

				$skipImage = 1;
			}


	    	/* SUCCESS */
	    	if ($valid == 1){

	    		if($skipImage = 1){
					$make = strtolower($make);
					$make = ucfirst($make);
					$model = ucfirst($model);

	    			mysqli_query($con, "UPDATE cars SET
			    			make = '$make', 
			    			model = '$model', 
			    			type = '$type', 
			    			horsepower = '$horsepower', 
			    			fuel_type = '$fuel_type', 
			    			city_econ = '$city_econ', 
			    			highway_econ = '$highway_econ', 
			    			seating = '$seating', 
			    			price = '$price'
			    		 	WHERE id = '$pageID'")or die(mysqli_error($con));

			    		$msgSuccess = "Cars has been updated.";
			    	}
			    	else{
						echo "Error Uploading Image";
					}

	    		}
	    		else{
		    		if (move_uploaded_file($_FILES['myfile']['tmp_name'], $originalsFolder . $_FILES['myfile']['name'])) {
						$make = strtolower($make);
						$make = ucfirst($make);
						$model = ucfirst($model);
						
		    			//SUCCESS: File has been uploaded. Go ahead, and create thumbnail copies
						$thisFile = $originalsFolder . $_FILES['myfile']['name'];
						createSquareImageCopy($thisFile, $thumbsFolder, 300);
						//createThumbnail($thisFile, $thumbsFolder, 300); //thumbs
						createThumbnail($thisFile, $displayFolder, 800); //dispaly

			    		//Do not add , on last sql item
			    		mysqli_query($con, "UPDATE cars SET


			    			make = '$make', 
			    			model = '$model', 
			    			type = '$type', 
			    			horsepower = '$horsepower', 
			    			fuel_type = '$fuel_type', 
			    			city_econ = '$city_econ', 
			    			highway_econ = '$highway_econ', 
			    			seating = '$seating', 
			    			price = '$price', 
			    			pic = '$myfile'
			    		 	WHERE id = '$pageID'")or die(mysqli_error($con));

			    		$msgSuccess = "Cars has been updated.";
			    	}
			    	else{
						echo "Error Uploading Image";
					}
				}

	    	
    	}
	}

	//**************************


	/* Step 1: create dynamic nav system */

	$result = mysqli_query($con, "SELECT * FROM cars ORDER BY make DESC");
	while($row = mysqli_fetch_array($result)){
		$thisTitle = $row['model'];
		//$thisPerson = $row['last_name'];
		$thisId = $row['id'];

		//from this data, create some links which show the character names to the user

		$editLinks .= "\n<a href=\"edit.php?id=$thisId\">$thisTitle</a><br>";

		/*
			Query String Syntax: pagename.php?var=value&var2=value2&var3=value3
		*/
	}

	/* Step 2: Prepop form fields with existing values for selected item */
	$result = mysqli_query($con, "SELECT * FROM cars WHERE id = '$pageID'");

	while($row = mysqli_fetch_array($result)){
		$id = ($row['id']);
		$make = ($row['make']);
		$model = ($row['model']);
		$type = ($row['type']);
		$horsepower = ($row['horsepower']);
		$fuel_type = ($row['fuel_type']);
		$city_econ = $row['city_econ'];
		$highway_econ = ($row['highway_econ']);
		$seating = ($row['seating']);
		$price = ($row['price']);
		$pic = ($row['pic']);
		$vid = ($row['vid']);
		$uploadedpic = ($row['pic']);
	}
?>

<?php if ($msgSuccess) { echo $msgPreSuccess.$msgSuccess.$msgPost;} ?>

<?php 

	/*
		$_SERVER['REQUEST_URI'] will retain the necessary Query String (appennd URL) info (keep the id=number in url)
		$_SERVER['PHP_SELF'] will NOT retain the necessary Query String (appennd URL) info
	*/

?>
<style>
.ddlmenu{
	text-align: center;
}

</style>
<div class="col col-12 alert alert-info edititems">
<div class="col col-6">
<!-- Select from DDL edit entires -->
	<div class="form-group ddlmenu">
			<label for="selection">Select the car entry you wish to edit:</label>
			<br>
			<select class="custom-select" name="entryselect" id="entryselect" onchange="go()">
				<option value="#" disabled selected>--Select Entries--</option>
				<?php 
					$result = mysqli_query($con, "SELECT * FROM cars ORDER BY model DESC");
					while ($rows = $result->fetch_assoc()) {
						$entries = $rows['model'];
						$entryId = $rows['id'];
						echo "<option value=\"http://dchong5.dmitstudent.ca/dmit2025/project/cars_catalog/admin/edit.php?id=$entryId\">$entries</option>";
					}
				?>
			</select>
		</div>

<script> 
function go() { 
	box = document.getElementById('entryselect'); // gets form element by the id. 
	destination = box.options[box.selectedIndex].value; 
	if (destination) location.href = destination;
	return false;
} 
</script>

<?php 
	if (isset($_POST['myselect'])) {
		$result = mysqli_query($con, "SELECT * FROM cars WHERE model = $entries");
		$rows = $result->fetch_assoc();
		$id = ($row['id']);
		$make = ($row['make']);
		$model = ($row['model']);
		$type = ($row['type']);
		$horsepower = ($row['horsepower']);
		$fuel_type = ($row['fuel_type']);
		$city_econ = $row['city_econ'];
		$highway_econ = ($row['highway_econ']);
		$seating = ($row['seating']);
		$price = ($row['price']);
		$pic = ($row['pic']);
		$vid = ($row['vid']);

		header("Location: ../edit.php?id=$thisId");
	} 
?>
<br>
</div>
<div class="displayedit">
<h2>Edit</h2>
<form id="myform" name="myform" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
		<div class="form-group required">
			<label for="make">Make:</label>
			<input type="text" name="make" class="form-control" value="<?php echo $make; ?>">
			<?php if(isset($valMakeMsg)){ echo $msgPreError . $valMakeMsg . $msgPost;} ?> 
		</div>
		<div class="form-group required">
			<label for="model">Model:</label>
			<input type="text" name="model" class="form-control" value="<?php echo $model; ?>">
			<?php if(isset($valModelMsg)){ echo $msgPreError . $valModelMsg . $msgPost;} ?> 
		</div>
		<div class="form-group">
		    <label for="type">Type:</label>
		   	<select name="type" class="form-control">
		   		<option value="">-Select The Vehicle Type--</option>
				<option value="Sedan" <?php if(isset($type) && $type == "Sedan"){echo "selected";} ?>>Sedan</option>
				<option value="SUV" <?php if(isset($type) && $type == "SUV"){echo "selected";} ?>>SUV</option>
				<option value="Truck" <?php if(isset($type) && $type == "Truck"){echo "selected";} ?>>Truck</option>
				<option value="Van" <?php if(isset($type) && $type == "Van"){echo "selected";} ?>>Van</option>
				<option value="Coupe" <?php if(isset($type) && $type == "Coupe"){echo "selected";} ?>>Coupe</option>
				<option value="Hatchback" <?php if(isset($type) && $type == "Hatchback"){echo "selected";} ?>>Hatchback</option>
			</select>
			<?php if(isset($valTypeMsg)){ echo $msgPreError . $valTypeMsg . $msgPost;} ?>
		</div>
		<div class="form-group required">
			<label for="horsepower">Horse Power:</label>
			<input type="text" name="horsepower" class="form-control" value="<?php echo $horsepower; ?>">
			<?php if(isset($valHorseMsg)){ echo $msgPreError . $valHorseMsg . $msgPost;} ?> 
		</div>
		<div class="form-group">
		    <label for="fuel_type">Fuel Type:</label>
		   	<select name="fuel_type" class="form-control">
		   		<option value="">--Select The Fuel Type--</option>
				<option value="Gasoline" <?php if(isset($fuel_type) && $fuel_type == "Gasoline"){echo "selected";} ?>>GASOLINE</option>
				<option value="Diesel" <?php if(isset($fuel_type) && $fuel_type == "Diesel"){echo "selected";} ?>>DIESEL</option>
				<option value="Electric" <?php if(isset($fuel_type) && $fuel_type == "Electric"){echo "selected";} ?>>ELECTRIC</option>
				<option value="Hybrid" <?php if(isset($fuel_type) && $fuel_type == "Hybrid"){echo "selected";} ?>>HYBRID</option>
			</select>
			<?php if(isset($valFuelMsg)){ echo $msgPreError . $valFuelMsg . $msgPost;} ?>
		</div>
		<div class="form-group required">
			<label for="city_econ">City Economy(L/100Km):</label>
			<input type="text" name="city_econ" class="form-control" value="<?php echo $city_econ; ?>">
			<?php if(isset($valCityMsg)){ echo $msgPreError . $valCityMsg . $msgPost;} ?> 
		</div>
		<div class="form-group required">
			<label for="highway_econ">Highway Economy(L/100Km):</label>
			<input type="text" name="highway_econ" class="form-control" value="<?php echo $highway_econ; ?>">
			<?php if(isset($valHighMsg)){ echo $msgPreError . $valHighMsg . $msgPost;} ?> 
		</div>
		<div class="form-group required">
			<label for="seating">Seating:</label>
			<input type="text" name="seating" class="form-control" value="<?php echo $seating; ?>">
			<?php if(isset($valSeatMsg)){ echo $msgPreError . $valSeatMsg . $msgPost;} ?> 
		</div>
		<div class="form-group required">
			<label for="price">Starting Price:</label>
			<input type="text" name="price" class="form-control" value="<?php echo $price; ?>">
			<?php if(isset($valPriceMsg)){ echo $msgPreError . $valPriceMsg . $msgPost;} ?> 
		</div>

		<div class="form-group required">
			<label for="file">File:</label>
			<input type="file" name="myfile">
			<?php if(isset($valUpMsg)){ echo $msgPreError . $valUpMsg . $msgPost;} ?>
		</div>

		<div class="form-group">
			<label for="submit">&nbsp;</label>
			<input type="submit" name="mysubmit" class="btn btn-info" value="Submit">
		</div>
</form>

<!-- Delete Button -->
<p><a onclick="return confirm('Are you sure?')" href="delete.php?id=<?php echo $pageID ?>">Delete Entry</a></p>

</div>
</div>

<?php
	include("../includes/footer.php");
?>