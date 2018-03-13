<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php'; ?>
<?php include '../classes/Category.php'; ?>
<?php include '../classes/Product.php'; ?>

<?php  
     $pd = new Product();
     if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']) ) {
       
       $insertProduct = $pd->productInsert($_POST,$_FILES);
   }

 ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            ADD Product
            <small> Add product Brand,Catrgory,Description,Image,Price etc....</small>
        </h1>
    </section>
    
 <?php 
                                   
     if( isset( $insertProduct ) ){
               echo $insertProduct;
        }

 ?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">

                        <!-- /.box-header -->
                        <!-- form start -->
                       
                        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                            <div class="box-body">
                                   
                                <div class="form-group">
                                 

                                    <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="productName" class="form-control" id="inputEmail3" placeholder="product name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Category</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="catId">
                                            <option>Select Category</option>
                                            <?php 
                                                $cat = new Category();
                                                $getcat = $cat->getALLCat();
                                                if($getcat){
                                                    while($result = $getcat->fetch_assoc() ){
                                            
                                            ?>
                                            <option value="<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></option>
                                            
                                            <?php   }  } ?>
                                            
                                       </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Brand</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="brandId">
                                            <option>Select Brand</option>
                                            <?php 
                                                $brand = new Brand();
                                                $getbrand = $brand->getAllBrand();
                                                if($getbrand){
                                                    while($result = $getbrand->fetch_assoc() ){
                                            
                                            ?>
                                            
                                            <option value="<?php echo $result['brandId']; ?>"><?php echo $result['brandName']; ?></option>
                                            
                                            <?php } }  ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label"> Description</label>
                                    <div class="col-sm-10">
                                        <textarea name="description"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label"> Price</label>

                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                            <input type="text" class="form-control" name="price">
                                           
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Upload Image</label>
                                    <div class="col-sm-10">
                                        
                                        <input type="file" id="exampleInputFile" name="image">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Product Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="type">
                                            <option>Select type</option>
                                            <option value="0">Featured</option>
                                            <option value="1">General</option>
                                        </select>
                                    </div>
                                </div>


                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                                <input type="submit" name="submit" class="btn btn-info pull-right" value="Update">
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>
                </div>
            </div>

        </div>



    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php include 'inc/footer.php'; ?>
