<?php include 'inc/header.php'; ?>

<?php 

    $logIn = Session::get("customerLogin");
    if( $logIn == false ){
        header('Location:login.php');
    }

 ?>

<style>
   .paymentSuccess{
        width: 500px;
        margin: 0 auto;
        text-align: center;
        border: 2px solid #ddd;
        padding: 40px;
        min-height: 150px;
   }
    .paymentSuccess h2{
          margin-bottom: 50px;
         border-bottom: 2px solid #ddd;
         padding: 6px;
    }
    .paymentSuccess p{
        text-align: left;
    }
    .paymentSuccess a{

    }
</style>

<div class="main">
    <div class="content">
        <div class="section group">
             <div class="paymentSuccess">
                 <h2>Success</h2>

                 <?php 
                        $customerId = Session::get("customerId");
                        $amount = $ct->payableAmount($customerId);
                        if( $amount ){
                            $sum = 0;
                            while ( $result = $amount->fetch_assoc() ) {
                                $price = $result['price'];
                                $sum = $sum + $price;
                            }
                        }
                  ?>

                 <p>Total Payable Amount (Including VAT) : $
                       <?php 
                            $vat = $sum*0.1;
                            $total = $vat+$sum;
                            echo $total;

                        ?>  
                 </p>

                 <p>Thanks for purchase.Receive your order Successfully. We will contact you ASAP with delivary details. Here is your order details.... <a href="orderdetails.php"> Visit here</a> </p>
            </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
