
    <?php
    require '../connection.php';
    $id = 0;
    if (isset($_GET['id'])) {

        $id = htmlspecialchars($_GET["id"]);
        $status = htmlspecialchars($_GET["share"]);
        
        $SQL = " update books set Status=".$status.",update_date=CURTIME(),update_by='Essa' WHERE 	serial =".$id;
        mysqli_select_db($con, "librarydb1");
        $retval = mysqli_query($con, $SQL);

        if (!$retval) {
            die('Could not update data: ' . mysqli_error($con));
            echo 'Hello1' . mysqli_error($con).$SQL;
        } else {
                        echo 'Hello1' . mysqli_error($con);

              header('Location:bookdetail.php?id='.$id);
        }
    } else {
        header('Location:404.php');
    }
     