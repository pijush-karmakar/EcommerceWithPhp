<?php include 'inc/header.php'; ?>

<?php 

    $logIn = Session::get("customerLogin");
    if( $logIn == false ){
        header('Location:login.php');
    }

 ?>

<?php 

  if( isset($_GET['orderid']) && $_GET['orderid']=='order' ){
     $customerId = Session::get("customerId");
     $insertOrder = $ct->orderProduct( $customerId); 
     $delData = $ct->delCustomerCart();
     header('Location:success.php');
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
}
 .division .profile tr td{
    text-align: center;
    padding: 10px;
 }  

 .division{
    width: 50%;
    float: left;
 } 
 .tbl_two{
    float: right;
    text-align: left;
    width: 50%;
    border: 2px solid #ddd;
    margin-right: 25px;
    margin-top: 30px;
 }
 .tbl_two tr td,th{
    text-align: justify;
    padding: 10px;
 }
 .order {
    padding: 40px;
    text-align: center;
}
.order a {
    background: #28a745;
    color: #fff;
    padding: 11px 30px;
    letter-spacing: 1px;
}

</style>
<div class="main">
    <div class="content">
        <div class="section group">

             <div class="division ">
                  <?php 

                $id = Session::get("customerId");
                $getData = $cm->getCustomerData($id);
                if( $getData ){
                    while ($result = $getData->fetch_assoc() ) {
               
             ?>
            <table class="tblone">
                <tr>
                    <td colspan="3" style="text-align: center;"><h2>Your Profile Details</h2></td>
                    
                </tr>

                <tr>
                    <td width="20%">Name</td>
                    <td width="5%">:</td>
                    <td><?php echo $result['name'] ?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>:</td>
                    <td><?php echo $result['address'] ?></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td>:</td>
                    <td><?php echo $result['city'] ?></td>
                </tr>
                <tr>
                    <td>Country</td>
                    <td>:</td>
                    <td><?php echo $result['country'] ?></td>
                </tr>
                <tr>
                    <td>ZipCode</td>
                    <td>:</td>
                    <td><?php echo $result['zip'] ?></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>:</td>
                    <td><?php echo $result['phone'] ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?php echo $result['email'] ?></td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center;"><a href="editprofile.php" >Update Profile</a></td>
                </tr>

            </table>

            <?php } } ?>
             </div>

             <div class="division">
                  <table class="tblone profile">
                    <tr>
                        
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        
                    </tr>

                    <?php 
                                 $CartProduct = $ct->getCartProduct();
                                 if($CartProduct){
                                    $i = 0;
                                    $sum = 0;
                                    $qty = 0;
                                    while( $result = $CartProduct->fetch_assoc() ){
                                        $i++;
                             ?>

                    <tr>
                        
                        <td> <?php echo $result['productName']; ?> </td>
                        <td>$<?php echo $result['price']; ?> </td>
                        <td> <?php echo $result['quantity']; ?> </td>
                        <td> <?php 
                                        $totalPrice =  $result['price'] * $result['quantity']; 
                                        echo '$'.$totalPrice;
                                    ?> </td>

                     

                    </tr>
                    <?php 
                              $qty = $qty + $result['quantity'];
                              $sum = $sum + $totalPrice;
                              
                             ?>
                    <?php  }  }  ?>

                </table>
              
                <table class="tbl_two">
                    <tr>
                        <th>Sub Total </th>
                        <td>:</td>
                        <td>
                            <?php echo '$'.$sum; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>VAT </th>
                        <td>:</td>
                        <td>10% ( 
                            <?php 

                                    $vat = $sum * 0.1; 
                                    echo '$'.$vat; 

                                    ?>)

                        </td>
                    </tr>
                    <tr>
                        <th>Grand Total</th>
                        <td>:</td>
                        <td>
                            <?php 
                                         $gtotal = $vat + $sum;
                                         echo '$'.$gtotal;
                                     ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Quantity </th>
                        <td>:</td>
                        <td>
                            <?php echo $qty; ?>
                        </td>
                    </tr>
                </table>
             </div>

        </div>
    </div>

    <div class="order">
        <a href="?orderid=order"> Order Now </a>
    </div>

</div>

<?php include 'inc/footer.php'; ?>
