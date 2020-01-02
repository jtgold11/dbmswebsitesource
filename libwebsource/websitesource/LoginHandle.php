
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'Database.php';
require_once 'Account.php';

class LoginHandler {
    /**
     * End the current session.
     *
     * RETURNS: Nothing
     */
     //shows a button that allows you to logout
     public static function Button(){
       ?>
       <!DOCTYPE html>
       <html>

       <head>
           <title> Login Page </title>

           <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
               integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

           <link rel="stylesheet" href="background.css">
       </head>
       <style>
       .logoutLblPos{

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
       <a href="../logout.php" class="logoutLblPos">Logout</a>
       </html>
       <?php
     }
     //logouts the user
    public static function Logout() {
      session_start();
        session_destroy();
        $_SESSION = array();
        header("Location: /index.php");
        exit;
    }
    //if the user tried to access with no permission
    public static function Logout1() {
      session_start();
        session_destroy();
        $_SESSION = array();
        header("Location: /nopermiss.php");
        exit;
    }


  //if logged on the you are good
    public static function IsLoggedIn() {
        if (session_id() == '') {
            session_start();
        }

        return isset($_SESSION["loggedin"]);
    }

//returns the account type
    public static function GetCurrentAccountType() {
        if (session_id() == '') {
            session_start();
        }

        if (isset($_SESSION["accountType"]))
            return $_SESSION["accountType"];
        else
            return false;
    }
//returns the username of the session
    public static function GetCurrentUsername() {
        if (session_id() == '') {
            session_start();
        }

        if (isset($_SESSION["username"]))
            return $_SESSION["username"];
        else
            return false;
    }
//checks if the user has access to the given webpage
    public static function CheckPrivilege($requiredAccType) {
        if (!self::IsLoggedIn()) {
            header("Location: /index.php");
            exit;
        }
          if (self::GetCurrentAccountType() != $requiredAccType) {
           self::Logout1();
         }
    }
//
//     // Members
//     //
    public $username;
    public $password;
    public $accountType;
    protected $db;

     //creates a login handler object
    public function __construct($username_, $passwd) {
        $this->db = new Database();
        $this->username = $username_;
        $this->password = $passwd;
    }

    public function __destruct() {
    }

//not really ever used. Was a helper function for login.
    public function AreCredentialsValid() {
        $isValid = false;
        $queryStr = "";


        $queryStr = "SELECT password FROM User WHERE username='{$this->username}';";
        $result = $this->db->sql->query($queryStr);


        if ($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $passwdHash = $row["password"];
            if($this->password == $passwdHash){
              $isValid = true;
            }
            $result->free();
        }

        return $isValid;
    }

//log the user on
    public function Login() {
        if ($this->AreCredentialsValid()) {
            if (session_id() == '') {
                session_start();
            }

            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $this->username;
            $queryStr = "SELECT accType FROM User WHERE username='{$this->username}';";

            // make the query
            $result = $this->db->sql->query($queryStr);

            // if there is one user associated with the result the login
            if ($result && $result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $this->accountType = $row["accType"];
              }
            $_SESSION["accountType"] = $this->accountType;
                return true;
            }


        return false;
    }

 }

?>
