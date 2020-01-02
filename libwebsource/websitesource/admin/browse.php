<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../Database.php';
require_once '../LoginHandle.php';
require_once '../Account.php';
LoginHandler::CheckPrivilege(1);
//variable to see which page the user is on
$pagenum = 0;
//how many books are displayed per page
$perpage = 23;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(isset($_POST["pagenum"])){
    $pagenum = $_POST["pagenum"];
  }
}
//books id start at 1 so the first page would have one less than other pages without this
if($pagenum == 0){
  $perpage = 24;
}
$db = new Database();
?>
<!DOCTYPE html>
<html>
<head>
<?php // get the current page number > ?>
  <center><h2> Browse Books: Page <?php echo ($pagenum + 1);?></h2></center>
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
<style>
.dash{

   position:fixed;
   right:10px;
   top:5px;
   background-color: #000001;
   border: none;
   color: white;
   padding: 12px 28px;
   text-align: center;
   text-decoration: none;
   display: inline-block;
   font-size: 14px;
   margin:2px 2px;
   cursor: pointer;
}
</style>

<style>
.next{

   position:fixed;
   right:10px;
   bottom:5px;
   background-color: #000001;
   border: none;
   color: white;
   padding: 12px 28px;
   text-align: center;
   text-decoration: none;
   display: inline-block;
   font-size: 14px;
   margin:2px 2px;
   cursor: pointer;
}
</style>
<style>
.back{

   position:fixed;
   right:100px;
   bottom:5px;
   background-color: #000001;
   border: none;
   color: white;
   padding: 12px 28px;
   text-align: center;
   text-decoration: none;
   display: inline-block;
   font-size: 14px;
   margin:2px 2px;
   cursor: pointer;
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
<body>

  <?php
//get the books for the current page
$queryStr = "SELECT * FROM Books WHERE BID BETWEEN ({$pagenum} * {$perpage}) AND ({$pagenum} * {$perpage} + {$perpage});";
$qresult = $db->sql->query($queryStr);
$bid = $avail = 0;
$authors = $year = $title = $rating = $image = "";
//get all the books from the array and print them
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

//if the book is available is goes this color. If not it goes the next color
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
?>
  <form action="browse.php" method="post">
    <input type="hidden" name="pagenum" id="hiddenField" value="<?php echo $pagenum + 1; ?>" />
    <button type="submit" name="changeinfo" class="next">Next</button>
  </form>
    <form action="browse.php" method="post">
      <input type="hidden" name="pagenum" id="hiddenField" value="<?php echo $pagenum - 1; ?>" />
      <button type="submit" name="changeinfo" class="back">Back</button>
    </form>
    <a href="welcome.php" class="dash">Dashboard</a>

</body>
</html>
