
<?php

require '../connection.php';
$id = 0;
if (isset($_GET['id'])) {

    $id = htmlspecialchars($_GET["id"]);
    $status = htmlspecialchars($_GET["status"]);
    if (!isset($_SESSION)) {
        session_start();
    } if ($_SESSION['name'] <> "") {
        $email = $_SESSION['email'];
        $name = $_SESSION['name'];
        $group = $_SESSION['group'];
        $job = $_SESSION['Job'];
    }
    $SQL = " update users set status=" . $status . ",updated_date=CURTIME(),updated_by='".$email."' WHERE id =" . $id;
    mysqli_select_db($con, "librarydb1");
    $retval = mysqli_query($con, $SQL);
    if (!$retval) {
        die('Could not update data: ' . mysql_error());
        echo 'Hello1' . mysqli_error($con);
    } else {
        header('Location:users.php');
    }
} else {
    header('Location:404.php');
}
     