<?php
class AddCategory {
	private     $db_connection 		= null;
  private     $random 					= "";
	private     $today 						= "";

	private     $cat_name 			= "";
	private     $remark  				= "";
	public 		  $errors = array();
	public      $messages = array();

	public function __construct() {
      if (isset($_POST["addcategory"])) {
          $this->addNewCategory();
      }
    }
    private function addNewCategory(){
    	$this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

		if (!$this->db_connection->connect_errno) {

			if(empty($_POST['cat_name'])){
				$this->errors[] ="Empty Category Name";
			}else{
				$this->cat_name = $this->db_connection->real_escape_string(htmlentities($_POST['cat_name'], ENT_QUOTES));
				$this->remark = $this->db_connection->real_escape_string(htmlentities($_POST['remark'], ENT_QUOTES));

			$query_insert = $this->db_connection->query("INSERT INTO category (CategoryName, Remark)
			 VALUES('".$this->cat_name."', '".$this->remark."');");

			if ($query_insert) {
            $this->messages[] = "New Category Added!";
        } else {
            $this->errors[] = "Unknown Error, Try Again.";
        }
			}

		}
    }

}
