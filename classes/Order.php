<?php
class Order {

    private     $db_connection           = null;

    private     $c_name                  = "";
    private     $c_address               = "";
    private     $d_date              = "";
    private     $today                 = "";

    public      $order_success              = false;
    public      $errors                     = array();
    public      $messages                   = array();

    public function __construct() {
      $_SESSION['order_finished'] = 0;
            if (isset($_POST["checkout"]))
                $this->makeneworder();
    }
    private function makeneworder() {
        if (empty($_POST['c_address'])) {
            $this->errors[] = "Empty Address";
        } elseif (empty($_POST['d_date'])) {
            $this->errors[] = "Empty date";
        } else {
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if (!$this->db_connection->connect_errno) {
                $this->c_address        = $this->db_connection->real_escape_string(htmlentities($_POST['c_address'], ENT_QUOTES));
                $this->d_date           = $this->db_connection->real_escape_string(htmlentities($_POST['d_date'], ENT_QUOTES));;

                $c_id = $_SESSION['c_id'];
                $order_id = 0;

                $query_order_insert = $this->db_connection->query("INSERT INTO productorder (CustomerID, Address, DeliveryDate, OrderDate)
                                                                    VALUES('".$c_id."', '".$this->c_address."','".$this->d_date."',now());");
                if ($query_order_insert) {
                    $order_id = mysqli_insert_id($this->db_connection);
                    $order_success = true;
                } else {
                   $this->errors[] = "Unknown error.";
                }
                foreach($_SESSION['cart'] as $id => $qty) {
                  $product_insert_sql = "INSERT INTO orderdetail (OrderID, ProductID, Qty) VALUES ($order_id,$id,$qty)";
                  mysqli_query($this->db_connection,$product_insert_sql);
                }
                $this->messages[] = "order success";
                unset($_SESSION['cart']);
                $_SESSION['prev_order_id']=$order_id;
                $_SESSION['order_finished']=1;
            } else {
                $this->errors[] = "Sorry, no database connection.";
            }
        }

    }
}
