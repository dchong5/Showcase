
<?php

include("mysql_connect.php");// here we include the connection script; since this file(header.php) is included at the top of every page we make, the connection will then also be included. Also, config options like BASE_URL are also available to us.

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
   
    <!--  This CONSTANT is defined in your mysql_connect.php file. -->
    <title><?php echo APP_NAME; ?></title>

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">



<!-- Latest compiled and minified JavaScript -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<!-- Google Icons: https://material.io/tools/icons/
  also, check out Font Awesome or Glyphicons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


 <!-- Your Custom styles for this project -->
 <!--  Note how we can use BASE_URL constant to resolve all links no matter where the file resides. -->
<link href="<?php echo BASE_URL ?>css/styles.css" rel="stylesheet">
<!-- Themes from https://bootswatch.com/ : Use the Themes dropdown to select a theme you like; copy/paste the bootstrap.css. Here, we have named the downloaded theme as a new file and can overwrite the default.  -->
<!-- <link href="<?php echo BASE_URL ?>css/bootstrap-lumen.css" rel="stylesheet"> -->

<style type="text/css">
    body{
      background-color: rgb(56,56,56);
    }

    .displayed{
      display: flex;
      flex-direction: row-reverse;
    }

    .intro{
      display: flex;
    }

    .required:before {
      content:"* ";
      color: red;
    }

    .jumbotron{
      margin-bottom: 0;
      background-color: rgb(171, 0, 0);
    }

    .navdiv{
      display: flex;
      flex-direction: row;
      width: 100%;
      background-color: rgb(235, 105, 101);

    }

    .nav-item{
      width: 5rem;
    }

    .rando{
      background-color: rgb(230, 225, 211);
      height: 30rem;
      overflow: visible;
    }

    .blogdisplay{
      display: flex;
      width: 100%;
    }

    .blogdisplay h2{
      width: 80%
    }

    .blogdisplay p{
      width: 19%;
      font-size: 1rem;
      font-style: italic;
      text-align: right;
    }

    .page-item{
      background-color: rgb(246, 250, 135);
    }

    .gallery{
      display: flex;
      flex-wrap: wrap;
      width: 100%;
    }

    .items{
      display: flex;
      flex-wrap: wrap;
      align-content: center;
      width: 33%;
    }

    .items p,
    .items img{
      width: 100%;
      text-align: center;
      display: block;
      margin-left: auto;
      margin-right: auto
    }

    .display h2,
    .display div{
      text-align: center;
    }

    .display img{
      display: block;
      margin-left: auto;
      margin-right: auto
    }

    .edititems{
      display: flex;
      flex-direction: row-reverse;
      justify-content: space-evenly;
    }

    .listicons{
      display: flex;
      flex-wrap: wrap;
      width: 100%;
    }
    .listicons .picicons{
      width: 25%;
      height: 8rem;
    }

</style>

<!-- EMOTICON JS Link -->

<script type="text/javascript">
  function emoticon(text) {
    var txtarea = document.myform.message; // must change these
      text = ' ' + text + ' ';
      if (txtarea.createTextRange && txtarea.caretPos) {
      var caretPos = txtarea.caretPos;
      caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? text + ' ' : text;
      txtarea.focus();
      } 
      else {
      txtarea.value += text;
      txtarea.focus();
    }
  }
</script>



</head>

  <body>

    <main role="main" class="container">

    <div class="jumbotron clearfix">
        <h1><?php echo APP_NAME ?></h1>
        <p class="lead float-right">By Daniel Chong</p>       
    </div>

    <div class="col col-12 navdiv" id="navbar">
      <ul class="navbar-nav mr-auto navdiv">
        <li class="nav-item active"><a class="nav-link" href="<?php echo BASE_URL ?>#">Home</a></li>
        <li class="nav-item active"><a class="nav-link" href="<?php echo BASE_URL ?>list.php">List</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="admin" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="<?php echo BASE_URL ?>admin/insert.php">Insert</a>
            <a class="dropdown-item" href="<?php echo BASE_URL ?>admin/edit.php">Edit</a>
            <a class="dropdown-item" href="<?php echo BASE_URL ?>admin/logout.php">Logout</a>
          </div>
        </li>
      </ul>
    </div>



    

      

    




