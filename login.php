<?php include 'inc/header.php'; ?>
<?php 

    $logIn = Session::get("customerLogin");
    if( $logIn == true ){
        header('Location:order.php');
    }

 ?>
<?php  
     $cm = new Customer();
     if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login']) ) {
       
       $custLog = $cm->customerLogIn($_POST);
   }

 ?>

<div class="main">
    <div class="content">
        <div class="login_panel">
            <?php 
              if( isset($custLog) ){
                echo $custLog;
               }
             ?>
            <h3>Existing Customers</h3>
            <p>Sign in with the form below.</p>
            <form action="" method="post" id="member">
                <input name="email" type="text" placeholder="Email">
                <input name="password" type="password" placeholder="password">
                <div class="buttons">
                   <div><button class="grey" name="login">Sign In</button></div>
                </div>
            </form>
            <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
            
        </div>

<?php  
     $cm = new Customer();
     if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register']) ) {
       
       $customerReg = $cm->customerRegistration( $_POST );
   }

 ?>

        <div class="register_account">
            <?php 
              if( isset($customerReg) ){
                  echo $customerReg;
               }
             ?>

            <h3>Register New Account</h3>
            <form action="" method="post">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <div>
                                    <input type="text" placeholder="Name" name="name">
                                </div>

                                <div>
                                    <input type="text" placeholder="City" name="city">
                                </div>

                                <div>
                                    <input type="text" placeholder="Zip-code" name="zip">
                                </div>
                                <div>
                                    <input type="text" placeholder="Email" name="email">
                                </div>
                            </td>
                            <td>
                                <div>
                                    <input type="text" placeholder="Address" name="address">
                                </div>
                                <div>
                                    <input type="text" placeholder="Country" name="country">
                                </div>

                                <div>
                                    <input type="text" placeholder="phone" name="phone">
                                </div>

                                <div>
                                    <input type="password" placeholder="password" name="password">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="search">
                    <div><button class="grey" name="register">Create Account</button></div>
                </div>
                <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
                <div class="clear"></div>
            </form>
        </div>
        <div class="clear"></div>
    </div>
</div>


<?php include 'inc/footer.php'; ?>
