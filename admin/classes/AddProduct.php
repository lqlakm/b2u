<?php
class AddProduct {
	private     $db_connection 		= null;
  private     $random 					= "";
	private     $today 						= "";

	private     $p_name 					= "";
	private     $brandName 				= "";
	private     $p_color	 				= "";
	private     $p_description		= "";
	private 		$inStock 					= "";
	private     $p_price 					= "";
	private     $supp_id 					= "";
	private     $cat_id 					= "";
	private     $p_image 					= "";
	public 		$errors = array();
	public  $messages = array();

	public function __construct() {
      if (isset($_POST["addProduct"])) {
          $this->addNewProduct();
      }
    }
    private function addNewProduct(){
    	$this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

		if (!$this->db_connection->connect_errno) {

			if(empty($_POST['p_name'])){
				$this->errors[] ="Empty Product";
			}else if(empty($_POST['brandName'])){
				$this->errors[] ="Empty brandName";
			}else if(empty($_POST['p_color'])){
				$this->errors[] ="Empty Color";
			}else if(empty($_POST['p_description'])){
				$this->errors[] ="Empty Description";
			}else if(empty($_POST['p_stock'])){
				$this->errors[] ="Empty Quantity Field";
			}else if(empty($_POST['p_price'])){
				$this->errors[] ="Empty Price Field";
			}else if($_POST['supp_id']==0){
				$this->errors[] ="Select One Supplier";
			}else if($_POST['cat_id']==0){
				$this->errors[] ="Select One Category";
			}else if(empty($_FILES['p_image'])){
				$this->errors[] ="Upload product image";
			}else{
				$this->random = round(microtime(true));

				$this->p_name = $this->db_connection->real_escape_string(htmlentities($_POST['p_name'], ENT_QUOTES));
				$this->brandName = $this->db_connection->real_escape_string(htmlentities($_POST['brandName'], ENT_QUOTES));
				$this->p_color = $this->db_connection->real_escape_string(htmlentities($_POST['p_color'], ENT_QUOTES));
				$this->p_description = $this->db_connection->real_escape_string(htmlentities($_POST['p_description'], ENT_QUOTES));
				$this->inStock = $this->db_connection->real_escape_string(htmlentities($_POST['p_stock'], ENT_QUOTES));
				$this->p_price = $this->db_connection->real_escape_string(htmlentities($_POST['p_price'], ENT_QUOTES));
				$this->supp_id = $this->db_connection->real_escape_string(htmlentities($_POST['supp_id'], ENT_QUOTES));
				$this->cat_id = $this->db_connection->real_escape_string(htmlentities($_POST['cat_id'], ENT_QUOTES));
				$this->p_image = "p_".$this->random;

			$query_insert = $this->db_connection->query("INSERT INTO product (PName, BrandName, Color, PDescription, InStock, Price, PImage, CategoryID, SupplierID)
			 VALUES('".$this->p_name."', '".$this->brandName."', '".$this->p_color."', '".$this->p_description."', '".$this->inStock."', '".$this->p_price."', '".$this->p_image."', '".$this->cat_id."', '".$this->supp_id."');");

			if ($query_insert) {
            move_uploaded_file($_FILES['p_image']['tmp_name'],"productimages"."/".$this->p_image);

            $this->messages[] = "Product Added!";
        } else {
            $this->errors[] = "Upload Error, Try Again.";
        }
			}

		}
    }

}
