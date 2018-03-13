<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php'; ?>
<?php include '../classes/Category.php'; ?>
<?php include '../classes/Product.php'; ?>

<?php 

if( !isset($_GET['productid']) || $_GET['productid']==NULL ){
    echo '<script>window.location = "productlist.php";</script>';
}
else{
   $id = preg_replace('/[^-a-zA-Z0-9_]/', '',  $_GET['productid'] );
}

?>

<?php  
     $pd = new Product();
     if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']) ) {
       
       $updateProduct = $pd->productUpdate($_POST,$_FILES,$id);
   }

 ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update Product
            <small> Update product Brand,Catrgory,Description,Image,Price etc....</small>
        </h1>
    </section>
    
 <?php 
                                   
     if( isset( $updateProduct ) ){
               echo $updateProduct;
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
                        <?php 

                              $getProduct = $pd->getProductById($id);
                              if($getProduct){
                                 while ($value = $getProduct->fetch_assoc() ) {
                                     

                        ?>

                        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                            <div class="box-body">
                                   
                                <div class="form-group">
                                 

                                    <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="productName" class="form-control" id="inputEmail3" value="<?php echo $value['productName']; ?>">
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
                                            <option 

                                            <?php if($value['catId'] == $result['catId'] ){  ?>
                                                    selected = "selected" 
                                            <?php } ?>

                                            value="<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?>
                                                
                                            </option>
                                            
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
                                            
                                            <option 

                                            <?php if($value['brandId'] == $result['brandId'] ){  ?>
                                                    selected = "selected" 
                                            <?php } ?>

                                            value="<?php echo $result['brandId']; ?>"><?php echo $result['brandName']; ?>
                                                
                                            </option>
                                            
                                            <?php } }  ?>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label"> Description</label>
                                    <div class="col-sm-10">
                                        <textarea name="description">
                                            <?php echo $value['description']; ?>
                                        </textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label"> Price</label>

                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                            <input type="text" class="form-control" name="price" value="<?php echo $value['price']; ?>">
                                           
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Upload Image</label>
                                    <div class="col-sm-10">
                                        
                                        <input type="file" id="exampleInputFile" name="image">
                                        <div class="proImg">
                                            <img src="<?php echo $value['image']; ?>" alt="" class="productImage">
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Product Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="type">
                                            <option>Select type</option>

                                            <?php if($value['type'] == 0 ){  ?>

                                                <option value="0" selected="selected">Featured</option>
                                                <option value="1">General</option>

                                            <?php } else{ ?>

                                                <option value="0" >Featured</option>
                                                <option value="1" selected="selected">General</option>

                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <a class="btn btn-primary" href="productlist.php">Back Product List</a>
                                <input type="submit" name="submit" class="btn btn-success pull-right" value="Update">
                            </div>
                            <!-- /.box-footer -->
                        </form>

                      <?php } } ?>

                    </div>
                </div>
            </div>

        </div>



    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php include 'inc/footer.php'; ?>
