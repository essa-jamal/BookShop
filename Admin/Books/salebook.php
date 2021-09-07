
<?php

require '../connection.php';
$id = 0;
if (isset($_GET['id'])) {

    $id = htmlspecialchars($_GET["id"]);
    $status = htmlspecialchars($_GET["status"]);
    if ($status == 'archived') {
        $SQL1 = " INSERT INTO book_sale (order_id,book_id,title,owner,status,qty,price,Date_inserted,Inserted_by)  SELECT id,book_id,title,owner,'System',qty,price,CURTIME(),'admin' FROM book_order WHERE id =" . $id;
    $retval = mysqli_query($con, $SQL1);
    if (!$retval) {
        die('Could not update data: ' . mysql_error() );
    }
    else        echo 'error on insert '. mysql_error();
}
        $SQL = " update book_order set status='" . $status . "',date_updated=CURTIME(),updated_by='admin' WHERE id =" . $id;
     mysqli_select_db($con, "librarydb1");
    $retval = mysqli_query($con, $SQL);
    if (!$retval) {
        die('Could not update data: ' . mysql_error() . '' . $SQL);
        echo 'Hello1' . mysqli_error($con);
    } else {
        header('Location:../../Client/Customer/myOrders.php');
    }
} else {
    header('Location:404.php');
}

     