<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Brand.php'; ?>

<?php 

if( !isset($_GET['brandid']) || $_GET['brandid']==NULL ){
    echo '<script>window.location = "brandlist.php";</script>';
}
else{
   $id = preg_replace('/[^-a-zA-Z0-9_]/', '',  $_GET['brandid'] );
}


?>

<?php  
     $brand = new Brand();
     if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
       $brandName = $_POST['brandName'];
       
       $updateBrand = $brand->brandUpdate($brandName, $id);
   }

 ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update Brand
            <small>Update Brand name</small>
        </h1>
    </section>
    <?php 
                                   
        if( isset( $updateBrand ) ){
            echo $updateBrand;
        }

     ?>

    <!-- Main content -->
    <section class="content">
        <div class="col-md-12">
            <div class="box box-info">
                <?php 
                    $getBrand = $brand->getBrandById($id);
                    if($getBrand){
                        while( $result = $getBrand->fetch_assoc() ){
                ?>
                
                <form class="form-horizontal" action=" " method="post">
                    
                    <div class="box-body">

                        <div class="form-group">
                                
                            <label for="inputEmail3" class="col-sm-2 control-label"> Brand</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputEmail3" value="<?php echo $result['brandName']; ?>" name="brandName">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <a class="btn btn-primary" href="brandlist.php">Back Brand List</a>
                        <button type="submit" class="btn btn-info pull-right">Update</button>
                    </div>
                    <!-- /.box-footer -->
                </form>

                <?php  }  }  ?>

            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php include 'inc/footer.php'; ?>
