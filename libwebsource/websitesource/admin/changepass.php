
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../Database.php';
require_once '../LoginHandle.php';
require_once '../Account.php';
$alertDisplay = false;
$alertDisplay2 = false;
LoginHandler::CheckPrivilege(1);
$db = new Database();
$acc = new Account();
$user = $acc->loaduser(LoginHandler::GetCurrentUsername());
//if post continue
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$npass = $opass = $rpass ="";
$npass = $_POST["npass"];
$opass = $_POST["opsw"];
$rpass = $_POST["rpsw"];
$realpass = $user->getPasshash();
//check that the password matches
if($opass != $realpass){
    $alertDisplay = true;
}
//check that new passwords match
if($npass != $rpass){
  $alertDisplay2 = true;
}
if(!$alertDisplay && !$alertDisplay2){
$id = $user->getID();
//update the users password
$queryStr = "UPDATE User SET password='{$npass}' WHERE UID={$id};";
$db->sql->query($queryStr);
header("Location: changeinfo.php");
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
  <h2>Change Email</h2>
  <br>
</div>
<div class="alert alert-danger" role="alert" style="display:<?php echo ($alertDisplay?"block":"none"); ?>;">
    Password Incorrect
</div>
<div class="alert alert-danger" role="alert" style="display:<?php echo ($alertDisplay2?"block":"none"); ?>;">
    Passwords Don't Match
</div>

<form action="changepass.php" method="post" style="border:1px solid #ccc">
  <div class="container">

    <label for="npass"><b>New Password</b></label>
    <input type="password" class="form-control" placeholder="New Password" name="npass" required>
    <br>
    <label for="rpsw"><b>Repeat New Password</b></label>
    <input type="password" class="form-control" placeholder="Repeat Password" name="rpsw" required>
    <br>
    <label for="opsw"><b>Old Password</b></label>
    <input type="password" class="form-control" placeholder="Enter Password To Confirm" name="opsw" required>
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
