<?php
echo "Logging you out, please wait";

session_start();

session_unset();

session_destroy();

header("location:http://localhost/phptuts/tuts47-Php_Forum/index.php");

exit;

?>