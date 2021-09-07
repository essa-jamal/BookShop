 <?php
        require '../connection.php';
        $id = 0;
        if (isset($_GET['id'])) {
            
            $id = htmlspecialchars($_GET["id"]);
            $SQL = " delete from book_price where status=0 and id =" . $id;
            mysqli_select_db($con, "librarydb1");
            $retval = mysqli_query($con, $SQL);
            if (!$retval) {
                die('Could not Delete data: ' . mysql_error());
            } else {
                header('Location:../Books/book_price.php');
            }
        } else {
            header('Location:404.php');
        }
 