<?php
if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	 require_once("../../db/db.php");
  $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if(isset($_POST["page"])){
		$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		if(!is_numeric($page_number)){die('Invalid page number!');}
	}else{ $page_number = 1;	}

	$item_per_page = 10;

  $results = $db_connection->query("SELECT COUNT(*) FROM customer");

	$get_total_rows = $results->fetch_row();

	$total_pages = ceil($get_total_rows[0]/$item_per_page);
	$page_position = (($page_number-1) * $item_per_page);
  $results = $db_connection->prepare("SELECT CustomerID, Name, Email, Phone, Address, DoB, Gender FROM customer LIMIT $page_position, $item_per_page");

	$results->execute();
	$results->bind_result($c_id, $c_name, $c_email, $c_phone, $c_address, $dob, $gender);

	echo "<div class='content-table table-responsive'>";
	echo "<table id='content-table' class='table table-striped table-hover'>
  				<thead>
          <tr>
            <th class='text-center'>#</th>
            <th class='text-center'>Customer ID</th>
            <th class='text-center'>Customer Name</th>
            <th class='text-center'>Email</th>
            <th class='text-center'>Phone</th>
            <th class='text-center'>Address</th>
            <th class='text-center'>Date of Birth</th>
            <th class='text-center'>Gender</th>
          </tr>
        </thead>
    		<tbody>";

        $counter = 0;
        if($page_number>1) $counter = ($item_per_page*($page_number-1)) + $counter;
      	while($results->fetch()){
            $counter++;
            $dob = get_dob($dob);
      			echo "<tr>";
            echo "<td class='text-center'>$counter</td>";
           	echo "<td class='text-center'>000$c_id</td>";
            echo "<td class='text-center'>$c_name</td>";
            echo "<td class='text-center'>$c_email</td>";
            echo "<td class='text-center'>$c_phone</td>";
            echo "<td class='text-center'>$c_address</td>";
            echo "<td class='text-center'>$dob</td>";
            echo "<td class='text-center'>$gender</td>";
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

	function get_dob($dob){
    	$dstring = explode("-", $dob);
      return $dstring[2]."/".$dstring[1]."/".$dstring [0];
	}

?>
