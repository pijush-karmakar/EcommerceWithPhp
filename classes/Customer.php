
<?php 
$filepath = realpath(dirname( __FILE__ ) );

 include_once ($filepath.'/../lib/Database.php');
 include_once ($filepath.'/../helpers/Format.php');
 ?>

<?php 

class Customer{

    private $db;
    private $fm;

	public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
	}


   public function customerRegistration($data) {

        $name     	= mysqli_real_escape_string($this->db->link,$data['name']);
        $city  	  	= mysqli_real_escape_string($this->db->link,$data['city']);
        $zip  	  	= mysqli_real_escape_string($this->db->link,$data['zip']);
        $email    	= mysqli_real_escape_string($this->db->link,$data['email']);
        $address  	= mysqli_real_escape_string($this->db->link,$data['address']);
        $country  	= mysqli_real_escape_string($this->db->link,$data['country']);
        $phone    	= mysqli_real_escape_string($this->db->link,$data['phone']);
        $password   = mysqli_real_escape_string($this->db->link,md5($data['password'] ) ) ;
      

    
        if( $name=="" ||  $city=="" ||  $zip=="" ||  $email=="" ||  $address=="" ||  $country=="" || $phone=="" ||  $password=="" ){
        	$msg = '<div class="alert alert-danger"><strong>Error ! </strong>Field must not be empty</div>';
           return $msg ;
        }

        $mailQuery = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1 ";
        $mailChk   = $this->db->select($mailQuery);
        if( $mailChk != false ){
           $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Email Already exist</div>';
           return $msg;
        }
        else{

	            $query = "INSERT INTO tbl_customer(name,city,zip,email,address,country,phone,password) 
	        	VALUES( '$name','$city','$zip','$email','$address','$country','$phone','$password' ) ";

		        $insert_row = $this->db->insert($query);
		        if($insert_row){
		       	    $msg = '<div class="alert alert-success"><strong>Success ! </strong>Customer data Inserted Successfully</div>';
		       	    return $msg;
		        }
		        else{
		           $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Customer data Not Inserted .</div>';
		       	    return $msg;
		        }

        }


   }
   

public function customerLogIn($data){
  
	$email    	= mysqli_real_escape_string($this->db->link,$data['email']);
	$password   = mysqli_real_escape_string($this->db->link,md5($data['password']) );

      if( empty($email) || empty($password) ) {
          $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Field must not be empty</div>';
          return $msg ;
      }

      $query    = "SELECT * FROM tbl_customer WHERE email='$email' AND password='$password'  ";
      $result   =  $this->db->select($query);
      if( $result != false ){

        $value = $result->fetch_assoc();
        Session::set("customerLogin",true );
        Session::set("customerId",$value['id'] );
        Session::set("customerName",$value['name'] );
        header('Location:cart.php');
     }
     else{
          $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Email and Password not match...</div>';
          return $msg ;
     }
	
}


public function getCustomerData($id){
    $query = "SELECT * FROM tbl_customer WHERE id = '$id' ";
    $result = $this->db->select($query);
    return $result;
}


public function customerUpdate($data,$customerId){

        $name       = mysqli_real_escape_string($this->db->link,$data['name']);
        $city       = mysqli_real_escape_string($this->db->link,$data['city']);
        $zip        = mysqli_real_escape_string($this->db->link,$data['zip']);
        $email      = mysqli_real_escape_string($this->db->link,$data['email']);
        $address    = mysqli_real_escape_string($this->db->link,$data['address']);
        $country    = mysqli_real_escape_string($this->db->link,$data['country']);
        $phone      = mysqli_real_escape_string($this->db->link,$data['phone']);

        if( $name=="" ||  $city=="" ||  $zip=="" ||  $email=="" ||  $address=="" ||  $country=="" || $phone=="" ){
          $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Field must not be empty</div>';
           return $msg ;
        }

        else{

              $query = "UPDATE tbl_customer 
              SET name  = '$name', 
                  city  = '$city', 
                  zip   = '$zip', 
                  email = '$email', 
                  country = '$country', 
                  address = '$address', 
                  phone   = '$phone' 

              WHERE id = '$customerId'; ";
              $Update_row = $this->db->update( $query );

              if($Update_row){
                  $msg = '<div class="alert alert-success"><strong>Success ! </strong>Profile Updated Successfully</div>';
                  return $msg;
             }
             else{
                 $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Profile Not Updated .</div>';
                  return $msg;
             }

        }

}
















}

 ?>