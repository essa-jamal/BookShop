<html>
    <head>
    <body>
        <?php
        $Url = "localhost";
        $User = "root";
        $Password = "";
        $con = mysqli_connect($Url, $User, $Password);
        mysqli_select_db($con, "librarydb1");

        if (!$con) {
            die("<br/> Can not connect : Error: " . mysql_error());
        } else {
            //   echo "<br/>Connection Created From 'connection.php' page";
        }
        ?>   

    </body>
</head>

</html>
