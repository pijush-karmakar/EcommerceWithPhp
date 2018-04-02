<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Cart.php'; ?>


<?php 

 $ct = new Cart();
 $fm = new Format();
 if( isset($_GET['shiftId']) ){

    $id    = $_GET['shiftId'];
    $price = $_GET['price'];
    $date  = $_GET['time'];

   $shift = $ct->productShifted($id,$price,$date);
 }

 if( isset($_GET['delId']) ){

    $id    = $_GET['delId'];
    $price = $_GET['price'];
    $date  = $_GET['time'];

   $delshift = $ct->delProductShifted($id,$price,$date);
 }
 


 ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Order Details
            <small>customer order Lists</small>
        </h1>
    </section>
<?php 

if( isset($shift) ){
    echo $shift;    
}
if( isset($delshift) ){
    echo $delshift;    
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
                                    <th>ID</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Cust. ID</th>
                                    <th>Address</th>
                                    <th>Date & Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
        <?php 

          $getOrder = $ct->getCustomerOrder();
          if( $getOrder ){
             while( $result = $getOrder->fetch_assoc() ){

         ?>
                                <tr>
                                    <td><a href="singleProduct.php?productID=<?php echo $result['productId']; ?>"><?php echo $result['id']; ?></a></td>
                                    <td><?php echo $result['productName']; ?></td>
                                    <td><?php echo $result['quantity']; ?></td>
                                    <td>$<?php echo $result['price']; ?></td>
                                    <td><?php echo $result['customerId']; ?></td>
                                    <td><a href="customer.php?customerId=<?php echo $result['customerId']; ?>">View Details</a></td>
                                    <td><?php echo $fm->formatDate($result['date'] ); ?></td>
                                    <?php 
                                       if( $result['status']=='0' ){ ?>
                                            <td>
                                                <a href="?shiftId=<?php echo $result['customerId'];?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date']; ?>">Shifted</a>
                                            </td>
                                     

                                     <?php } elseif( $result['status']=='1' ){  ?>

                                    <td> Pending </td>

                                    <?php } else{  ?>
                                           <td>
                                              <a href="?delId=<?php echo $result['customerId'];?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date']; ?>">Remove</a>
                                         </td>
                                    <?php }   ?>
                                </tr>
        <?php }  } ?>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Cust. ID</th>
                                    <th>Address</th>
                                    <th>Date & Time</th>
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
