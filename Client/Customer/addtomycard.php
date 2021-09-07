
<?php

require '../../Admin/connection.php';
$id = 0;
if (isset($_GET['id'])) {

    $id = htmlspecialchars($_GET["id"]);
    $addtocart = htmlspecialchars($_GET["addtocart"]);
 if (!isset($_SESSION)) {
        session_start();
    } if ($_SESSION['name'] <> "") {
        $email = $_SESSION['email'];
        $name = $_SESSION['name'];
        $group = $_SESSION['group'];
        $job = $_SESSION['Job'];
    }

    if ($addtocart == 1) {
        $SQL = "insert into books_favour (book_id,owner,date_inserted)
    VALUES(" . $id . ",'".$_SESSION['email']."',CURTIME())";
    } else {
        $SQL = "delete from  books_favour where book_id=" . $id." and owner =lower('".$email."')";
    }
    mysqli_select_db($con, "librarydb1");
    $retval = mysqli_query($con, $SQL);
    if (!$retval) {
        die('Could not insert data: ' . mysql_error());
        echo 'Hello1' . mysqli_error($con);
    } else {
        header('Location:bookdetail.php?id=' . $id);
    }
} else {
    header('Location:404.php');
}
     