<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="background.css">

<body>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../Database.php';
require_once '../LoginHandle.php';
require_once '../Account.php';
LoginHandler::CheckPrivilege(2);
$alertDisplay = false;


$db = new Database();
$acc = new Account();
$user = $acc->loaduser(LoginHandler::GetCurrentUsername());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$email = $pass ="";
$email = $_POST["email"];
$pass = $_POST["psw"];
$realpass = $user->getPasshash();
if($pass != $realpass){
    $alertDisplay = true;
}
else{
$id = $user->getID();
$queryStr = "UPDATE User SET email='{$email}' WHERE UID={$id};";
$db->sql->query($queryStr);
header("Location: changeinfo.php");
exit;
}
}

?>

<div class="jumbotron1 text-center">
  <h2>Change Email</h2>
  <br>
</div>
<div class="alert alert-danger" role="alert" style="display:<?php echo ($alertDisplay?"block":"none"); ?>;">
    Password Incorrect
</div>

<form action="changeemail.php" method="post" style="border:1px solid #ccc">
  <div class="container">

    <label for="email"><b>Email</b></label>
    <input type="text" class="form-control" value="<?php echo $user->email ?>" name="email" required>
    <br>
    <label for="psw"><b>Password</b></label>
    <input type="password" class="form-control" placeholder="Enter Password To Confirm" name="psw" required>
    <br>
    <div class="clearfix">
      <button type="button" onclick="window.location.href = 'changeinfo.php';" class="btn btn-primary">Cancel</button>
      <button type="submit" class="btn btn-primary">Submit</button>
      <br>
      <br>
    </div>
  </div>
</form>
</html>
</body>


</html>
