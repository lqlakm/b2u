<?php
if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

		require_once("../db/db.php");
    $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $searchKey = $_POST["searchKey"];
    $originalKey = $searchKey;
    $searchKey = trim($searchKey);
    $searchArray = "";

    if(strpos($searchKey,' ')!==false){
    	$ArrTemp=explode(" ", $searchKey);
    	foreach ($ArrTemp as $v) {
    		$searchArray[] = "'%".$db_connection->real_escape_string($v)."%'";
    	}
    	$searchKey=implode(' AND PName LIKE ', $searchArray);
    }else{
    	$searchKey = "'%".$searchKey."%'";
    }

	if(isset($_POST["page"])){
		$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		if(!is_numeric($page_number)){die('Invalid page number!');}
	}else{$page_number = 1;}
	$item_per_page = 9;

	$results = $db_connection->query("SELECT COUNT(*) FROM product where PName like {$searchKey}");
	$get_total_rows = $results->fetch_row();

	$total_pages = ceil($get_total_rows[0]/$item_per_page);
	$page_position = (($page_number-1) * $item_per_page);

	$results = $db_connection->prepare("SELECT ProductID, PName, PImage, Price FROM product where PName like $searchKey LIMIT $page_position, $item_per_page");
	$results->execute();
	$results->bind_result($id, $name,$image, $price);

	echo "<div class='well row invisible-well'>";
	echo "<ol class='breadcrumb'>
  				<li><h4><i class='fa fa-search'></i>Search Results</h4></li>
				</ol>";

	if($total_pages<1) echo "<div class='alert alert-info'>No search results for &ldquo;$originalKey&rdquo;.</div>";
			while($results->fetch()){
							$p_id = $id;
							$p_image = 'admin/productimages/'.$image;
		          $p_name = $name;
		          $p_price = $price;

							echo "<div class='col-sm-6 col-md-4'><div class='thumbnail'>";
		          echo "<img src='$p_image'/>";
		         	echo "<div class='caption'>";
		          echo "<h5><a href='product.php?p_id=$p_id'>".$p_name."</a></h5>";
		          echo "<a class='btn btn-default btn-sm' role='button' onClick='add_to_cart($p_id)' onfocus='this.blur()'>Add to Cart</a>";
		          echo "</p> $ ".$p_price."</p>";
		          echo "</div></div></div>";
			}
	echo '</div><div align="center" class="custom-pagination">';
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
						$pagination .= '<li class="page-item">
															<a class="page-link" data-page="'.$previous_link.'"title="Previous" href="#">
				            						<i class="fa fa-caret-left" aria-hidden="true"></i>
				            					</a>
														</li>';
            for($i = ($current_page-2); $i < $current_page; $i++){
                if($i > 0){ $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="'.$i.'" title="Page '.$i.'">'.$i.'</a></li>';}
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
	            $pagination .= '<li class="page-item active">
																<span class="page-link" title="Current Page">'.$current_page.'</span>
															</li>';
	        }
	        for($i = $current_page+1; $i < $right_links ; $i++){
	            if($i<=$total_pages){$pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="'.$i.'" title="Page '.$i.'">'.$i.'</a></li>';}
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
?>
