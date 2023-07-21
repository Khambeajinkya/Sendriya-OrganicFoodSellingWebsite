<?php include('../includes/config.php') ?>

<?php include('header.php') ?>

<?php
if (isset($_GET['delete'])) {
    $dId = $_GET['delete'];
    // echo $sno;
    $delete = true;
    $sql = "DELETE FROM `categories` WHERE `categories`.`id` = '$dId'";
    mysqli_query($db_conn, $sql);
}

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    // mysqli_query($db_conn,"INSERT INTO sections(title,section) VALUE ('$title,$section')") or die(mysqli_error($db_conn));
    mysqli_query($db_conn, "INSERT INTO `categories` (`title`) VALUES ('$title')") or die(mysqli_error($db_conn));
}

if (isset($_POST['update'])) {
    $editId = $_POST['editId'];
    $title = $_POST['eTitle'];
    // mysqli_query($db_conn,"INSERT INTO sections(title,section) VALUE ('$title,$section')") or die(mysqli_error($db_conn));
    mysqli_query($db_conn, "UPDATE `categories` SET `title` = '$title' WHERE `categories`.`id` = $editId;") or die(mysqli_error($db_conn));
    
}
?>

<?php include('sidebar.php') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- MODAL START FOR UPDATING -->

    <div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="editId" id="editId">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="eTitle" name="eTitle">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="update" name="update" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MODAL End FOR UPDATING -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Sections</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Sections</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header py-2">
                            <h3 class="card-title">Classes</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered bg-white">
                                    <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>Title</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        $category_query = mysqli_query($db_conn, 'SELECT * from categories');
                                        while ($category = mysqli_fetch_object($category_query)) { ?>
                                            <tr>
                                                <td><?= $count++ ?></td>
                                                <td><?= $category->title ?></td>
                                                <td>
                                                    <button id="<?= $category->id ?>" class="edit btn btn-warning">Edit</button>
                                                    <button id="d<?= $category->id ?>" class="delete btn btn-danger">Delete</button>
                                                </td>
                                            </tr>

                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header py-2">
                            <h3 class="card-title">Add New Section</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="" placeholder="Title" required class="form-control">
                                </div>

                                <button class="btn btn-success float-right" name="submit">Submit</button>
                            </form>
                        </div>
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
            tr = e.target.parentNode.parentNode;
            title = tr.getElementsByTagName("td")[1].innerText;

            editId.value = e.target.id
            eTitle.value = title;
            $('#edit-modal').modal('toggle');
        })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
        element.addEventListener("click", (e) => {
            dId = e.target.id.substr(1, ); //substr(1, ) delete 'd' from id of delete button search substr on google

            if (confirm("Are You Sure You Want To Delete This Category")) {
                // console.log("yes")
                window.location = `category.php?delete=${dId}`;
                // TODO: Create a form and use post request to submit a form
            } else {
                console.log("no")
            }
        })
    })
</script>

<?php include('footer.php') ?>