
<?php
$email='';
$name = '';

if (!isset($_SESSION)) {
    session_start();
} if ($_SESSION['name'] <> "") {

    $email = $_SESSION['email'];
    $name = $_SESSION['name'];
    $lname = $_SESSION['lname'];
    $group = $_SESSION['group'];
    $job = $_SESSION['Job'];
}

require '../../Admin/connection.php';
$id = 0;
if (isset($_GET['id'])) {

    $id = htmlspecialchars($_GET["id"]);
    $order = htmlspecialchars($_GET["order"]);
    $title = htmlspecialchars($_GET["title"]);
    $price = htmlspecialchars($_GET["price"]);
    if ($order == 1) {
        $SQL = "insert into book_order (book_id,Title,owner,QTY,Price,status,date_inserted)
    VALUES(" . $id . ",'" . $title . "','" . $_SESSION['email'] . "',1," . $price . ",'ordered',CURTIME())";
    } else {
        if ($order == 0) {
            $SQL = "delete from  book_order where owner='" . $email. "' and  book_id=" . $id;
        }
    }
    mysqli_select_db($con, "librarydb1");
    $retval = mysqli_query($con, $SQL);
    if (!$retval) {
        die('Could not insert data: '.$email . mysql_error().$SQL);
        echo 'Hello1' . mysqli_error($con);
    } else {
        header('Location:bookdetail.php?id=' . $id);
        
    }
} else {
    header('Location:404.php');
}
     