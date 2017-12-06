<?php

if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	 require_once("../../db/db.php");
  $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if(isset($_POST["page"])){
		$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		if(!is_numeric($page_number)){die('Invalid page number!');}
	}else{ $page_number = 1;	}

	$item_per_page = 10;

  $results = $db_connection->query("SELECT COUNT(*) FROM productorder");

	$get_total_rows = $results->fetch_row();

	$total_pages = ceil($get_total_rows[0]/$item_per_page);
	$page_position = (($page_number-1) * $item_per_page);
  $results = $db_connection->prepare("SELECT OrderID, CustomerID, Address, DeliveryDate, OrderDate, Status FROM productorder LIMIT $page_position, $item_per_page");

	$results->execute();
	$results->bind_result($order_id, $c_id, $address, $d_date, $o_date, $status);

	echo "<div class='content-table table-responsive'>";
	echo "<table id='content-table' class='table table-striped table-hover'>
  				<thead>
          <tr>
            <th class='text-center'>#</th>
            <th class='text-center'>Order No.</th>
            <th class='text-center'>Customer Name</th>
            <th class='text-center'>Delivery Address</th>
            <th class='text-center'>Phone</th>
            <th class='text-center'>Total Qty</th>
            <th class='text-center'>Total Price</th>
            <th class='text-center'>Delivery Date</th>
            <th class='text-center'>Order Date</th>
            <th class='text-center'>Status</th>
            <th >Mark as</th>
          </tr>
        </thead>
    		<tbody>";

        $counter = 0;
        if($page_number>1) $counter = ($item_per_page*($page_number-1)) + $counter;
      	while($results->fetch()){
            $counter++;
            $c_info = get_customer_info($c_id);
            $total = get_total($order_id);
            $d_date = get_date($d_date);
            $o_date = get_date($o_date);
            $p_info =  get_product_info($order_id);

      			echo "<tr>";
            echo "<td class='text-center'>$counter</td>";
           	echo "<td class='text-center'>000$order_id</td>";
            echo "<td class='text-center'>$c_info[0]</td>";
            echo "<td class='text-center'>$address</td>";
            echo "<td class='text-center'>$c_info[1]</td>";
            echo "<td class='text-center'>
                    <a href='#.' id='popover' data-content='$p_info' data-html='true' title='Order Information' onclick='popover()'>$total[1]</a>
                  </td>";
            echo "<td class='text-center'>$total[0] Ks.</td>";
            echo "<td class='text-center'>$d_date</td>";
            echo "<td class='text-center'>$o_date</td>";
            if($status == 0){
              echo "<td class='text-center'><span class='label label-warning'>Pending</span></td>";
              echo "<td><a href='orderstatus.php?orderID=$order_id&s=1'>Delivered</a></td>";
            }
            else{
              echo "<td class='text-center'><span class='label label-success'>Delivered</span></td>";
              echo "<td><a href='orderstatus.php?orderID=$order_id&s=0'>Undo</a></td>";
            }

            // data-toggle="popover" title="Popover Header" data-content="Some content inside the popover"
            echo "</tr>";
      	}
    	echo '</tbody></table></div>
            <div align="center" class="custom-pagination">';

    	echo paginate($item_per_page, $page_number, $get_total_rows[0], $total_pages);
    	echo '</div>';

	exit;
}
	function paginate($item_per_page, $current_page, $total_records, $total_pages)
	{
	    $pagination = '';
	    if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){
	        $pagination .= '<ul class="pagination">';

	        $right_links    = $current_page + 3;
	        $previous       = $current_page - 1;
	        $next 		    = $current_page + 1;
	        $first_link     = true;

	        if($current_page > 1){
				$previous_link = ($previous==0)? 1: $previous;
	            $pagination .= '<li class="page-item">
							      <a class="page-link" href="#" aria-label="First" data-page="1" title="First">
							        <i class="fa fa-caret-left" aria-hidden="true"></i><i class="fa fa-caret-left" aria-hidden="true"></i>
							      </a>
							    </li>';
				$pagination .= '<li class="page-item"><a class="page-link" data-page="'.$previous_link.'"title="Previous" href="#">
	            					<i class="fa fa-caret-left" aria-hidden="true"></i>
	            					</a></li>';
	                for($i = ($current_page-2); $i < $current_page; $i++){
	                    if($i > 0){
	                        $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="'.$i.'" title="Page '.$i.'">'.$i.'</a></li>';
	                    }
	                }
	            $first_link = false;
	        }
	        if($first_link){
	            $pagination .= '<li class="page-item active">
							      <span class="page-link" title="Current Page">'.$current_page.'</span>
							    </li>';
	        }elseif($current_page == $total_pages){
	            $pagination .= '<li class="page-item active">
							      <span class="page-link" title="Current Page">'.$current_page.'</span>
							    </li>';
	        }else{
	            $pagination .= '<li class="page-item active"><span class="page-link" title="Current Page">'.$current_page.'</span></li>';
	        }
	        for($i = $current_page+1; $i < $right_links ; $i++){
	            if($i<=$total_pages){
	                $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="'.$i.'" title="Page '.$i.'">'.$i.'</a></li>';
	            }
	        }
	        if($current_page < $total_pages){
					$next_link = $current_page+1;
					$pagination .= '<li class="page-item">
							      <a class="page-link" href="#" aria-label="Next" data-page="'.$next_link.'" title="Next">
							        <i class="fa fa-caret-right" aria-hidden="true"></i>
							      </a>
							    </li>';
	        		$pagination .= '<li class="page-item">
							      <a class="page-link" href="#" aria-label="Last" data-page="'.$total_pages.'" title="Last">
							        <i class="fa fa-caret-right" aria-hidden="true"></i><i class="fa fa-caret-right" aria-hidden="true"></i>
							      </a>
							    </li>';
	        }
	        $pagination .= '</ul>';
	    }
	    return $pagination;
	}

	function get_date($date){
    	$dstring = explode("-", $date);
      return $dstring[2]."/".$dstring[1]."/".$dstring [0];
	}

  function get_customer_info($c_id)
  {
    $info = array();
    $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $query = $db_connection->query("SELECT Name,Phone FROM customer WHERE CustomerID=".$c_id);
    $rows = $query->fetch_object();
    $info[] = $rows->Name;
    $info[] = $rows->Phone;
    return $info;
  }

  function get_total($order_id)
  {
    $info = array();
    $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $result = $db_connection->query("SELECT SUM(product.Price*orderdetail.Qty) as totalprice, SUM(orderdetail.Qty) as totalqty
                                      FROM orderdetail INNER JOIN product USING(ProductID) WHERE OrderID =".$order_id);
    $total = $result->fetch_row();
    $info[] =  $total[0];
    $info[] =  $total[1];
    return $info;
  }

  function get_product_info($order_id)
  {
    $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $query = $db_connection->query("SELECT PName, Qty, Price FROM `orderdetail` INNER JOIN product USING(ProductID) WHERE OrderID =".$order_id);

    $s="";
    while ($row = mysqli_fetch_array($query)) {
      $s = $s . $row['PName'] . " (".$row['Price']." Ks.) x ".$row['Qty']."<br/>" ;
    }
    return $s;
  }

?>
