<?php include 'inc/header.php'; ?>

<?php 

if( !isset($_GET['productid']) || $_GET['productid']==NULL ){
    echo '<script>window.location = "404.php";</script>';
}
else{
   $id = preg_replace('/[^-a-zA-Z0-9_]/', '',  $_GET['productid'] );
}

if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
	$quantity = $_POST['quantity'];
	$addCart  = $ct->addToCart( $quantity,$id );
}


?>


<div class="main">
    <div class="content">
        <div class="section group">
            <div class="cont-desc span_1_of_2">
                <?php 

                 $getSinglePd = $pd->getSingleProduct($id);
                 if($getSinglePd){
                 	while ($result = $getSinglePd->fetch_assoc() ) {

				 ?>
                <div class="grid images_3_of_2">
                    <img src="admin/<?php echo $result['image']; ?>" alt="" />
                </div>
                <div class="desc span_3_of_2">
                    <h2>
                        <?php echo $result['productName']; ?>
                    </h2>

                    <div class="price">
                        <p>Price: <span><?php echo $result['price']; ?></span></p>
                        <p>Category: <span><?php echo $result['catName']; ?></span></p>
                        <p>Brand:<span><?php echo $result['brandName']; ?></span></p>
                    </div>
                    <div class="add-cart">
                        <form action="" method="post">
                            <input type="number" class="buyfield" name="quantity" value="<?php echo $result['quantity']; ?>" placeholder="product quantity" />
                            <input type="submit" class="buysubmit" name="submit" value="Buy Now" />
                        </form>
                    </div>
                    <span style="color: red; font-size: 18px; display: block; margin-top: 15px;"><?php 

                     if( isset($addCart) ){
                     	echo $addCart;
                     }
				 ?></span>
                </div>
                <div class="product-desc">

                    <h2>Product Details</h2>

                    <div class="productDetails">
                        <?php echo $result['description']; ?>
                    </div>

                </div>

                <?php }  } ?>

            </div>
            <div class="rightsidebar span_3_of_1">
                <h2>CATEGORIES</h2>
                <ul>

                    <?php 
                            
                           $getCat = $cat->getALLCat();
                           if( $getCat ){
                           	 while( $result = $getCat->fetch_assoc() ){

						 ?>

                    <li>
                        <a href="productbycat.php?catid=<?php echo $result['catId']; ?>">
                            <?php echo $result['catName'] ?>
                        </a>
                    </li>

                    <?php } }  ?>

                </ul>

            </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
