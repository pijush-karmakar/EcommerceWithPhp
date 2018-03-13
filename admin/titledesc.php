<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Title & Description
            <small>Update Site Title & Description</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
       <div class="container-fluid">
     <div class="row">

        <div class="col-md-12">
            <div class="box box-info">

                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                    <div class="box-body">

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Website Title</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Website Description</label>
                            <div class="col-sm-10">
                                <textarea  rows="3" placeholder="Enter ..."></textarea>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-default">Cancel</button>
                        <button type="submit" class="btn btn-info pull-right">Update</button>
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
