<?php include('../includes/config.php') ?>
<?php include('header.php') ?>
<?php

if (isset($_GET['delete'])) {
    $dId = $_GET['delete'];
    // echo $sno;
    $delete = true;
    $sql = "DELETE FROM `products` WHERE `products`.`id` = '$dId'";
    mysqli_query($db_conn, $sql);
}

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $file = $_FILES['image'];

    $filename = md5($file['name'] . time());
    $filepath = $file['tmp_name'];
    $fileerror = $file['error'];

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

    $newFileName = $filename . '.' . $ext;

    if ($fileerror == 0) {
        $destfile = 'uploads/' . $newFileName;
        // echo $destfile;
        move_uploaded_file($filepath, $destfile);
    }
    // INSERT INTO `products` (`Title`, `Category`, `Description`, `Price`, `Quantity`, `image`) VALUES ('Test', 'Cat1', 'Dummmhi Des', '56', '69', 'khkjhkkjh53434343');
    mysqli_query($db_conn, "INSERT INTO `products` (`Title`, `Category`, `Description`, `Price`, `Quantity`, `image`) VALUES ('$title', '$category', '$description', '$price', '$quantity', '$newFileName')") or die(mysqli_error($db_conn));
}
// To update
if (isset($_POST['update'])) {
    $editId = $_POST['editId'];
    $title = $_POST['eTitle'];
    $category = $_POST['eCategory'];
    $description = $_POST['eDescription'];
    $price = $_POST['ePrice'];
    $quantity = $_POST['eQuantity'];
    $file = $_FILES['eImage'];
    if ($file['name']) {
        $filename = md5($file['name'] . time());
        $filepath = $file['tmp_name'];
        $fileerror = $file['error'];

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

        $newFileName = $filename . '.' . $ext;

        if ($fileerror == 0) {
            $destfile = 'uploads/' . $newFileName;
            // echo $destfile;
            move_uploaded_file($filepath, $destfile);
            echo $filename;
        }
        mysqli_query($db_conn, "UPDATE `products` SET `Title` = '$title', `Category`='$category', `Description`='$description', `Price`='$price', `Quantity`='$quantity', `image`='$newFileName' WHERE `products`.`id` = $editId;") or die(mysqli_error($db_conn));
    } else {
        mysqli_query($db_conn, "UPDATE `products` SET `Title` = '$title', `Category`='$category', `Description`='$description', `Price`='$price', `Quantity`='$quantity' WHERE `products`.`id` = $editId;") or die(mysqli_error($db_conn));
    }
}
?>

<?php include('sidebar.php') ?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Products</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    <!-- add product Modal Start -->
    <div class="modal fade" id="add-modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Products</h4>
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
    <!-- Modal End -->



    <!-- edit modal start -->
    <div class="modal fade" id="edit-modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Products</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="editId" id="editId">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="eTitle" id="eTitle" placeholder="Title" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                                <div class="productImg">
                                    <input type="file" id="eImage" name="eImage" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title">Category</label>
                            <select id="eCategory" name="eCategory" class="form-control">
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
                            <input type="text" name="eDescription" id="eDescription" placeholder="Description" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="title">Price</label>
                            <input type="number" name="ePrice" id="ePrice" placeholder="Price" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="title">Quantity</label>
                            <input type="number" name="eQuantity" id="eQuantity" placeholder="Quantity" required class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" name="update">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- edit modal end -->

    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="card">
                <div class="card-header py-2">
                    <h3 class="card-title">Products</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-modal">
                        <i class="fa fa-plus mr-2"></i>Add New
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered bg-white">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Product Name</th>
                                    <th>Product Image</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                $product_query = mysqli_query($db_conn, 'SELECT * from products');
                                while ($product = mysqli_fetch_object($product_query)) { ?>
                                    <tr>
                                        <td><?= $count++ ?></td>
                                        <td><?= $product->Title ?></td>
                                        <td><img src="uploads/<?= $product->image ?>" alt="product image" width="auto" height=100></td>
                                        <td><?= $product->Category ?></td>
                                        <td><?= $product->Description ?></td>
                                        <td>&#8377;<?= $product->Price ?></td>
                                        <td><?= $product->Quantity ?></td>
                                        <td>
                                            <button id="<?= $product->id ?>" class="edit btn btn-warning">Edit</button>
                                            <button id="d<?= $product->id ?>" class="delete btn btn-danger">Delete</button>
                                        </td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
        element.addEventListener("click", (e) => {
            console.log("edit");
            tr = e.target.parentNode.parentNode;
            title = tr.getElementsByTagName("td")[1].innerText;
            category = tr.getElementsByTagName("td")[3].innerText;
            description = tr.getElementsByTagName("td")[4].innerText;
            price = tr.getElementsByTagName("td")[5].innerText;
            quantity = tr.getElementsByTagName("td")[6].innerText;

            editId.value = e.target.id
            eTitle.value = title;
            eCategory.value = category;
            eDescription.value = description;
            ePrice.value = price;
            eQuantity.value = quantity;
            // srnoedit.value = e.target.id;
            
            //doubt
            $('#edit-modal').modal('toggle');
        })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
        element.addEventListener("click", (e) => {
            dId = e.target.id.substr(1, ); //substr(1, ) delete 'd' from id of delete button search substr on google

            if (confirm("Are You Sure You Want To Delete This Product")) {
                // console.log("yes")
                window.location = `products.php?delete=${dId}`;
                // TODO: Create a form and use post request to submit a form
            } else {
                console.log("no")
            }
        })
    })
</script>
<?php include('footer.php') ?>