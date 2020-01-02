<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../LoginHandle.php';
LoginHandler::Button();
LoginHandler::CheckPrivilege(3);


 ?>
<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="background.css">
<head>
  <title> Welcome </title>

<style>
.button {
  background-color: #000001;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 8px 8px;
  cursor: pointer;
}
</style>
</head>
<body>
<center>
<h2>Account</h2>

</br>
<a href="changeemail.php" class="button">Change Email</a>
<a href="changepass.php" class="button">Change Password</a>
<br>
<a href="welcome.php" class="button">Go Back</a>


</center>


</body>
</html>
