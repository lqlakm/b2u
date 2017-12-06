<?php
class AddSupplier {
	private     $db_connection 		= null;
  private     $random 					= "";
	private     $today 						= "";

	private     $s_name 					= "";
	private     $s_phone  				= "";
	private     $s_email	 				= "";
	private     $s_address     		= "";
	public 		  $errors = array();
	public      $messages = array();

	public function __construct() {
      if (isset($_POST["addSupplier"])) {
          $this->addNewSupplier();
      }
    }
    private function addNewSupplier(){
    	$this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

		if (!$this->db_connection->connect_errno) {

			if(empty($_POST['s_name'])){
				$this->errors[] ="Empty Name";
			}else if(empty($_POST['s_phone'])){
				$this->errors[] ="Empty phone";
			}else if(empty($_POST['s_email'])){
				$this->errors[] ="Empty email";
			}else if(empty($_POST['s_address'])){
				$this->errors[] ="Empty address";
			}else{
				$this->s_name = $this->db_connection->real_escape_string(htmlentities($_POST['s_name'], ENT_QUOTES));
				$this->s_phone = $this->db_connection->real_escape_string(htmlentities($_POST['s_phone'], ENT_QUOTES));
				$this->s_email = $this->db_connection->real_escape_string(htmlentities($_POST['s_email'], ENT_QUOTES));
				$this->s_address = $this->db_connection->real_escape_string(htmlentities($_POST['s_address'], ENT_QUOTES));


			$query_insert = $this->db_connection->query("INSERT INTO supplier (SName, SPhone, SEmail, SAddress)
			 VALUES('".$this->s_name."', '".$this->s_phone."', '".$this->s_email."', '".$this->s_address."');");

			if ($query_insert) {
            $this->messages[] = "New Supplier Added!";
        } else {
            $this->errors[] = "Unknown Error, Try Again.";
        }
			}

		}
    }

}
