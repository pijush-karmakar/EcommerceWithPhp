<?php include 'inc/header.php'; ?>
<?php 

    $logIn = Session::get("customerLogin");
    if( $logIn == false ){
        header('Location:login.php');
    }

 ?>
<?php 

 if( isset($_GET['customerId']) ){

    $id    = $_GET['customerId'];
    $price = $_GET['price'];
    $date  = $_GET['time'];

   $confirmShift = $ct->confirmProductShift($id,$price,$date);
 }
 


 ?>


<div class="main">
    <div class="content">
        <div class="section-group">
            <div class="order">
                <h2>Your Order Details</h2>
                  <table class="tblone">
                    <tr>
                        <th>No</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                    <?php 
                                $customerId = Session::get("customerId");
                                 $getOrder = $ct->retrieveOrderProduct($customerId);
                                 if($getOrder){
                                    $i = 0;
                                    while( $result = $getOrder->fetch_assoc() ){
                                        $i++;
                    ?>

                    <tr>
                        <td>
                            <?php echo $i; ?>
                        </td>
                        <td>
                            <?php echo $result['productName']; ?>
                        </td>
                        <td class="td-image"><img src="admin/<?php echo $result['image']; ?>" alt="" /></td>
                        <td> <?php echo $result['quantity']; ?> </td>
                        <td>
                            <?php 
                                        $totalPrice =  $result['price']; 
                                        echo '$'.$totalPrice;
                                    ?>

                        </td>
                         <td><?php echo $fm->formatDate($result['date']) ; ?></td>
                         <td><?php 
                                if( $result['status']== '0' ){
                                    echo 'Pending';
                                }elseif( $result['status']== '1' ){ 
                                      echo 'Shifted';
                                  }
                                    else{
                                      echo 'Okay';
                                }

                          ?></td>
                        <?php

                          if(  $result['status']== '1'){ 
                           ?>
                          <td> <a href="?customerId=<?php echo $result['customerId'];?>&price=<?php           echo  $result['price'] ; ?>&time=<?php echo $result['date']; ?>">Shifted</a> </td>

                        <?php  }elseif( $result['status']== '2' ) {  ?>

                              <td>Ok</td>
                              
                        <?php } elseif( $result['status']== '0' ){ ?>
                           <td>N/A</td>
                        <?php } ?>
                    </tr>
                    
                    <?php } }  ?>



                </table>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>



<?php include 'inc/footer.php'; ?>
