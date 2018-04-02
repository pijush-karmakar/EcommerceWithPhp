
<?php 
$filepath = realpath(dirname( __FILE__ ) );

 include_once ($filepath.'/../lib/Database.php');
 include_once ($filepath.'/../helpers/Format.php');
 ?>

<?php 

class Cart{

    private $db;
    private $fm;

	public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
	}


   public function addToCart( $quantity,$id ) {

       $quantity  = $this->fm->validation($quantity);
       $quantity  = mysqli_real_escape_string($this->db->link,$quantity);
       $productId =  mysqli_real_escape_string($this->db->link,$id);
       $sId       = session_id();

       $query   =   "SELECT * FROM tbl_product WHERE productId = '$productId' ";
       $result  =   $this->db->select($query)->fetch_assoc();
       
       $productName =  $result['productName'];
       $image      =  $result['image'];
       $price      =  $result['price'];

       $chquery = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND sId = '$sId' ";
       $getpro  = $this->db->select($chquery);
       
       if($getpro){
           $msg = 'This product already added';
           return $msg;
       }
       else{ 

                $query = " INSERT INTO tbl_cart(sId,productId,productName,price,quantity,image) 
              	     VALUES( '$sId','$productId','$productName','$price','$quantity','$image') ";

                $insert_row = $this->db->insert($query);

               if($insert_row){
                  	header( 'Location:cart.php' );    
               }
               else{
                    header( 'Location:404.php' );
                 }
    
       }
 

   }


  public function getCartProduct(){
  	$sId = session_id();
    $query = "SELECT * FROM tbl_cart WHERE sId = '$sId' ";
    $result = $this->db->select($query);
    return $result; 
  }


 public function updateCartQuantity( $quantity,$cartId ){
       $quantity  = mysqli_real_escape_string($this->db->link,$quantity);
       $cartId    =  mysqli_real_escape_string($this->db->link,$cartId);

         $query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId = '$cartId'; ";
         $Update_row = $this->db->update( $query );

          if($Update_row){
            header('Location:cart.php');
       }
       else{
           $msg = '<div class="danger"><strong>Error ! </strong>Quantity Not Updated .</div>';
            return $msg;
       }



 }

public function delProductByCart($id){
   $query = "DELETE FROM tbl_cart WHERE cartId='$id'  ";
   $deldata = $this->db->delete($query);
   if( $deldata ){
      echo '<script>window.location = "cart.php"; </script>';
   }
   else{
           $msg = '<div class="danger"><strong>Error ! </strong>Cart Not Deleted .</div>';
            return $msg;
       }

}


public function checkCartTable(){
    $sId = session_id();
    $query = "SELECT * FROM tbl_cart WHERE sId = '$sId' ";
    $result = $this->db->select($query);
    return $result; 
}


public function delCustomerCart(){
    $sId = session_id();
    $query = "DELETE FROM tbl_cart WHERE sId = '$sId' ";
    $this->db->delete($query);
}

public function orderProduct( $customerId){
    $sId = session_id();
    $query = "SELECT * FROM tbl_cart WHERE sId = '$sId' ";
    $getOrderPro = $this->db->select($query);

    if( $getOrderPro ){
       while ( $result = $getOrderPro->fetch_assoc() ) {
          $productId = $result['productId'];
          $productName = $result['productName'];
          $quantity = $result['quantity'];
          $price = $result['price'] * $quantity ;
          $image = $result['image'];

          $query = " INSERT INTO tbl_order(customerId,productId,productName,price,quantity,image) 
                     VALUES( '$customerId','$productId','$productName','$price','$quantity','$image') ";

          $insert_row = $this->db->insert($query);

       }
    }


}


public function payableAmount($customerId){
      $query = "SELECT price FROM tbl_order WHERE customerId = '$customerId' AND date  ";
      $result = $this->db->select($query);
      return $result; 
}

public function retrieveOrderProduct($customerId){
      $query = "SELECT * FROM tbl_order WHERE customerId = '$customerId' ORDER BY date DESC ";
      $result = $this->db->select($query);
      return $result; 
}

public function checkOrderTable($customerId){
    $query = "SELECT * FROM tbl_order WHERE customerId = '$customerId' ";
    $result = $this->db->select($query);
    return $result;
}

public function getCustomerOrder(){
    $query = "SELECT * FROM tbl_order ORDER BY date DESC";
    $result = $this->db->select($query);
    return $result;
}

public function productShifted($id,$price,$date){
    $id       = mysqli_real_escape_string($this->db->link,$id);
    $price       = mysqli_real_escape_string($this->db->link,$price);
    $date       = mysqli_real_escape_string($this->db->link,$date);
             
           $query = "UPDATE tbl_order 
              SET status = '1'

              WHERE customerId = '$id' AND date='$date' AND price='$price' ";
              $Update_row = $this->db->update( $query );

              if($Update_row){
                  $msg = '<div class="alert alert-success"><strong>Success ! </strong> Updated Successfully</div>';
                  return $msg;
             }
             else{
                 $msg = '<div class="alert alert-danger"><strong>Error ! </strong> Not Updated .</div>';
                  return $msg;
             }




}


public function delProductShifted($id,$price,$date){
    $id       = mysqli_real_escape_string($this->db->link,$id);
    $price       = mysqli_real_escape_string($this->db->link,$price);
    $date       = mysqli_real_escape_string($this->db->link,$date);
    
    $query = "DELETE FROM tbl_order  WHERE customerId = '$id' AND date='$date' AND price='$price' ";
     $deldata = $this->db->delete($query);
     if( $deldata ){
        $msg = '<div class="alert alert-success"><strong>Success ! </strong> Deleted Successfully</div>';
        return $msg;
     }
     else{
             $msg = '<div class="alert alert-danger"><strong>Error ! </strong> Not Deleted .</div>';
              return $msg;
         }


}


public function confirmProductShift($id,$price,$date){

    $id          =   mysqli_real_escape_string($this->db->link,$id);
    $price       =   mysqli_real_escape_string($this->db->link,$price);
    $date        =   mysqli_real_escape_string($this->db->link,$date);
             
           $query = "UPDATE tbl_order 
              SET status = '2'

              WHERE customerId = '$id' AND date='$date' AND price='$price' ";
              $Update_row = $this->db->update( $query );

              if($Update_row){
                  $msg = '<div class="alert alert-success"><strong>Success ! </strong> Updated Successfully</div>';
                  return $msg;
             }
             else{
                 $msg = '<div class="alert alert-danger"><strong>Error ! </strong> Not Updated .</div>';
                  return $msg;
             }
}













}


?>