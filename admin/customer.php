<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Customer.php'; ?>

<?php 

if( !isset($_GET['customerId']) || $_GET['customerId']==NULL ){
    echo '<script>window.location = "customerorder.php";</script>';
}
else{
   $id = preg_replace('/[^-a-zA-Z0-9_]/', '',  $_GET['customerId'] );
}


?>

<?php  
     
     if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
       echo '<script>window.location = "customerorder.php";</script>';
   }

 ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Customer Details
        </h1>
    </section>
   
    <!-- Main content -->
    <section class="content">
        <div class="row">
        <div class="col-md-12">
            <div class="box box-info">



                <?php 
                    $cust = new Customer ();
                    $getCust = $cust->getCustomerData($id);
                    if($getCust){
                        while( $result = $getCust->fetch_assoc() ){
                ?>
                
                <form class="form-horizontal" action=" " method="post">
                    
                    <div class="box-body">

                        <div class="form-group">     
                            <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" readonly="readonly" class="form-control" id="inputEmail3" value="<?php echo $result['name']; ?>" >
                            </div>
                        </div>

                        <div class="form-group">     
                            <label for="inputEmail3" class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-10">
                                <input type="text" readonly="readonly" class="form-control" id="inputEmail3" value="<?php echo $result['address']; ?>" >
                            </div>
                        </div>

                        <div class="form-group">     
                            <label for="inputEmail3" class="col-sm-2 control-label">City</label>
                            <div class="col-sm-10">
                                <input type="text" readonly="readonly" class="form-control" id="inputEmail3" value="<?php echo $result['city']; ?>" >
                            </div>
                        </div>

                        <div class="form-group">     
                            <label for="inputEmail3" class="col-sm-2 control-label">Country</label>
                            <div class="col-sm-10">
                                <input type="text" readonly="readonly" class="form-control" id="inputEmail3" value="<?php echo $result['country']; ?>" >
                            </div>
                        </div>

                        <div class="form-group">     
                            <label for="inputEmail3" class="col-sm-2 control-label">Zip-Code</label>
                            <div class="col-sm-10">
                                <input type="text" readonly="readonly" class="form-control" id="inputEmail3" value="<?php echo $result['zip']; ?>" >
                            </div>
                        </div>

                        <div class="form-group">     
                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" readonly="readonly" class="form-control" id="inputEmail3" value="<?php echo $result['email']; ?>" >
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                      
                        <button type="submit" class="btn btn-info pull-right">Ok</button>
                    </div>
                    <!-- /.box-footer -->
                </form>

                <?php  }  }  ?>

            </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php include 'inc/footer.php'; ?>
