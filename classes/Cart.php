<?php
class Cart
{
    private $db_connection;

    public function __construct()
    {
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }

    public function __destruct()
    {
        $this->db_connection->close();
    }

    public function add_to_cart($p_id)
    {
        $_SESSION['order_finished'] = 0;
        $_SESSION['cart'][$p_id] = 1 + (isset($_SESSION['cart'][$p_id]) ? $_SESSION['cart'][$p_id] : 0);
    }

    public function remove_one($p_id)
    {
        $one_total = $_SESSION['cart'][$p_id];
        if ($one_total==1) {
            foreach ($_SESSION["cart"] as $k => $v) {
                if ($p_id == $k) {
                    unset($_SESSION["cart"][$k]);
                }
                if (empty($_SESSION["cart"])) {
                    unset($_SESSION["cart"]);
                }
            }
        } else {
            $_SESSION['cart'][$p_id] = (isset($_SESSION['cart'][$p_id]) ? $_SESSION['cart'][$p_id] : 0) - 1;
        }
    }

    public function remove_item($p_id)
    {
        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION["cart"] as $k => $v) {
                if ($p_id == $k) {
                    unset($_SESSION["cart"][$k]);
                }
                if (empty($_SESSION["cart"])) {
                    unset($_SESSION["cart"]);
                }
            }
        }
    }

    public function get_total_qty()
    {
        $q = 0;
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $qty) {
                $q += $qty;
            }
        }
        return $q;
    }

    public function empty_cart()
    {
        unset($_SESSION['cart']);
    }

    public function get_one_total($p_id)
    {
        $query = $this->db_connection->query("SELECT PName, price FROM product WHERE ProductID='$p_id'");
        $result = $query->fetch_object();
        return $result->price * $_SESSION['cart'][$p_id];
    }

    public function get_total()
    {
        $total = 0;
        foreach ($_SESSION['cart'] as $id => $qty) {
            $result = $this->db_connection->query("SELECT ProductID, PName, price FROM product WHERE ProductID='$id'");
            $row = mysqli_fetch_assoc($result);
            $total += $row['price'] * $qty;
        }
        return $total;
    }
}
