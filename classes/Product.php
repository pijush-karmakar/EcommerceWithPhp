<?php 

$filepath = realpath(dirname( __FILE__ ) );

 include_once ($filepath.'/../lib/Database.php');
 include_once ($filepath.'/../helpers/Format.php');

?>

<?php 
    
 class Product{ 
     private $db;
     private $fm;

	public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
	} 

/*
Product Insert function
--------------------------------------------- 
*/

public function productInsert( $data,$file ){
  
    $productName     = mysqli_real_escape_string($this->db->link,$data['productName']);
    $catId           = mysqli_real_escape_string($this->db->link,$data['catId']);
    $brandId         = mysqli_real_escape_string($this->db->link,$data['brandId']);
    $description     = mysqli_real_escape_string($this->db->link,$data['description']);
    $price           = mysqli_real_escape_string($this->db->link,$data['price']);
    $type            = mysqli_real_escape_string($this->db->link,$data['type']);


        $permited  = array( 'jpg','jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "upload/".$unique_image;

        if( $productName=="" ||  $catId=="" ||  $brandId=="" ||  $description=="" ||  $price=="" ||  $type=="" || $file_name=="" ){
        	$msg = '<div class="alert alert-danger"><strong>Error ! </strong>Field must not be empty</div>';
           return $msg ;
        }

        elseif ($file_size >1048567) {
	         $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Image Size should be less then 1MB!</div>';
             return $msg;
        }

         elseif (in_array($file_ext, $permited) === false) {
	         $msg = '<div class="alert alert-danger"><strong>Error ! </strong>You can upload only:-'
	         .implode(', ', $permited).'</div>';

             return $msg;
        }

        else{
        	move_uploaded_file($file_temp, $uploaded_image);
        	$query = "INSERT INTO tbl_product(productName,catId,brandId,description,price,image,type) 
        	VALUES( '$productName','$catId','$brandId','$description','$price','$uploaded_image','$type' ) ";

		        $insert_row = $this->db->insert($query);
		       if($insert_row){
		       	    $msg = '<div class="alert alert-success"><strong>Success ! </strong>Product Inserted Successfully</div>';
		       	    return $msg;
		       }
		       else{
		           $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Product Not Inserted .</div>';
		       	    return $msg;
		       }

        }


}


public function getAllProduct(){

   // Query with aliases----------
    
   $query = " SELECT p.*,c.catName,b.brandName FROM 
              tbl_product as p, tbl_category as c,tbl_brand as b
              WHERE p.catId = c.catId AND p.brandId = b.brandId 
              ORDER BY p.productId DESC " ;

   // $query = "SELECT tbl_product.* , tbl_category.catName , tbl_brand.brandName
   //           FROM tbl_product
   //           INNER JOIN  tbl_category ON tbl_product.catId = tbl_category.catId
   //           INNER JOIN  tbl_brand    ON tbl_product.brandId = tbl_brand.brandId

   //           ORDER BY tbl_product.productId DESC";

   $result = $this->db->select($query);
   return $result;

}

/*
Product Update function
--------------------------------------------- 
*/

public function getProductById($id){
     $query = "SELECT *FROM tbl_product WHERE productId='$id' ";
     $result = $this->db->select($query);
     return $result;
}

public function productUpdate( $data,$file,$id ) {

    $productName     = mysqli_real_escape_string($this->db->link,$data['productName']);
    $catId           = mysqli_real_escape_string($this->db->link,$data['catId']);
    $brandId         = mysqli_real_escape_string($this->db->link,$data['brandId']);
    $description     = mysqli_real_escape_string($this->db->link,$data['description']);
    $price           = mysqli_real_escape_string($this->db->link,$data['price']);
    $type            = mysqli_real_escape_string($this->db->link,$data['type']);


        $permited  = array( 'jpg','jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "upload/".$unique_image;

        if( $productName=="" ||  $catId=="" ||  $brandId=="" ||  $description=="" ||  $price=="" ||  $type==""){
          $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Field must not be empty</div>';
           return $msg ;
        }

        else{

            if(!empty($file_name) ){ 

                   if ($file_size >1048567) {
                   $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Image Size should be less then 1MB!</div>';
                     return $msg;
                       }

                  elseif (in_array($file_ext, $permited) === false) {
                   $msg = '<div class="alert alert-danger"><strong>Error ! </strong>You can upload only:-'
                   .implode(', ', $permited).'</div>';

                     return $msg;
                       }

                  else{
                      move_uploaded_file($file_temp, $uploaded_image);
                      
                      $query = "UPDATE  tbl_product SET 
                           productName    = '$productName',
                           catId          = '$catId',
                           brandId        = '$brandId',
                           description    = '$description',
                           price          = '$price',  
                           image          = '$uploaded_image',
                           type           =  '$type' WHERE productId = '$id'  ";


                       $update_row = $this->db->update($query);
                       if($update_row){
                            $msg = '<div class="alert alert-success"><strong>Success ! </strong>Product Updated Successfully</div>';
                            return $msg;
                       }
                       else{
                           $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Product Not Updated .</div>';
                            return $msg;
                       }

                  }

             } else{
                    $query = "UPDATE  tbl_product SET 
                           productName    = '$productName',
                           catId          = '$catId',
                           brandId        = '$brandId',
                           description    = '$description',
                           price          = '$price', 
                           type           =  '$type' WHERE productId = '$id'  ";


                       $update_row = $this->db->update($query);
                       if($update_row){
                            $msg = '<div class="alert alert-success"><strong>Success ! </strong>Product Updated Successfully</div>';
                            return $msg;
                       }
                       else{
                           $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Product Not Updated .</div>';
                            return $msg;
                       } 
             }

      }

}


/*
Product Delete function
--------------------------------------------- 
*/

public function delProductById($id){

   $getquery = "SELECT * FROM tbl_product WHERE productId='$id'  ";
   $getdata = $this->db->select($getquery);

   if($getdata){
      while( $delimg = $getdata->fetch_assoc() ){
         $dellink = $delimg['image'];
         unlink($dellink);            
      }
   }

   $query = "DELETE FROM tbl_product WHERE productId='$id'  ";
   $deldata = $this->db->delete($query);
   
   if( $deldata ){
      $msg = '<div class="alert alert-success"><strong>Success ! </strong>Product Deleted Successfully</div>';
      return $msg;
   }
   else{
           $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Product Not Deleted .</div>';
            return $msg;
       }


}

/*
Show product in front-end
--------------------------------------------- 
*/

// Fearured Product ---------------------- 

public function getFeaturedProduct(){
   $query = "SELECT * FROM tbl_product WHERE type='0' ORDER BY productId DESC LIMIT 4 " ;
   $result = $this->db->select($query);
   return $result;
}

// New Product ---------------------- 
public function getNewProduct(){
   $query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4 " ;
   $result = $this->db->select($query);
   return $result;
}

//  Single Product -----------------

public function getSingleProduct($id){

   $query = " SELECT p.*,c.catName,b.brandName FROM 
              tbl_product as p, tbl_category as c,tbl_brand as b
              WHERE p.catId = c.catId AND p.brandId = b.brandId AND p.productId = '$id'
              ORDER BY p.productId DESC " ;

   $result = $this->db->select($query);
   return $result;

}

public function latestFromIphone(){
   $query = "SELECT * FROM tbl_product WHERE brandId = '9' ORDER BY productId DESC LIMIT 1 " ;
   $result = $this->db->select($query);
   return $result;
}

public function latestFromAcer(){
   $query = "SELECT * FROM tbl_product WHERE brandId = '1' ORDER BY productId DESC LIMIT 1 " ;
   $result = $this->db->select($query);
   return $result;
}

public function latestFromCanon(){
   $query = "SELECT * FROM tbl_product WHERE brandId = '3' ORDER BY productId DESC LIMIT 1 " ;
   $result = $this->db->select($query);
   return $result;
}

public function latestFromSamsung(){
   $query = "SELECT * FROM tbl_product WHERE brandId = '2' ORDER BY productId DESC LIMIT 1 " ;
   $result = $this->db->select($query);
   return $result;
}


public function productByCategory( $id ){

       $catid  = mysqli_real_escape_string( $this->db->link,$id );

       $query  = "SELECT *FROM tbl_product WHERE catId='$catid' ";
       $result = $this->db->select($query);
       return $result;
}

public function insertCompareData($productId,$customerId){
   $customerId  = mysqli_real_escape_string( $this->db->link,$customerId );
   $productId  = mysqli_real_escape_string( $this->db->link,$productId );
   
    $cQuery = "SELECT * FROM tbl_compare WHERE customerId = '$customerId' AND productId = '$productId' ";
    $chkQuery = $this->db->select($cQuery);
    if( $chkQuery ){
         $msg = '<div class="alert alert-danger"><strong>Error ! </strong> Product Already Added .</div>';
        return $msg;
    }

    $query = "SELECT * FROM tbl_product WHERE productId = '$productId' ";
    $result = $this->db->select($query)->fetch_assoc();

    if( $result ){
       
          $productId = $result['productId'];
          $productName = $result['productName'];
          $price = $result['price'] ;
          $image = $result['image'];

          $query = " INSERT INTO tbl_compare(customerId,productId,productName,price,image) 
                     VALUES( '$customerId','$productId','$productName','$price','$image') ";

          $insert_row = $this->db->insert($query);
          if($insert_row){
                $msg = '<div class="alert alert-success"><strong>Success ! </strong>Added to compare Successfully</div>';
                return $msg;
           }
           else{
               $msg = '<div class="alert alert-danger"><strong>Error ! </strong> Not Added .</div>';
                return $msg;
           }

       }

}


public function getCompareProduct($customerId){
     $query   = "SELECT * FROM tbl_compare WHERE customerId = '$customerId' ";
     $result  = $this->db->select($query);
     return $result; 
}

public function delCustomerCompare($customerId){
   $query = "DELETE FROM tbl_compare WHERE customerId = '$customerId' ";
   $result  = $this->db->delete($query);
     return $result;
}

public function wishlistData($id,$customerId){
    $cQuery = "SELECT * FROM tbl_wlist WHERE customerId = '$customerId' AND productId = '$id' ";
    $chkQuery = $this->db->select($cQuery);
    if( $chkQuery ){
         $msg = '<div class="alert alert-danger"><strong>Error ! </strong> Already Added .</div>';
        return $msg;
    }


   $customerId  = mysqli_real_escape_string( $this->db->link,$customerId );
   $id = mysqli_real_escape_string( $this->db->link,$id );

    $query = "SELECT * FROM tbl_product WHERE productId = '$id' ";
    $result = $this->db->select($query)->fetch_assoc();

    if( $result ){
       
          $productId = $result['productId'];
          $productName = $result['productName'];
          $price = $result['price'] ;
          $image = $result['image'];

          $query = " INSERT INTO tbl_wlist(customerId,productId,productName,price,image) 
                     VALUES( '$customerId','$productId','$productName','$price','$image') ";

          $insert_row = $this->db->insert($query);

          if($insert_row){
                $msg = '<div class="alert alert-success"><strong>Success ! </strong>Save to Whislist Successfully</div>';
                return $msg;
           }
           else{
                $msg = '<div class="alert alert-danger"><strong>Error ! </strong> Not Added to Whislist.</div>';
                return $msg;
           }

       }

}

public function getWlistProduct($customerId){
     $query   = "SELECT * FROM tbl_wlist WHERE customerId = '$customerId' ORDER BY id DESC ";
     $result  = $this->db->select($query);
     return $result;
}

public function delWlistProduct($productId,$customerId){
      $query = "DELETE FROM tbl_wlist WHERE customerId = '$customerId' AND productId='$productId' ";
      $result  = $this->db->delete($query);
      return $result;
}








}

?>