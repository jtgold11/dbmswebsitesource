
<?php
require_once '../Database.php';
require_once '../LoginHandle.php';
require_once '../Account.php';
$db = new Database();
$acc = new Account();
$user = $acc->loaduser(LoginHandler::GetCurrentUsername());
LoginHandler::CheckPrivilege(3);
$truthhold = false;
//if post continue
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //This is triggered when the user clicks on this page
  if(isset($_POST["reserve"])){
    //for some reason php made me set the time zone but otherwise
    // this just gets the current data and formats it for mysql
    date_default_timezone_set('America/New_York');
    $today = getdate();
    $month = $year = $mday = $newmday = "";
    $month =  $today["mon"];
    $year = $today["year"];
    $mday = $today["mday"];

    if($today["mday"] < 10){
    $newmday = "0" . $mday;}
    else{
    $newmday = $mday;}

    $date1 = $year . "-" . $month . "-" . $newmday;
    $bid = 0;
    $uid = 0;
    $bid = $_POST["bide"];
    $uid = $user->getID();
//inserintg a new value
    $queryStr1 = "INSERT INTO ResQueue(UID,dQueue,BID) VALUES({$uid},'{$date1}',{$bid});";
    $db->sql->query($queryStr1);
    $truthhold = true;


  }
  $bid = "";
  //this is triggered if user came from another page or clicked on this page
  if(isset($_POST["bide"])){
$bid = $_POST["bide"];
//get the book from the bid
$queryStr = "SELECT * FROM Books WHERE BID={$bid};";
$qresult = $db->sql->query($queryStr);
$bid = $avail = 0;
$authors = $year = $title = $rating = $image = "";
if ($qresult && $qresult->num_rows > 0) {
      $row = $qresult->fetch_assoc();
      $bid = $row["BID"];
      $avail = $row["available"];
      $authors = $row["authors"];
      $year = $row["year"];
      $title = $row["title"];
      $rating = $row["rating"];
      $image = $row["image"];
      $numb = $row["numb"];
}
}

?>

<!DOCTYPE html>
<html>
<head>
  <center><h2> <?php if($truthhold) {echo "Book Successfully Added To Waitlist";}?> <br>
    <?php echo $title ?></h2></center>
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
.imgst{
    position:absolute;
    height: 200px;
    width: 150px;
    left:30%;
    top:50%;
    margin-left:-296px; /*image width/2 */
    margin-top:-256px; /*image height/2 */
}
</style>
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
<style type="text/css">
form, table {
     display:inline;
     margin:0px;
     padding:0px;
}
</style>
</style>
</head>
<body>
  <img class="imgst" src = "<?php echo $image;?>">
  <center>
    Author: <?php echo $authors;?> <br>
    Year Published: <?php echo $year;?> <br>
    Rating: <?php echo $rating;?> <br>
    Number of Copies Available: <?php echo $numb;?>
  </br>
  <br>
    <form action="selectbook.php" method="post">
      <input type="hidden" name="bide" id="hiddenField" value="<?php echo $bid; ?>" />
      <button type="submit" name="reserve" class="button">Reserve Book</button>
    </form>
        <a href="browse.php" class="button">Back</a>



    <a href="welcome.php" class="dash">Dashboard</a>
  </center>
</body>
</html>



<?php
}
//}
















  ?>
