<?php
require_once '../LoginHandle.php';
LoginHandler::Button();
//this checks to make sure the user is actually an admin
LoginHandler::CheckPrivilege(1);
// this page just displays buttons ?>




<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <center><h2> Enter Username of Librarian or User </h2></center>
    <br><br>

    <link rel="stylesheet" href="background.css">

<body>
<form action="manlib2.php" method="post">
  <div class="container">


    <input type="text" class="form-control" placeholder="Username" name="username" required>
    <br>
    <div class="clearfix">
      <button type="submit" name="changeinfo"class="btn btn-primary">Change Info</button>
      <button type="submit" name="delete"class="btn btn-primary">Delete User</button>
      <br><br>
      <button type="button" onclick="window.location.href = 'welcome.php';" class="btn btn-primary">Cancel</button>
    </div>



  </form>
  </html>
  </body>


  </html>
