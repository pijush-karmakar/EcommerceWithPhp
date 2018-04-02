<?php include 'inc/header.php'; ?>
<?php 

    $logIn = Session::get("customerLogin");
    if( $logIn == false ){
        header('Location:login.php');
    }

 ?>
<?php 

if( isset($_GET['delwlistId']) ){
    $productId = $_GET['delwlistId'];
    $delWlist = $pd->delWlistProduct($productId,$customerId);
}

 ?>
<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2>My Wishlist</h2>
              
                <table class="tblone">
                    <tr>
                        <th>SL</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>

                    <?php 
                                 $WlistProduct = $pd->getWlistProduct($customerId);
                                 if( $WlistProduct ){
                                 $i = 0;
                                 	while( $result = $WlistProduct->fetch_assoc() ){
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
                        <td>$<?php echo $result['price']; ?>
                        </td>

                        <td>
                                <a href="details.php?productid=<?php echo $result['productId']; ?>">Buy Now</a> || 
                                <a href="?delwlistId=<?php echo $result['productId']; ?>">Remove</a>
                        </td>

                    </tr>
                    
                    <?php  }  }  ?>
                    
                </table>

            </div>
            <div class="shopping" >
                <div class="shopleft" style="text-align: center;width: auto;float: none;">
                     <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                </div>
            
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>



<?php include 'inc/footer.php'; ?>
