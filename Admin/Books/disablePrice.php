
<?php

require '../connection.php';
$id = 0;
if (isset($_GET['id'])) {

    $id = htmlspecialchars($_GET["id"]);
    $status = htmlspecialchars($_GET["status"]);
    $bookid = htmlspecialchars($_GET["bookid"]);
    
        $checkSQL = "select * from book_price where status=1 and status=".$status." and book_id= " . $bookid;
        if (mysqli_num_rows(mysqli_query($con, $checkSQL)) > 0) {
          //  echo 'already exist';
             header('Location:book_price.php');
        }
        
     else {
        $SQL = " update book_price set status=" . $status . ",updated_date=CURTIME(),updated_by='admin' WHERE id =" . $id;
        mysqli_select_db($con, "librarydb1");
        $retval = mysqli_query($con, $SQL);
        if (!$retval) {
            die('Could not update data: ' . mysql_error());
            echo 'Hello1' . mysqli_error($con);
        } else {
            header('Location:book_price.php');
        }
    }
} else {
    header('Location:404.php');
}
     