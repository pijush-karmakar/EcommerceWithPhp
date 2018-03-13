<?php include 'inc/header.php'; ?>

<?php 

    $logIn = Session::get("customerLogin");
    if( $logIn == false ){
        header('Location:login.php');
    }

 ?>
<?php  
     $customerId = Session::get("customerId");
     if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']) ) {
       
       $updateCustomer = $cm->customerUpdate($_POST,$customerId);
   }

 ?>

<style>
.tblone{ 
   margin: 0 auto;
   width: 600px;
   border:2px solid #ddd;

 }

 .tblone tr td{
    text-align: justify;
    padding: 10px;
 } 

 .tblone input[type="text"]{
    width: 400px;
    padding: 5px;
 }   
 

</style>

<div class="main">
    <div class="content">
        <div class="section group">
            <?php 

                $id = Session::get("customerId");
                $getData = $cm->getCustomerData($id);
                if( $getData ){
                    while ($result = $getData->fetch_assoc() ) {
               
             ?>
            <form action="" method="post">
            <table class="tblone">
                 
                <tr>
                    <td colspan="2" style="text-align: center;"><h2>Update Profile Details</h2></td>
                </tr>
                <?php 
                    if( isset($updateCustomer) ){
                        echo '<tr><td colspan="2">'.$updateCustomer.'</td></tr>' ;
                     }

                 ?>

                <tr>

                    <td width="20%">Name</td>
                    <td><input type="text" name="name" value="<?php echo $result['name'] ?>"></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><input type="text" name="address" value="<?php echo $result['address'] ?>"></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td><input type="text" name="city" value="<?php echo $result['city'] ?>"></td>
                </tr>
                <tr>
                    <td>Country</td>
                    <td><input type="text" name="country" value="<?php echo $result['country'] ?>"></td>
                </tr>
                <tr>
                    <td>ZipCode</td>
                    <td><input type="text" name="zip" value="<?php echo $result['zip'] ?>"></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td><input type="text" name="phone" value="<?php echo $result['phone'] ?>"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" name="email" value="<?php echo $result['email'] ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="submit" value="Update"></td>
                </tr>

            </table>
            </form>
            <?php } } ?>

        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
