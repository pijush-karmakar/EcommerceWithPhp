
<?php 
$filepath = realpath(dirname( __FILE__ ) );

 include_once ($filepath.'/../lib/Database.php');
 include_once ($filepath.'/../helpers/Format.php');
 ?>


<?php 

class Category{
    private $db;
    private $fm;

	public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
	}

/*
Category insert function
--------------------------------------------- 
*/

public function catInsert($catName){

	  $catName = $this->fm->validation($catName);
    $catName = mysqli_real_escape_string($this->db->link,$catName);

    if( empty($catName) ){
         $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Category must not be empty</div>';
         return $msg ;
   	  } 

   	else{
       $query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
       $catInsert = $this->db->insert($query);
       if($catInsert){
       	    $msg = '<div class="alert alert-success"><strong>Success ! </strong>Category Inserted Successfully</div>';
       	    return $msg;
       }
       else{
           $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Category Not Inserted .</div>';
       	    return $msg;
       }

   	}  

}

/*
Category get function
--------------------------------------------- 
*/

public function getALLCat(){
    $query = "SELECT * FROM tbl_category ORDER BY catId DESC";
    $result = $this->db->select($query);
    return $result;
}


public function getCatById($id){
    $query = "SELECT * FROM tbl_category WHERE catId = '$id' ";
    $result = $this->db->select($query);
    return $result;
}

/*
Category Update function
--------------------------------------------- 
*/
public function catUpdate($catName,$id){

    $catName = $this->fm->validation($catName);
    $catName = mysqli_real_escape_string($this->db->link,$catName);
    $id      = mysqli_real_escape_string($this->db->link,$id);

    if( empty($catName) ){
         $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Category must not be empty</div>';
         return $msg ;
      } 

      else{
         $query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$id'; ";
         $Update_row = $this->db->update( $query );

          if($Update_row){
            $msg = '<div class="alert alert-success"><strong>Success ! </strong>Category Updated Successfully</div>';
            return $msg;
       }
       else{
           $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Category Not Updated .</div>';
            return $msg;
       }

    }


}

/*
Category Delete function
--------------------------------------------- 
*/

public function delCatById($id){

   $query = "DELETE FROM tbl_category WHERE catId='$id'  ";
   $deldata = $this->db->delete($query);
   if( $deldata ){
      $msg = '<div class="alert alert-success"><strong>Success ! </strong>Category Deleted Successfully</div>';
      return $msg;
   }
   else{
           $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Category Not Deleted .</div>';
            return $msg;
       }


}


public function productName( $id ){
        $catid  = mysqli_real_escape_string( $this->db->link,$id );

       $query  = "SELECT *FROM tbl_category WHERE catId='$catid' ";
       $result = $this->db->select($query);
       return $result;
}










}




 ?>