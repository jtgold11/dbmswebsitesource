<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'LoginHandle.php';

$alertDisplay = false;


// if the user is already logged in, redirect them to the
// welcome page

if (LoginHandler::IsLoggedIn()) {
//   $accType = LoginHandler::GetCurrentAccountType();

    // switch ($accType) {
    //     case 1:
    //         header("Location: /admin/welcome.php");
    //         exit;
    //
    //     case 2:
    //         header("Location: /librarian/welcome.php");
    //         exit;
    //
    //     case 3:
    //         header("Location: /user/welcome.php");
    //         exit;
    //
    // }


}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get account type, username, and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];
    $lh = new LoginHandler($username, $password);
    if($lh->Login() !== false){
    $acc = $lh->GetCurrentAccountType();

    if ($acc == 2){

          header("Location: /librarian/welcome.php");
          exit;

    }
    else if ($acc == 3){
          header("Location: /user/welcome.php");
          exit;

    }

    else if($acc == 1){
         header("Location: /admin/welcome.php");
          exit;
    }

 }
 else {

     $alertDisplay = true;
 }
}



?>

<!DOCTYPE html>
<html>

<head>
    <center><h3> You have attempted to view unauthorized content. Please login again </h3></center>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="background.css">
</head>

<body>

    <!-- Login Boxes -->
    <div class="container">

        <div class="alert alert-danger" role="alert" style="display:<?php echo ($alertDisplay?"block":"none"); ?>;">
            Sorry, but your username or password is incorrect.
        </div>

        <form action="index.php" method="POST">


            <div class="form-group">
                <label for="exampleInputUsername1">Username</label>
                <input type="username" class="form-control" id="exampleInputUsername1" aria-describedby="emailHelp"
                    placeholder="Username" name="username">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"
                    name="password">
                <small id="emailHelp" class="form-text text-muted">Never share your username or password with anyone else.</small>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Remember My Username</label>
            </div>

    <!-- End Login Boxes -->

    <!-- SignUp box -->
      <button type="button" onclick="window.location.href = 'register.php';" class="btn btn-primary">SignUp</button>

      <button type="submit" class="btn btn-primary">Login</button>

    </form>

  </div>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X
      +965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384
      -UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384
      -JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>

</html>
