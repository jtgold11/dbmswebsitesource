<br>
<div class="container text-center">
    <form action="search.php" method="POST">

<input type="text" class="form-control" placeholder="Search using keyword" name="sinput" required>
<br>
<select id="search" name="search">
<option value="0">Title</option>
<option value="1">Author</option>
<option value="2">ISBN</option>
<option value="3">Year</option>
<option value="4">Rating</option>
</select>
<br><br>
<button class="btn btn-primary" type="submit">Submit</button>
<a href="welcome.php" class="btn btn-primary">Back</a>
</form>
</div>
<br>

<?php
require_once '../Database.php';
require_once '../LoginHandle.php';
require_once '../Account.php';
$db = new Database();
LoginHandler::CheckPrivilege(2);
// if post then continue
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$sinput = $_POST["sinput"];
$val = $_POST["search"];
//this part is just saying what value from the dropdown box did the user submit then doing the corresponding query
if($val == 0){
$queryStr = "SELECT * FROM Books WHERE title LIKE CONCAT('%', '{$sinput}' , '%');";
}
else if($val == 1){
$queryStr = "SELECT * FROM Books WHERE authors LIKE CONCAT('%', '{$sinput}' , '%');";
}
else if($val == 2){
$queryStr = "SELECT * FROM Books WHERE ISBN LIKE CONCAT('%', '{$sinput}' , '%');";
}
else if($val == 3){
$queryStr = "SELECT * FROM Books WHERE year LIKE CONCAT('%', '{$sinput}' , '%');";
}
else if($val == 4){

$queryStr = "SELECT * FROM Books WHERE rating BETWEEN {$sinput} AND 5;";
}
//if more than one book then print all books
$qresult = $db->sql->query($queryStr);
if ($qresult && $qresult->num_rows > 0) {
  for($i = 0; $i <$qresult->num_rows; $i++){
      $row = $qresult->fetch_assoc();
      $bid = $row["BID"];
      $avail = $row["available"];
      $authors = $row["authors"];
      $year = $row["year"];
      $title = $row["title"];
      $rating = $row["rating"];
      $image = $row["image"];
      $numb = $row["numb"];

//if available print one color if not then print the other colors
  if($numb > 0){
  ?>
  <form action="selectbook.php" method="post">
    <input type="hidden" name="bide" id="hiddenField" value="<?php echo $bid; ?>" />
  <button type="submit" name = "sub" class="button2"><?php echo $title; ?><br> <?php echo $year;?><br><?php echo $authors; ?> <br> <img src="<?php echo $image; ?>" <br><br>
  <?php echo "Rating: " . $rating;?></button>
</form>
  <?php
}
  else{
    ?>
    <form action="selectbook.php" method="post">
      <input type="hidden" name="bide" id="hiddenField" value="<?php echo $bid; ?>" />
    <button type="submit" name = "sub" class="button"><?php echo $title; ?><br> <?php echo $year;?><br><?php echo $authors; ?> <br> <img src="<?php echo $image; ?>" <br><br>
    <?php echo "Rating: " . $rating;?></button>
  </form>
<?php
}
}
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

    <style>
    .button {
    background-color: #999999;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 8px 50px;
    cursor: pointer;
    max-width:12em;
    min-width: 12em;
    white-space:nowrap;
    overflow:hidden;
    }
    .button2 {
    background-color: #000000;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 8px 50px;
    cursor: pointer;
    max-width:12em;
    min-width: 12em;

    white-space:nowrap;
    overflow:hidden;
    }
    </style>
    <style type="text/css">
    form, table {
         display:inline;
         margin:0px;
         padding:0px;
    }
    </style>
  </head>

</html>
