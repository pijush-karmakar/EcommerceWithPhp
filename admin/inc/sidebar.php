



<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>

            <div class="pull-left info">
                <p><?php echo Session::get('adminName'); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>

            <li class="treeview">
                <a href="../index.php" target="_blank">
                    <i class="fa fa-th"></i> <span>Visit Website</span>
                </a>
            </li>

            <li class="treeview">
                <a href="dashboard.php">
                    <i class="fa fa-home"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Site Option</span>
                    <span class="pull-right-container">
              <i class="fa fa-plus-square pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="titledesc.php"><i class="fa fa-file-text-o"></i> Title & Description</a></li>
                    <li><a href="social.php"><i class="fa fa-share-alt"></i>Social Media</a></li>
                    <li><a href="copyright.php"><i class="fa fa-pencil"></i>Copyright</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-clone"></i> <span>Update Pages</span>
                    <span class="pull-right-container">
              <i class="fa fa-plus-square pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="index.php"><i class="fa fa-circle-o"></i>About Us</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i>Contact Us</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-server"></i> <span>Sliders</span>
                    <span class="pull-right-container">
              <i class="fa fa-plus-square pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="slideradd.php"><i class="fa fa-pencil-square-o"></i>ADD Slider</a></li>
                    <li><a href="sliderlist.php"><i class="fa fa-outdent"></i>Slider List</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gg"></i> <span>Categories</span>
                    <span class="pull-right-container">
              <i class="fa fa-plus-square pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="catadd.php"><i class="fa fa-pencil-square-o"></i> ADD categories</a></li>
                    <li><a href="catlist.php"><i class="fa fa-list"></i>Categories List</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cube"></i> <span>Order Details</span>
                    <span class="pull-right-container">
              <i class="fa fa-plus-square pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="customerorder.php"><i class="fa fa-pencil-square-o"></i>Customer Order</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i> <span>Brand</span>
                    <span class="pull-right-container">
              <i class="fa fa-plus-square pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="brandadd.php"><i class="fa fa-pencil-square-o"></i> ADD Brand</a></li>
                    <li><a href="brandlist.php"><i class="fa  fa-outdent"></i>Brand List</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cube"></i> <span>Products</span>
                    <span class="pull-right-container">
              <i class="fa fa-plus-square pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="productadd.php"><i class="fa fa-pencil-square-o"></i>ADD Product</a></li>
                    <li><a href="productlist.php"><i class="fa  fa-outdent"></i>Products List</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>User Profile</span>
                    <span class="pull-right-container">
                       <i class="fa fa-plus-square pull-right"></i>
                    </span>
                </a>
                
                <ul class="treeview-menu">
                    <li><a href="changepass.php"><i class="fa fa-pencil"></i>Password</a></li>
                    <li><a href="inbox.php"><i class="fa fa-inbox"></i>Inbox</a></li>
                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
