<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php'; ?>

<?php 
   $brand = new Brand();
   if( isset($_GET['delbrand']) ){
       $id = $_GET['delbrand'];
       $id = preg_replace('/[^-a-zA-Z0-9_]/', '',  $_GET['delbrand'] );
       $delbrand = $brand->delbrandById($id);
   }


 ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Brand
            <small> Brand List</small>
        </h1>
    </section>

    <?php 
         if( isset($delbrand) ){
            echo $delbrand;
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
                                    <th>Brand Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
             <?php 

                 $getBrand = $brand->getAllBrand();
                 if( $getBrand ){
                    $i = 0;
                    while( $result = $getBrand->fetch_assoc() ){
                           $i++; 

            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td> <?php echo $result['brandName']; ?></td>
                                    <td><a href="brandedit.php?brandid=<?php echo $result['brandId']; ?>" class="btn btn-info">Edit</a>  <a onclick=" return confirm('Are You Sure To Delete'); " href="?delbrand=<?php echo $result['brandId']; ?>" class="btn btn-danger">Delete</a></td>
                                </tr>
            <?php }  }  ?>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>Serial No</th>
                                    <th>Brand Name</th>
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
