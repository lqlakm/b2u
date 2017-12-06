<?php
    require_once("db/db.php");
    require_once("classes/Cart.php");
    $cart = new Cart();
    if(session_id() == '') {session_start();}
    $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $cat_query = $db_connection->query("SELECT * FROM category");
    $qty = $cart->get_total_qty();
?>

<nav id="custom-bootstrap-menu" class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder">
                    <span class="sr-only" >Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Brought 2 U</a>
            </div>

            <div class="collapse navbar-collapse navbar-menubuilder">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a id="nav-home" href="index.php">
                          <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                          &nbsp; Home
                        </a>
                    </li>

                    <li class="dropdown dd-category">
                        <a id="nav-shop" href="shop.php" class="dropdown"><span class="glyphicon glyphicon-tags" aria-hidden="true"></span>&nbsp; Shop
                           <i id="dropdown-cat-icon" class="fa fa-caret-down" aria-hidden="true"></i></a>
                        <ul class="dropdown-menu" id="dropdown-catagory">
                            <?php
                                while($row = mysqli_fetch_array($cat_query)){
                                    echo "<li>";
                                    echo "<a href='shop.php#categoryID-".$row['CategoryID']."'>".$row['CategoryName']."</a>";
                                    echo "</li>";
                                }
                            ?>
                        </ul>
                    </li>

                    <li>
                        <a id="nav-cart" href="view_cart.php">
                          <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
                                &nbsp; Cart&nbsp;
                          <span class="badge"><?php if($qty>0) echo $qty;  ?></span>
                        </a>
                    </li>

                    <li>
                        <a id="nav-acc" href="account.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                          &nbsp; My Account
                        </a>
                    </li>

                    <li>
                        <a id="nav-about" href="about.php"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>&nbsp; About Us
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
