
<?php

require '../../Admin/connection.php';
$id = 0;
if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET["id"]);
    $like = htmlspecialchars($_GET["like"]);
    $dislike = htmlspecialchars($_GET["dislike"]);
    if (!isset($_SESSION)) {
        session_start();
    } if ($_SESSION['name'] <> "") {
        $email = $_SESSION['email'];
        $name = $_SESSION['name'];
        $group = $_SESSION['group'];
        $job = $_SESSION['Job'];
    }
    $sqllikes = "select * from book_likes where owner=lower('" . $_SESSION['name'] . "') and  book_id=" . $id;
    mysqli_select_db($con, "librarydb1");
    echo 'Hello2'.$sqllikes;
    $result = mysqli_query($con, $sqllikes) or die(mysql_error());
    if (mysqli_num_rows($result) == 1) {


        echo 'Hello2' . mysqli_error($con);


        $SQL = " UPDATE book_likes set likes =" . $like . " , dislike=" . $dislike . ", update_date=CURTIME() where book_id=" . $id." and owner=lower('" . $_SESSION['name'] ."')";
        mysqli_select_db($con, "librarydb1");
        echo 'Hello5'.$sqllikes;
        $retval = mysqli_query($con, $SQL);
        if (!$retval) {echo 'Hello6' . mysqli_error($con)."SQL = ".$SQL;
            die('Could not update data: ' . mysql_error());
            
        } else {
            header('Location:bookdetail.php?id=' . $id);
        }
    } else {
        echo 'Hello3' . mysqli_error($con);
        $SQL = "insert into book_likes (book_id,owner,likes,dislike,update_date)
        VALUES(" . $id . ",lower('" . $_SESSION['name'] . "')," . $like . "," . $dislike . ",CURTIME())";

        mysqli_select_db($con, "librarydb1");
        $retval = mysqli_query($con, $SQL);
        echo 'Hello1' . mysqli_error($con);
        if (!$retval) {
            echo 'Hello1' . mysqli_error($con);
            die('Could not insert data: ' . mysql_error());
            
        } else {
            header('Location:bookdetail.php?id=' . $id);
        }
    }
}
        