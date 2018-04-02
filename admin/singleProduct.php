<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Product.php'; ?>

<?php 

if( !isset($_GET['productID']) || $_GET['productID']==NULL ){
    echo '<script>window.location = "customerorder.php";</script>';
}
else{
   $id = preg_replace('/[^-a-zA-Z0-9_]/', '',  $_GET['productID'] );
}


?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Product Details
        </h1>
    </section>
   
    <!-- Main content -->
    <section class="content">
        <div class="row">
        <div class="col-md-12">
                          <div class="box">

                    <div class="box-body">
                       
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    
                                    <th>Product</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Type</th>
                                </tr>
                            </thead>
                            <tbody>

                <?php 
                    $pt = new Product();
                    $getpro = $pt->getSingleProduct($id);
                    if($getpro){
                        while( $result = $getpro->fetch_assoc() ){
                ?>
                
                                <tr>
                                    
                                    <td><?php echo $result['productName']; ?></td>
                                    <td><?php echo $result['catName']; ?></td>
                                    <td><?php echo $result['brandName']; ?></td>
                                    <td><img src="<?php echo $result['image']; ?>" alt="" height="60" width="60"></td>
                                    <td><?php echo $result['price']; ?></td>
                                    <td>
                                      <?php 
                                         if(  $result['type'] == 0 ) {
                                            echo "Featured";
                                         }
                                         else{
                                            echo "General";
                                         }

                                      ?>
                                        
                                    </td>
                                    
                                </tr>

                <?php  }  }  ?>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>Product</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Type</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php include 'inc/footer.php'; ?>
