<?php
echo "Logging you out, please wait";

session_start();

session_unset();

session_destroy();

header("location:index.php");

exit;

?>