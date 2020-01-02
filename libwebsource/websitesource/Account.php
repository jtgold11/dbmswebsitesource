<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 *
 */
 //Accounts is 1 = admin , 2 = librarian, 3 = user
class Account
{
  //account class that hold user info
  public $email = "";
  public $username = "";
  private $password = "";
  private $userId = 1;
  private $accountType = 0;
  public $fines = 1.0;

  public function __construct()
  {
    $this->db = new Database();
  }

public function __destruct() {

  }
//returns password
  public function getPasshash(){
    return $this->password;
  }

  public function getID(){
    return $this->userId;
  }
  public function getAccT(){
    return $this->accountType;
  }
  //loads the user and returns an account object
  public function loaduser($userN){
    $queryStr = "";
    $queryStr = "SELECT * FROM User WHERE username ='{$userN}';";
    $qresult  = $this->db->sql->query($queryStr);
    $user = new Account();
    if ($qresult && $qresult->num_rows > 0) {
          $row = $qresult->fetch_assoc();
          $user->username = $row["username"];
          $user->password = $row["password"];
          $user->email = $row["email"];
          $user->userId = $row["UID"];
          $user->accountType = $row["accType"];
          $user->fines = $row["fines"];
          return $user;

  }
  else{
    return false;
  }
}
  public function checkPass($pass){

  }






}

 ?>
