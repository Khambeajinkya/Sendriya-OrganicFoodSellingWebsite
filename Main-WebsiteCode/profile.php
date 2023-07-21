
<?php
include('./includes/config.php');
$query = mysqli_query($db_conn, 'SELECT * FROM `users` WHERE email=$email');
$user_details = mysqli_fetch_assoc($query); 
//print_r($user_details['name']);

?>


<?php include 'header.php'?>
<div class="modal fade" id="add-modal">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Profile</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="" placeholder="Title" required class="form-control">
          </div>

          <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <div class="input-group">
              <div class="productImg">
                <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="title">Category</label>
            <select name="category" id="category" name="category" class="form-control">
              <?php
              $query = mysqli_query($db_conn, 'SELECT * FROM categories');
              $count = 1;
              while ($category = mysqli_fetch_object($query)) { ?>
                <option value=<?= $category->title ?>><?= $category->title ?></option>

                <?php $count++;
              } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="title">Description</label>
            <input type="text" name="description" id="" placeholder="Description" class="form-control">
          </div>
          <div class="form-group">
            <label for="title">Price</label>
            <input type="number" name="price" id="" placeholder="Price" required class="form-control">
          </div>
          <div class="form-group">
            <label for="title">Quantity</label>
            <input type="number" name="quantity" id="" placeholder="Quantity" required class="form-control">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button class="btn btn-primary" name="submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
<section class="content">
  <div class="row">
    <div class="col-md-12">

      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <h3 class="profile-username text-center"><?= $user_details->name ?></h3>

          <p class="text-muted text-center">omkarnipane01@gmail.com</p>

          <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
              <b>Phone:</b> <a class="float-right">+91 84199 44604</a>
            </li>
            <li class="list-group-item">
              <b>Address:</b> <a class="float-right">Sangharsha Nagar, Chandiavali, 19-D, Social Society, Room No.: 1901, Andheri(e), Mumbai-400072</a>
            </li>
            <li class="list-group-item">
              <b>Orders:</b> <a class="float-right" href="my-orders.php">Click</a>
            </li>
            <li class="list-group-item">
              <b>Change Password:</b> <a class="float-right">Change Here</a>
            </li>
            <li class="list-group-item">
             <div class="card-header py-2">
              <div class="card-tools">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add-modal">
                  <i class="fa fa-edit mr-2"></i>Edit Profile
                </button>
              </div>
            </div>
          </li>
        </ul>

        <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
      </div>
      <!-- /.card-body -->
    </div>

    <!-- /.card -->
  </div>

</div>
</section>




<?php include 'footer.php'?>