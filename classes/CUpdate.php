<?php
class CUpdate
{
    private $db_connection           = null;

    private $c_name                  = "";
    private $c_email                 = "";
    private $c_password              = "";
    private $c_phone                 = "";
    private $c_address               = "";
    private $c_dob                   = "";
    private $c_gender                = "";
    public $errors                     = array();
    public $messages                   = array();

    public function __construct()
    {
        if (isset($_POST["update"])) {
            $this->updateCustomer();
        }

        if (isset($_POST["changePW"])) {
            $this->changePW();
        }
    }

    private function updateCustomer()
    {
        if (empty($_POST['c_name'])) {
            $this->errors[] = "Empty Name";
        } elseif (strlen($_POST['c_name']) > 64 || strlen($_POST['c_name']) < 2) {
            $this->errors[] = "Username cannot be shorter than 2 or longer than 64 characters";
        } elseif (empty($_POST['c_email'])) {
            $this->errors[] = "Email cannot be empty";
        } elseif (strlen($_POST['c_email']) > 64) {
            $this->errors[] = "Email cannot be longer than 64 characters";
        } elseif (!filter_var($_POST['c_email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Your email adress is not in a valid email format";
        } elseif (empty($_POST['c_phone'])) {
            $this->errors[] = "Phone cannot be empty";
        } elseif (empty($_POST['c_address'])) {
            $this->errors[] = "Address cannot be empty";
        } elseif (strlen($_POST['c_name']) <= 100
                  && strlen($_POST['c_name']) >= 2
                  && !empty($_POST['c_email'])
                  && strlen($_POST['c_email']) <= 64
                  && filter_var($_POST['c_email'], FILTER_VALIDATE_EMAIL)) {
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if (!$this->db_connection->connect_errno) {
                $this->c_name            = $this->db_connection->real_escape_string(htmlentities($_POST['c_name'], ENT_QUOTES));
                $this->c_email           = $this->db_connection->real_escape_string(htmlentities($_POST['c_email'], ENT_QUOTES));
                $this->c_phone           = $this->db_connection->real_escape_string(htmlentities($_POST['c_phone'], ENT_QUOTES));
                $this->c_address         = $this->db_connection->real_escape_string(htmlentities($_POST['c_address'], ENT_QUOTES));
                $this->c_dob             = $this->db_connection->real_escape_string(htmlentities($_POST['c_dob'], ENT_QUOTES));
                $this->c_email           = $this->db_connection->real_escape_string(htmlentities($_POST['c_email'], ENT_QUOTES));
                $this->c_gender          = $this->db_connection->real_escape_string(htmlentities($_POST['c_gender'], ENT_QUOTES));

                $this->c_id = $_SESSION['c_id'];

                $checkemail = $this->db_connection->query("SELECT * FROM customer WHERE Email = '".$this->c_email."';");
                if (mysqli_num_rows($checkemail) > 0 && $_SESSION['c_email'] != $this->c_email) {
                    $this->errors[] = "Sorry, <b>".$this->c_email."</b> is not available. Try Again!";
                } else {
                    $query_update = $this->db_connection->query("UPDATE customer SET Name = '$this->c_name', Email = '$this->c_email', Phone = '$this->c_phone', Address = '$this->c_address', DoB = '$this->c_dob', Gender = '$this->c_gender' WHERE CustomerID = $this->c_id");
                    if($query_update) $this->messages[] = "Account Information Updated!";
                }
            } else {
                $this->errors[] = "Sorry, no database connection.";
            }
        } else {
            $this->errors[] = "An unknown error occured.";
        }
    }


    private function changePW(){
      if (!empty($_POST['c_pw']) && ($_POST['c_pw']==$_POST['c_repw'])) {
          $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

          $this->c_id = $_SESSION['c_id'];
          $c_pw = $this->db_connection->real_escape_string(htmlentities($_POST['c_pw'], ENT_QUOTES));

          $query_update = $this->db_connection->query("UPDATE customer SET Password = '$c_pw' WHERE CustomerID = $this->c_id");
      }
    }
}
