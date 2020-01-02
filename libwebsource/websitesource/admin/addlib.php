<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../Database.php';
require_once '../Account.php';
require_once '../LoginHandle.php';
LoginHandler::CheckPrivilege(1);
// variables for making alerts if user did something wrong 
$alertDisplay = false;
$alertDisplay2 = false;
$alertDisplay3 = false;
$truthhold = false;
$truthhold2 = false;
$truthhold3 = false;
$db = new Database();
//if you recieved a post from another website
if ($_SERVER["REQUEST_METHOD"] == "POST") {
//geting variables from post
    $email = $_POST["email"];
    $username = $_POST["usn"];
    $password = $_POST["psw"];
    $dob = $_POST["dob"];
    $passRep = $_POST["psw-repeat"];
//doing the query
    $queryStr = "SELECT username FROM User WHERE username='{$username}';";
    $result = $db->sql->query($queryStr);
//checking that the username isn't already in use
    if($result->num_rows == 0){
      $truthhold = true;
    }
    else{
      $alertDisplay = true;
    }

    $queryStr2 = "SELECT email FROM User WHERE email='{$email}';";
    $result = $db->sql->query($queryStr2);
//checking that the email isn't already in use
    if($result->num_rows == 0){
      $truthhold2 = true;
    }
    else{
      $alertDisplay2 = true;
    }
//check that the passwords match
    if($password  == $passRep){
      $truthhold3 = true;
    }
    else{
      $alertDisplay3 = true;
    }

    if($truthhold && $truthhold2 && $truthhold3){
//make a date that is in the right format for mysql
      $today = getdate();
      $month = $year = $mday = $newmday = "";
      $month =  $today["mon"];
      $year = $today["year"];
      $mday = $today["mday"];

      if($today["mday"] < 10){
      $newmday = "0" . $mday;}
      else{
      $newmday = $mday;}

      $date1 = $year . "-" . $month . "-" . $newmday;
//putting the user into the database
      $queryStr3 = "INSERT INTO User(UID, email, fines, accType, username, password, dob, djoin) VALUES (NULL, '{$email}', 0, 2, '{$username}', '{$password}','{$dob}','{$date1}');";
      $db->sql->query($queryStr3);



    // now that they've signed up, re-direct to login page
    header("Location: welcome.php");
    exit;
  }
}



?>








<!DOCTYPE html>
<html>
  <head>

    <meta charset="UTF-8">
    <title>Welcome</title>
    <meta name="viewport" cotent="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin=
        "anonymous">
    <link rel="stylesheet" href="background.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>



  </head>

  <style>
  .jumbotron {
    background-color: #808080;
    color: #00000;
  }
  </style>

<body>

  <div class="jumbotron text-center">
    <h1>Register</h1>
  </div>
  <div class="alert alert-danger" role="alert" style="display:<?php echo ($alertDisplay?"block":"none"); ?>;">
      Sorry, but your username is already taken.
  </div>
  <div class="alert alert-danger" role="alert" style="display:<?php echo ($alertDisplay2?"block":"none"); ?>;">
        Sorry, but your email is already in use.
    </div>
    <div class="alert alert-danger" role="alert" style="display:<?php echo ($alertDisplay3?"block":"none"); ?>;">
        Sorry, but your passwords do not match.
    </div>

<form action="addlib.php" method="post" style="border:1px solid #ccc">
  <div class="container">

    <label for="email"><b>Email</b></label>
    <input type="text" class="form-control" placeholder="Enter Email" name="email" required>
    <br>
    <label for="username"><b>Username</b></label>
    <input type="text" class="form-control" placeholder="Enter Username" name="usn" required>
    <br>
    <label for="dob"><b>Date of Birth   (YYYY-MM-DD)</b></label>
    <input type="text" class="form-control" placeholder="Enter Password" name="dob" required>
    <br>
    <label for="psw"><b>Password</b></label>
    <input type="password" class="form-control" placeholder="Enter Password" name="psw" required>
    <br>
    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" class="form-control" placeholder="Repeat Password" name="psw-repeat" required>
    <br>

    <div class="clearfix">
      <button type="button" onclick="window.location.href = 'welcome.php';" class="btn btn-primary">Cancel</button>
      <button type="submit" class="btn btn-primary">Register</button>
      <br>
      <br>
    </div>
  </div>
</form>






  </body>

</html>
