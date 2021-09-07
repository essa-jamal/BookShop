<?php
require '../connection.php';
$id = htmlspecialchars($_GET["id"]);

$SQL_delete = " delete  from books_archive where serial=" . $id;
mysqli_select_db($con, "librarydb1");
$result3 = mysqli_query($con, $SQL_delete) or die(mysql_error());
     header('Location:deletebook.php');
?>