<?php
class UpdateProduct {
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
  private     $p_id             = "";
  private     $p_old_img        ="";
	public 		$errors = array();
	public  $messages = array();

	public function __construct() {
      if (isset($_POST["updateProduct"])) {
          $this->updateProduct();
      }
    }
    private function updateProduct(){
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
			}else{
        $this->p_id = $_GET['p_id'];
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

        $query = $this->db_connection->query("SELECT PImage FROM product WHERE ProductID=".$this->p_id)->fetch_object();
        $this->p_old_img = $query->PImage;

        if($_FILES['p_image']['size'] == 0){
          $this->p_image = $this->p_old_img;
          echo "unchanged image";
        }

			$query_update = $this->db_connection->query("UPDATE product SET PName = '$this->p_name', BrandName = '$this->brandName', Color = '$this->p_color', PDescription = '$this->p_description',
						 InStock = '$this->inStock', Price = '$this->p_price', PImage = '$this->p_image', CategoryID = '$this->cat_id', SupplierID = '$this->supp_id' WHERE ProductID = $this->p_id");

			if ($query_update) {
        if($_FILES['p_image']['size'] != 0){
          unlink("productimages"."/".$this->p_old_img);
          move_uploaded_file($_FILES['p_image']['tmp_name'],"productimages"."/".$this->p_image);
          echo "move filed. Filed Deleted";
        }
        $this->messages[] = "Product Updated!";
        header("location: product.php");
        } else {
            $this->errors[] = "Upload Error, Try Again.";
        }
			}

		}
    }

}
