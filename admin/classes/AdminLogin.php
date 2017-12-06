<?php
class AdminLogin {

    private     $db_connection           = null;

    private     $admin_name               = "";
    private     $admin_password           = "";

    private     $is_admin_logged_in      = false;
    public      $errors                     = array();
    public      $messages                   = array();

    public function __construct() {
        if(session_id() == '') {session_start();}
        if (isset($_GET["logout"])) {
            $this->doLogout();
        }
        elseif (!empty($_SESSION['admin_name']) && ($_SESSION['admin_logged_in'] == 1)) {
            $this->loginWithSessionData();
        } elseif (isset($_POST["admin_login"])) {
                $this->loginWithPostData();
        }
    }
    private function loginWithSessionData() {
        $this->is_admin_logged_in = true;
    }


    private function loginWithPostData() {
        if (!empty($_POST['admin_name']) && !empty($_POST['admin_password'])) {
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if (!$this->db_connection->connect_errno) {
                $this->admin_name = $_POST['admin_name'];

                $checklogin = $this->db_connection->query("SELECT * FROM admin WHERE name = '".$this->admin_name."';");

                if (mysqli_num_rows($checklogin) > 0) {

                    $result_row = $checklogin->fetch_object();

                    if ($_POST['admin_password'] == $result_row->password) {

                        $_SESSION['admin_id'] = $result_row->adminId;
                        $_SESSION['admin_name'] = $result_row->name;
                        $_SESSION['admin_logged_in'] = 1;
                        $this->is_admin_logged_in = true;

                    } else {

                        $this->errors[] = "Wrong password. Try again.";
                    }
                } else {
                    $this->errors[] = "This user does not exist.";
                }
            } else {
                $this->errors[] = "Database connection problem.";
            }

        } elseif (empty($_POST['admin_name'])) {
            $this->errors[] = "Name field was empty.";

        } elseif (empty($_POST['admin_password'])) {
            $this->errors[] = "Password field was empty.";
        }
    }
    public function doLogout() {
            $_SESSION = array();
            session_destroy();
            $this->is_admin_logged_in = false;
            $this->messages[] = "You have been logged out.";
    }

    public function isAdminLoggedIn() {
        return $this->is_admin_logged_in;
    }

}
