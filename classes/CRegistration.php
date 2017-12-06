<?php
class CRegistration {

    private     $db_connection           = null;

    private     $c_name                  = "";
    private     $c_email                 = "";
    private     $c_password              = "";
    private     $c_phone                 = "";
    private     $c_address               = "";
    private     $c_dob                   = "";
    private     $c_gender                = "";

    public      $registration_successful    = false;
    public      $errors                     = array();
    public      $messages                   = array();
    

    public function __construct() {
        
            if (isset($_POST["register"])) {
                
                $this->registerNewCustomer();
                
            }        
    }
    private function registerNewCustomer() {
        
        if (empty($_POST['c_name'])) {
            $this->errors[] = "Empty Name";
        } elseif (empty($_POST['c_password_new']) || empty($_POST['c_password_repeat'])) {
            $this->errors[] = "Empty Password";            
        } elseif ($_POST['c_password_new'] !== $_POST['c_password_repeat']) {
            $this->errors[] = "Password and password repeat are not the same";
        } elseif (strlen($_POST['c_password_new']) < 6) {
            $this->errors[] = "Password has a minimum length of 6 characters";            
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
        } elseif (!empty($_POST['c_name'])
                  && strlen($_POST['c_name']) <= 100
                  && strlen($_POST['c_name']) >= 2
                  && !empty($_POST['c_email'])
                  && strlen($_POST['c_email']) <= 64
                  && filter_var($_POST['c_email'], FILTER_VALIDATE_EMAIL)
                  && !empty($_POST['c_password_new']) 
                  && !empty($_POST['c_password_repeat']) 
                  && ($_POST['c_password_new'] === $_POST['c_password_repeat'])) {

            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if (!$this->db_connection->connect_errno) {

                $this->c_name            = $this->db_connection->real_escape_string(htmlentities($_POST['c_name'], ENT_QUOTES));
                $this->c_email           = $this->db_connection->real_escape_string(htmlentities($_POST['c_email'], ENT_QUOTES));
                $this->c_phone           = $this->db_connection->real_escape_string(htmlentities($_POST['c_phone'], ENT_QUOTES));
                $this->c_address         = $this->db_connection->real_escape_string(htmlentities($_POST['c_address'], ENT_QUOTES));
                $this->c_dob             = $this->db_connection->real_escape_string(htmlentities($_POST['c_dob'], ENT_QUOTES));
                $this->c_email           = $this->db_connection->real_escape_string(htmlentities($_POST['c_email'], ENT_QUOTES));
                $this->c_gender          = $this->db_connection->real_escape_string(htmlentities($_POST['c_gender'], ENT_QUOTES));
                
                $this->c_password = $_POST['c_password_new'];

                $query_check_email = $this->db_connection->query("SELECT * FROM customer WHERE Email = '".$this->c_email."';");

                if (mysqli_num_rows($query_check_email) > 0) {
                    $this->errors[] = "Sorry, that user email is already used.<br/>Please choose another one.";
                } else {
                    $query_new_customer_insert = $this->db_connection->query("INSERT INTO customer (Name, Password, Email, Phone, Address, DoB, Gender) 
                        VALUES('".$this->c_name."', '".$this->c_password."','".$this->c_email."','".$this->c_phone."','".$this->c_address."','".$this->c_dob."', '".$this->c_gender."');");

                    if ($query_new_customer_insert) {
                        $this->messages[] = "Your account has been created successfully. You can now log in.";
                        $this->registration_successful = true;

                    } else {

                        $this->errors[] = "Sorry, your registration failed. Please go back and try again.";

                    }
                }
            } else {
                $this->errors[] = "Sorry, no database connection.";
            }
        } else {
            $this->errors[] = "An unknown error occured.";
        }
        
    }

}