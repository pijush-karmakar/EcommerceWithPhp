<?php include 'inc/header.php'; ?>

<?php 
     if( isset($_GET['delpro']) ){
       $id = preg_replace('/[^-a-zA-Z0-9_]/', '',  $_GET['delpro'] );
       $delcart = $ct->delProductByCart($id);
    }
?>

<?php 
	 if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
		$cartId = $_POST['cartId'];
		$quantity = $_POST['quantity'];
		$updateCart  = $ct->updateCartQuantity( $quantity,$cartId );

		if($quantity<=0){
			 $delcart = $ct->delProductByCart($cartId);
		}
		
	 }

 ?>

<?php 
 if( !isset($_GET['id']) ){
      echo "<meta http-equiv='refresh' content='0;url=?id=live' />";
 }

?>

<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2>Your Cart</h2>
                <?php 
                        if(isset($updateCart)){
                        	echo "$updateCart";
                        }
                        if(isset($delcart)){
                        	echo "$delcart";
                        }

			    	 ?>
                <table class="tblone">
                    <tr>
                        <th width="5%">SL</th>
                        <th width="15%">Product Name</th>
                        <th width="15%">Image</th>
                        <th width="15%">Price</th>
                        <th width="25%">Quantity</th>
                        <th width="15%">Total Price</th>
                        <th width="10%">Action</th>
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
                        <td>
                            <?php echo $i; ?>
                        </td>
                        <td>
                            <?php echo $result['productName']; ?>
                        </td>
                        <td class="td-image"><img src="admin/<?php echo $result['image']; ?>" alt="" /></td>
                        <td>$
                            <?php echo $result['price'] ?>
                        </td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="cartId" value="<?php echo $result['cartId']; ?>" />
                                <input type="number" name="quantity" value="<?php echo $result['quantity']; ?>" />
                                <input type="submit" name="submit" value="Update" />
                            </form>
                        </td>

                        <td>
                            <?php 
								        $totalPrice =  $result['price'] * $result['quantity']; 
                                        echo '$'.$totalPrice;
                                    ?>

                        </td>

                        <td><a onclick="return confirm('Are you sure to Delete!');" href="?delpro=<?php echo $result['cartId']; ?>">X</a></td>

                    </tr>
                    <?php 
                              $qty = $qty + $result['quantity'];
                              $sum = $sum + $totalPrice;
                              Session::set('sum',$sum);
                              Session::set('quantity',$qty);
                             ?>
                    <?php  }  }  ?>



                </table>
                <?php 
						    $getData = $ct->checkCartTable();
                            if($getData){ 

						 ?>
                <table style="float:right;text-align:left;" width="40%">
                    <tr>
                        <th>Sub Total : </th>
                        <td>
                            <?php echo '$'.$sum; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>VAT : </th>
                        <td>10% [
                            <?php 

									$vat = $sum * 0.1; 
									echo '$'.$vat; 

									?>]

                        </td>
                    </tr>
                    <tr>
                        <th>Grand Total :</th>
                        <td>
                            <?php 
                                         $gtotal = $vat + $sum;
                                         echo '$'.$gtotal;
								     ?>
                        </td>
                    </tr>
                </table>

                <?php }
					   else{
					   	   header('Location:index.php');
					       } 

					   ?>

            </div>
            <div class="shopping">
                <div class="shopleft">
                    <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                </div>
                <div class="shopright">
                    <a href="payment.php"> <img src="images/check.png" alt="" /></a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>



<?php include 'inc/footer.php'; ?>
