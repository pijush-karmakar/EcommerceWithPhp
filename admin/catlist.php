<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php'; ?>

<?php 
   $cat = new Category();
   if( isset($_GET['delcat']) ){
       $id = $_GET['delcat'];
       $id = preg_replace('/[^-a-zA-Z0-9_]/', '',  $_GET['delcat'] );
       $delcat = $cat->delCatById($id);
   }


 ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Category
            <small>Products category List</small>
        </h1>
    </section>

     <?php 
         if( isset($delcat) ){
            echo $delcat;
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
                                    <th>Category Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
             <?php 

                 $getCat = $cat->getAllCat();
                 if( $getCat ){
                    $i = 0;
                    while( $result = $getCat->fetch_assoc() ){
                           $i++; 

            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td> <?php echo $result['catName']; ?></td>
                                    <td><a href="catedit.php?catid=<?php echo $result['catId']; ?>" class="btn btn-info">Edit</a>  <a onclick=" return confirm('Are You Sure To Delete'); " href="?delcat=<?php echo $result['catId']; ?>" class="btn btn-danger">Delete</a></td>
                                </tr>
            <?php }  }  ?>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>Serial No</th>
                                    <th>Category Name</th>
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
