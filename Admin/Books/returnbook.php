<htm><body>
        <?php
        require '../connection.php';
        $id = 0;
        


            $id = htmlspecialchars($_GET["id"]);

            $SQL = " INSERT INTO books (serial,title,Genre,author,publisher,pages,description,image_url,buy_url,likes,dislikes,note,pub_num,language,Date_inserted,Inserted_by) "
                    . " SELECT  serial,title,Genre,author,publisher,pages,description,image_url,buy_url,likes,dislikes,note,pub_num,language,Date_inserted,Inserted_by from books_archive  WHERE serial =" . $id;

            mysqli_select_db($con, "librarydb1");

            if (!mysqli_query($con, $SQL)) {
                echo 'insert issue' . mysqli_error($con);
            } else {
                $SQL_Archive = "select * from books where serial=" . $id;
                mysqli_select_db($con, "librarydb1");
                $myData = mysqli_query($con, $SQL_Archive);
                echo 'after inert';
                if (mysqli_fetch_array($myData)) {
                    echo 'after select';
                    $SQL_delete = " delete  from books_archive where serial=" . $id;
                    mysqli_select_db($con, "librarydb1");
                    $result3 = mysqli_query($con, $SQL_delete) or die(mysql_error());
                    //mysqli_num_rows($result3);
                    echo 'after delete';
                    header('Location:books.php');
                } else {
                    echo 'after last';
                    echo '' . mysqli_error($con);
                }
            }
 
        ?>

    </body></htm>