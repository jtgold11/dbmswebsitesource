<?php
require_once '../LoginHandle.php';
LoginHandler::Button();
 ?>

<!DOCTYPE html>
<html>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="background.css">
<head>
<style>
.button {
  background-color: #000000;
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
<a href="search.php" class="button">Search Books</a>
<a href="browse.php" class="button">Browse Books</a>
<a href="waitlist.php" class="button">View Waitlist</a>
<a href="changeinfo.php" class="button">Change Info</a>

</center>


</body>
</html>
