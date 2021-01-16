<?php
	include("login-data.php");

	//Create bootstrap for username password
	//session_start();
	$username = trim($_POST['username']); //trim removes spaces before or after your text string
	$password = trim($_POST['password']);

	//echo "$username, $password";

	if (isset($_POST['mysubmit'])) {
		//echo "submit";
		if (($username == $username_good) && (password_verify($password, $pw_enc))) {
			//SUCCESS
			//$msg = "You are the best looking and best everything";

			session_start();
			$_SESSION['qwerty'] = session_id();

			header("Location: insert.php"); //remember to disable this if you are debugging
		}
		else{
			$msg = "incorrect login";
    }
	}
	else{
		if ($username != "" && $password != "") {
			
		}
		else{
			$msg = "Please type in a username and password.";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Login</title>
    
    <!-- Optional: Just reducing width of the form on desktop -->
    <style type="text/css">
      
      form{
        max-width: 450px;
      }

    </style>
  
  </head>
  <body>
    
    <div class="container">
      <h1>Sign-In</h1>

      <form name="myform" method="post" action="login.php">
        
          <!-- Name -->
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username">
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password">
          </div>

          <!-- Submit -->
          <button type="submit" name="mysubmit" class="btn btn-primary">Login</button>
          <div class="btn btn-secondary"><a href="../index.php">Home</a></div>
      </form>

      <p>&nbsp;</p>

    	<div>
      	<?php

        	if($msg)
        	{
        		echo "\n<div class=\"alert alert-primary\">$msg</div>";
        	}

      	?>
  		</div>



    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>