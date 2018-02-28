<?php 
$filepath = realpath(dirname( __FILE__ ) );

 include_once ($filepath.'/../lib/Database.php');
 include_once ($filepath.'/../helpers/Format.php');
 ?>


<?php 

class Brand{
    private $db;
    private $fm;

	public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
	}


/*
Brand insert function
--------------------------------------------- 
*/

public function brandInsert($brandName){

	  $brandName = $this->fm->validation($brandName);
      $brandName = mysqli_real_escape_string($this->db->link,$brandName);

    if( empty($brandName) ){
         $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Brand must not be empty</div>';
         return $msg ;
   	  } 

   	else{
       $query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
       $brandInsert = $this->db->insert($query);
       if($brandInsert){
       	    $msg = '<div class="alert alert-success"><strong>Success ! </strong>Brand Inserted Successfully</div>';
       	    return $msg;
       }
       else{
           $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Brand Not Inserted .</div>';
       	    return $msg;
       }

   	}  

}


/*
Brand get function
--------------------------------------------- 
*/

public function getAllBrand(){
    $query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
    $result = $this->db->select($query);
    return $result;
}


public function getBrandById($id){
    $query = "SELECT * FROM tbl_brand WHERE brandId = '$id' ";
    $result = $this->db->select($query);
    return $result;
}


/*
Brand Update function
--------------------------------------------- 
*/
public function brandUpdate($brandName, $id){

    $brandName = $this->fm->validation($brandName);
    $brandName = mysqli_real_escape_string($this->db->link,$brandName);
    $id      = mysqli_real_escape_string($this->db->link,$id);

    if( empty($brandName) ){
         $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Brand must not be empty</div>';
         return $msg ;
      } 

      else{
         $query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId = '$id'; ";
         $Update_row = $this->db->update( $query );

          if($Update_row){
            $msg = '<div class="alert alert-success"><strong>Success ! </strong>Brand Updated Successfully</div>';
            return $msg;
       }
       else{
           $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Brand Not Updated .</div>';
            return $msg;
       }

    }


}

/*
Brand Delete function
--------------------------------------------- 
*/

public function delbrandById($id){

   $query = "DELETE FROM tbl_brand WHERE brandId='$id'  ";
   $deldata = $this->db->delete($query);
   if( $deldata ){
      $msg = '<div class="alert alert-success"><strong>Success ! </strong>Brand Deleted Successfully</div>';
      return $msg;
   }
   else{
           $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Brand Not Deleted .</div>';
            return $msg;
       }

}





}


?>

 