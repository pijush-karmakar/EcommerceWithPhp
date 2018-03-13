<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Category.php'; ?>

<?php 

if( !isset($_GET['catid']) || $_GET['catid']==NULL ){
    echo '<script>window.location = "catlist.php";</script>';
}
else{
   $id = preg_replace('/[^-a-zA-Z0-9_]/', '',  $_GET['catid'] );
}


?>

<?php  
     $cat = new Category();
     if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
       $catName = $_POST['catName'];
       
       $updateCat = $cat->catUpdate($catName, $id);
   }

 ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update Category
            <small>Update products Category name</small>
        </h1>
    </section>
    <?php 
                                   
        if( isset( $updateCat ) ){
            echo $updateCat;
        }

     ?>
    <!-- Main content -->
    <section class="content">
        <div class="col-md-12">
            <div class="box box-info">



                <?php 
                    $getCat = $cat->getCatById($id);
                    if($getCat){
                        while( $result = $getCat->fetch_assoc() ){
                ?>
                
                <form class="form-horizontal" action=" " method="post">
                    
                    <div class="box-body">

                        <div class="form-group">
                                
                            <label for="inputEmail3" class="col-sm-2 control-label">Category</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputEmail3" value="<?php echo $result['catName']; ?>" name="catName">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <a class="btn btn-primary" href="catlist.php">Back Category List</a>
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
