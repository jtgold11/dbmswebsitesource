
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../Database.php';
require_once '../LoginHandle.php';
require_once '../Account.php';
$alertDisplay = false;
LoginHandler::CheckPrivilege(1);
$db = new Database();
$acc = new Account();
$acc2 = new Account();
$admin = $acc2->loaduser(LoginHandler::GetCurrentUsername());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $user = $acc->loaduser($username);
    if(!$user){
      header("Location: manlibnouser.php");
      exit;
    }

//if the form submitted fromm the html code is chngeinfo then continue here. This is for the user or librarian
    if(isset($_POST["changeinfo"])){
      if(isset($_POST["psw"])){
        $pass = $_POST["psw"];
        $email = $_POST["email"];
        $nuser = $_POST["Nusername"];
        $npass = $_POST["upass"];
        $fines = $_POST["fines"];

//check admin password is corect
      $realpass = $admin->getPasshash();
      if($pass != $realpass){
          $alertDisplay = true;
      }
      else{
        //change the users info
      $id = $user->getID();
      $queryStr = "UPDATE User SET email='{$email}', username='{$nuser}', password='{$npass}', fines={$fines} WHERE UID={$id};";
      $db->sql->query($queryStr);
      header("Location: manlib.php");
      exit;
      }
    }
      ?>
      <!DOCTYPE html>
      <html>
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


          <link rel="stylesheet" href="background.css">

      <body>
      <div class="jumbotron1 text-center">
        <h2>Change User Info</h2>
        <br>
      </div>
      <div class="alert alert-danger" role="alert" style="display:<?php echo ($alertDisplay?"block":"none"); ?>;">
          Password Incorrect
      </div>

      <form action="manlib2.php" method="post" style="border:1px solid #ccc">
        <div class="container">

          <label for="email"><b>Email</b></label>
          <input type="text" class="form-control" value="<?php echo $user->email; ?>" name="email" required>
          <br>
          <label for="Nusername"><b>Username</b></label>
          <input type="text" class="form-control" value="<?php echo $user->username; ?>" name="Nusername" required>
          <br>
          <label for="upass"><b>Password</b></label>
          <input type="text" class="form-control" value="<?php echo $user->getPasshash();?>" name="upass" required>
          <br>
          <label for="fines"><b>Fines</b></label>
          <input type="text" class="form-control" value="<?php echo $user->fines; ?>" name="fines" required>
          <br>
          <label for="psw"><b>Admin Password</b></label>
          <input type="password" class="form-control" placeholder="Enter Admin Password To Confirm" name="psw" required>
          <br>
          <input type="hidden" name="username" id="hiddenField" value="<?php echo $username; ?>" />
          <div class="clearfix">
            <button type="button" onclick="window.location.href = 'manlib.php';" class="btn btn-primary">Cancel</button>
            <button type="submit" name="changeinfo" class="btn btn-primary">Submit</button>
            <br>
            <br>
          </div>
        </div>
      </form>
      </html>
      </body>


      </html>
<?php
    }
    //if the post is of type delete then contnue here
    if(isset($_POST["delete"])){
      if(isset($_POST["psw"])){
        $pass = $_POST["psw"];
        //check passwords match
        $realpass = $admin->getPasshash();
        if($pass != $realpass){
            $alertDisplay = true;
        }
        else{
          //delete the user
        $id = $user->getID();
        $queryStr = "DELETE FROM User WHERE UID={$id};";
        $db->sql->query($queryStr);
        header("Location: manlib.php");
        exit;
      }
      }
      ?>
      <!DOCTYPE html>
      <html>
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


          <link rel="stylesheet" href="background.css">

      <body>
      <div class="jumbotron1 text-center">
        <h2>Are you sure you want to delete user: <?php echo $username ?></h2>
        <br>
      </div>

      <div class="alert alert-danger" role="alert" style="display:<?php echo ($alertDisplay?"block":"none"); ?>;">
          Password Incorrect
      </div>
      <form action="manlib2.php" method="post">
        <div class="container">
          <label for="psw"><b>Admin Password</b></label>
          <input type="password" class="form-control" placeholder="Enter Admin Password To Confirm" name="psw" required>
          <br>
        <input type="hidden" name="confirm" id="hiddenField" value="confirm" />
          <input type="hidden" name="username" id="hiddenField" value="<?php echo $username ?>" />
          <div class="clearfix">
            <button type="button" onclick="window.location.href = 'manlib.php';" class="btn btn-primary">Cancel</button>
            <button type="submit" name="delete" class="btn btn-primary">Submit</button>
            <br>
            <br>
          </div>
        </div>
      </form>
<?php
    }

  }
?>
