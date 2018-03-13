<?php include 'inc/header.php'; ?>
<?php 

if( !isset($_GET['catid']) || $_GET['catid']==NULL ){
    echo '<script>window.location = "index.php";</script>';
}
else{
   $id = preg_replace('/[^-a-zA-Z0-9_]/', '',  $_GET['catid'] );
}


?>

<div class="main">
    <div class="content">
        <div class="content_top">

 <?php 

	 $proName = $cat->productName( $id ) ;
	   if( $proName ){
	   	  while( $result = $proName->fetch_assoc() ){
?>

            <div class="heading">
                <h3>Latest from
                    <?php echo $result['catName']; ?>
                </h3>
            </div>

            <?php } } ?>

            <div class="clear"></div>
        </div>

        <div class="section group">

<?php 
    $productByCat = $pd->productByCategory( $id );
    if( $productByCat ){
   	   while( $result = $productByCat->fetch_assoc() ){

 ?>
            <div class="grid_1_of_4 images_1_of_4">
                <a href="details.php?productid=<?php echo $result['productId']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
                <h2>
                    <?php echo $result['productName']; ?>
                </h2>
                <p>
                    <?php echo $fm->textShorten($result['description'],100 ); ?>
                </p>
                <p><span class="price"><?php echo '$'.$result['price']; ?></span></p>
                <div class="button"><span><a href="details.php?productid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
            </div>
            <?php }  }

else{
	  header('Location:404.php');
}

 ?>

        </div>
    </div>
</div>


<?php include 'inc/footer.php'; ?>
