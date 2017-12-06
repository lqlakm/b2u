<?php
class CLogin {

    private     $db_connection           = null;

    private     $c_name                  = "";
    private     $c_email                 = "";
    private     $c_password              = "";

    private     $customer_is_logged_in      = false;
    public      $errors                     = array();
    public      $messages                   = array();

    public function __construct() {
        session_start();
        if (isset($_GET["logout"])) {
            $this->doLogout();
        }
        elseif (!empty($_SESSION['c_name']) && ($_SESSION['customer_logged_in'] == 1)) {
            $this->loginWithSessionData();
        } elseif (isset($_POST["login"])) {
                $this->loginWithPostData();
        }
    }
    private function loginWithSessionData() {
        $this->customer_is_logged_in = true;
    }


    private function loginWithPostData() {
        if (!empty($_POST['c_email']) && !empty($_POST['c_password'])) {
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if (!$this->db_connection->connect_errno) {
                $this->c_email = $_POST['c_email'];

                $checklogin = $this->db_connection->query("SELECT * FROM customer WHERE Email = '".$this->c_email."';");

                if (mysqli_num_rows($checklogin) > 0) {

                    $result_row = $checklogin->fetch_object();

                    if ($_POST['c_password'] == $result_row->Password) {

                        $_SESSION['c_id'] = $result_row->CustomerID;
                        $_SESSION['c_name'] = $result_row->Name;
                        $_SESSION['c_email'] = $result_row->Email;
                        $_SESSION['customer_logged_in'] = 1;
                        $this->customer_is_logged_in = true;

                    } else {

                        $this->errors[] = "Wrong password. Try again.";
                    }
                } else {
                    $this->errors[] = "This user does not exist.";
                }
            } else {
                $this->errors[] = "Database connection problem.";
            }

        } elseif (empty($_POST['c_email'])) {
            $this->errors[] = "Email field was empty.";

        } elseif (empty($_POST['c_password'])) {
            $this->errors[] = "Password field was empty.";
        }
    }
    public function doLogout() {
            $_SESSION = array();
            session_destroy();
            $this->customer_is_logged_in = false;
            $this->messages[] = "You have been logged out.";
    }

    public function isCustomerLoggedIn() {
        return $this->customer_is_logged_in;
    }

}
