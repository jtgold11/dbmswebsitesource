<?php
require_once '../Database.php';
require_once '../LoginHandle.php';
require_once '../Account.php';
$db = new Database();
$acc = new Account();
$user = $acc->loaduser(LoginHandler::GetCurrentUsername());
$truthhold = false;
LoginHandler::CheckPrivilege(1);

//if post continue

if ($_SERVER["REQUEST_METHOD"] == "POST") {
//  if(!isset(["change"])){
  $bid = $_POST["edit"];
  $queryStr = "SELECT * FROM Books WHERE BID={$bid};";
  $qresult = $db->sql->query($queryStr);
  if ($qresult && $qresult->num_rows > 0) {
        $row = $qresult->fetch_assoc();
        $bid = $row["BID"];
        $authors = $row["authors"];
        $year = $row["year"];
        $title = $row["title"];
        $rating = $row["rating"];
        $image = $row["image"];
        $numb = $row["numb"];
//  }
}

  if(isset($_POST["changes"])){
    $bid = $_POST["edit"];
    $authors = $_POST["author"];
    $year = $_POST["year"];
    $title = $_POST["title"];
    $rating = $_POST["rating"];
    $image = $_POST["image"];
    $numb = $_POST["numb"];
    $queryStr = "UPDATE Books SET authors='{$authors}', title='{$title}', rating= {$rating}, image='{$image}', numb = {$numb} WHERE BID={$bid};";
    $db->sql->query($queryStr);
  //  header("Location: browse.php");
    //exit;

  }
}




?>
<!DOCTYPE html>
<html>

<head>
    <title> Edit Book</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="background.css">
</head>

<body>
  <center><h2>Edit Book </h2><center>

      <form action="editbook.php" method="post" style="border:1px solid #ccc">
        <div class="container">

          <label for="title"><b>Title</b></label>
          <input type="text" class="form-control" value="<?php echo $title; ?>" name="title" required>
          <br>
          <label for="author"><b>Authors</b></label>
          <input type="text" class="form-control" value="<?php echo $authors; ?>" name="author" required>
          <br>
          <label for="year"><b>Year Published</b></label>
          <input type="text" class="form-control" value="<?php echo $year;?>" name="year" required>
          <br>
          <label for="rating"><b>Rating</b></label>
          <input type="text" class="form-control" value="<?php echo $rating; ?>" name="rating" required>
          <br>
          <label for="numb"><b>Number Available</b></label>
          <input type="text" class="form-control" value="<?php echo $numb; ?>" name="numb" required>
          <br>
          <label for="image"><b>Image Path</b></label>
          <input type="text" class="form-control" value="<?php echo $image; ?>" name="image" required>
          <br>
          <input type="hidden" name="edit" id="hiddenField" value="<?php echo $bid; ?>" />
          <input type="hidden" name="changes" id="hiddenField" />
          <div class="clearfix">
            <button type="button" onclick="window.location.href = 'browse.php';" class="btn btn-primary">Cancel</button>
            <button type="submit" name="changeinfo" class="btn btn-primary">Submit</button>
            <br>
            <br>
          </div>
        </div>
      </form>
