<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/phptuts/tuts47-Php_Forum/index.php">iDiscuss</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/phptuts/tuts47-Php_Forum/index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/phptuts/tuts47-Php_Forum/about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Categories
        </a>
        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
          <?php
          include 'partials/_dbconnect.php';
          $sql = "SELECT * FROM `categories` LIMIT 5";
          $result = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_array($result)) {
            $catname = $row['category_name'];
           echo'<a class="dropdown-item text-primary"  href="/phptuts/tuts47-Php_Forum/threadlist/'.$catname.'">'.$catname.'</a>';
          }
          ?>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/phptuts/tuts47-Php_Forum/contact.php">Contact</a>
      </li>
    </ul>
    <div class="row mx-2">
    <?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
      echo'<form class="form-inline my-2 my-lg-0" action="/phptuts/tuts47-Php_Forum/search.php" method="GET">
        <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
        <p class="text-light my-0 mx-2"> Welcome '.$_SESSION['useremail'].'</p>
        <a class="btn btn-primary ml-2" href="/phptuts/tuts47-Php_Forum/partials/_logout.php">Logout</a>
      </form>';
    }
    else
    echo
      '<button class="btn btn-primary ml-2" data-toggle="modal" data-target="#loginModal">Login</button>
      <button class="btn btn-primary mx-2" data-toggle="modal" data-target="#signupModal">SignUp</button>';
    
    ?>
    </div>
  </div>
</nav>

<?php
include 'partials\_login.php';
include 'partials\_signup.php';

if(isset($_GET['signupSuccess']) && $_GET['signupSuccess'] == 'true'){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> You can now login.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
?>