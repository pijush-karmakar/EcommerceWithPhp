<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Product.php'; ?>
<?php include_once '../helpers/Format.php'; ?>

<?php 

  $pd = new Product();
  $fm = new Format();

 ?>

<?php 

   if( isset($_GET['delproduct']) ) {
       $id = preg_replace('/[^-a-zA-Z0-9_]/', '',  $_GET['delproduct'] );
       $delproduct = $pd->delProductById($id);
   }


?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Products
        <small>Products List</small>
      </h1>
    </section>

              <?php 
                if( isset($delproduct) ){
                  echo $delproduct;
                 }

             ?>
   
    <!-- Main content -->
    <section class="content">
       <div class="row">
         <div class="col-xs-12">
            <div class="box">
            <div class="box-body">

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Serial No</th>
                  <th>Product Name</th>
                  <th>Category</th>
                  <th>Brand</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Price</th>
                  <th>Type</th>
                  <th width="15%">Action</th>
                </tr>
                </thead>

                <tbody>
                  <?php 
                     $getProduct = $pd->getAllProduct();
                     if($getProduct){
                        $i = 0;
                        while($result = $getProduct->fetch_assoc() ){
                           $i++;
                     
                   ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td> <?php echo $result['productName']; ?></td>
                  <td><?php echo $result['catName']; ?></td>
                  <td><?php echo $result['brandName']; ?></td>
                  <td><?php echo $fm->textShorten($result['description'],90 ); ?></td>
                  <td><img src="<?php echo $result['image']; ?>" alt="" height="60" width="60"></td>
                  <td>$<?php echo $result['price']; ?></td>
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

                  <td><a href="productedit.php?productid=<?php echo $result['productId']; ?>" class="btn btn-info">Edit </a>  <a onclick=" return confirm('Are You Sure To Delete'); " href="?delproduct=<?php echo $result['productId']; ?>" class="btn btn-danger"> Delete</a></td>
                </tr>

                <?php } } ?>

                </tbody>

                <tfoot>
                <tr>
                  <th>Serial No</th>
                  <th>Product Name</th>
                  <th>Category</th>
                  <th>Brand</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Price</th>
                  <th>Type</th>
                  <th>Action</th>
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

 <?php include 'inc/footer.php';?>