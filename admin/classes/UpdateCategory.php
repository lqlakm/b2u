<?php
class UpdateCategory {
	private     $db_connection 		= null;
  private     $random 					= "";
	private     $today 						= "";

	private     $cat_name 			= "";
  private     $cat_id    			= "";
	private     $remark  				= "";
	public 		  $errors = array();
	public      $messages = array();

	public function __construct() {
      if (isset($_POST["updateCategory"])) {
          $this->updateCategory();
      }
    }
    private function updateCategory(){
    	$this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

		if (!$this->db_connection->connect_errno) {

			if(empty($_POST['cat_name'])){
				$this->errors[] ="Empty Category Name";
			}else{
        $this->cat_id = $_GET['categoryID'];
				$this->cat_name = $this->db_connection->real_escape_string(htmlentities($_POST['cat_name'], ENT_QUOTES));
				$this->remark = $this->db_connection->real_escape_string(htmlentities($_POST['remark'], ENT_QUOTES));

			$query_insert = $this->db_connection->query("UPDATE category SET CategoryName = '$this->cat_name', Remark = '$this->remark' WHERE CategoryID = $this->cat_id");

			if ($query_insert) {
            $this->messages[] = "Category Updated!";
						header("location: category.php");
        } else {
            $this->errors[] = "Unknown Error, Try Again.";
        }
			}

		}
    }

}
