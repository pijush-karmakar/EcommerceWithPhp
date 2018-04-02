<?php include 'inc/header.php'; ?>

<?php 

    $logIn = Session::get("customerLogin");
    if( $logIn == false ){
        header('Location:login.php');
    }

 ?>

<style>
    table.tblone img{
        height: 70px;
    }
</style>

<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2>Compare</h2>
              
                <table class="tblone">
                    <tr>
                        <th>SL</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>

                    <?php 
                             $customerId = Session::get("customerId");
                                 $CompareProduct = $pd->getCompareProduct($customerId);
                                 if($CompareProduct){
                                 $i = 0;
                                 	while( $result = $CompareProduct->fetch_assoc() ){
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

                        <td><a href="details.php?productid=<?php echo $result['productId']; ?>">View</a></td>

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
