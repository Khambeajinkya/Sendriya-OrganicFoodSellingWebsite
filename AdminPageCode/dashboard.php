<?php include('header.php') ?>
<?php include('sidebar.php') 
//http://localhost/sendriyat/admin/dashboard.php ?>
<?php include('../includes/config.php');
//for users
$totalUsers = "SELECT * FROM `users`";
    $result = mysqli_query($db_conn, $totalUsers);
    $numExistsRows = mysqli_num_rows($result);
    //echo $numExistsRows;
//for total orders
$totalOrders = "SELECT * FROM `orders`";
    $result1 = mysqli_query($db_conn, $totalOrders);
    $orderExistsRows = mysqli_num_rows($result1);
   
//for completed orders
$compOrders = "SELECT * FROM `orders` WHERE delivered='true'";
    $result2 = mysqli_query($db_conn, $compOrders);
    $cOrderExistsRows = mysqli_num_rows($result2);
//for total products
$totalProducts = "SELECT * FROM `products`";
    $result3 = mysqli_query($db_conn, $totalProducts);
    $productExistsRows = mysqli_num_rows($result3);
 ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Orders</span>
                <span class="info-box-number">
                 <?php echo  $orderExistsRows;?>
                  <small></small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Completed orders</span>
                <span class="info-box-number"><?php echo  $cOrderExistsRows;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Products</span>
                <span class="info-box-number"><?php echo  $productExistsRows;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Customers </span>
                <span class="info-box-number"><?php echo  $numExistsRows;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>

<?php include('footer.php') ?>