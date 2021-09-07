<htm><head>
    <title>
        Deleted Books
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="Design/bootstrap-4.0.0/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="Design/bootstrap-4.0.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="Design/bootstrap-4.0.0/css/bootstrap-grid.css" rel="stylesheet" type="text/css">
<link href="../Users/dashboard.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <style>
        body  {

            background-image: url("../upload/library.jpg");
            background-repeat: round;
            background-attachment: scroll;
        }</style>
    <body style="opacity: 0.95;" >

    

        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="books.php">Bookstore</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                       
                        <li><a href="books.php">Go Back</a></li>
                    </ul>
                </div>

            </div>

        </nav>




        <div class="container">
           <div class="container" >
                <div style="background-color: white;padding-left: 100px;opacity: .8">
                    <h2>Deleted Books</h2>
          
                    <p  >By Click on Delete Books will be deleted forever</p>  
                      <p class="alert-heading">By Click on Return Books will be Returned Book to be Used</p>            
              
                </div>
                
                <table style="background-color: EEFF80;" class="table table-hover table-bordered table-condensed container ">
                    <thead>
                        <tr>

                            <th>#</th>
                            <th>Title</th>
                            <th>Genre</th>
                            <th>Author</th>
                            <th>Language</th>
                            <th>Inserted Date</th>
                            <th>Archived Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require '../connection.php';
                        $id = 0;
                        if (isset($_GET['id'])) {

                            $id = htmlspecialchars($_GET["id"]);

                            $SQL = "INSERT INTO books_archive (serial,title,Genre,author,publisher,pages,description,image_url,buy_url,likes,dislikes,note,pub_num, language,Date_inserted,Inserted_by) SELECT serial,title,genre,author,publisher,pages,description,image_url,buy_url,likes,dislikes,note,pub_num,language,Date_inserted,Inserted_by FROM books WHERE serial =" . $id;

                            mysqli_select_db($con, "librarydb1");

                            if (!mysqli_query($con, $SQL)) {
                                echo mysqli_error($con);
                            } else {
                                $SQL_Archive = "select * from books_archive where serial=" . $id;
                                mysqli_select_db($con, "librarydb1");
                                $myData = mysqli_query($con, $SQL_Archive);

                                if (mysqli_fetch_array($myData)) {

                                    $SQL_delete = "delete  from books where serial=" . $id;
                                    mysqli_select_db($con, "librarydb1");
                                    $result3 = mysqli_query($con, $SQL_delete) or die(mysql_error());
                                    //mysqli_num_rows($result3);
                                    //     header('Location:books.php');
                                } else {
                                    echo '' . mysqli_error($con);
                                }
                            }
                        } else {
                            
                        }
                        require '../connection.php';
                        $SQL = "select * from books_archive";
                        mysqli_select_db($con, "librarydb1");
                        $myData = mysqli_query($con, $SQL);
                        $sequence = 0;
                        while ($record = mysqli_fetch_array($myData)) {
                            $id = $record['serial'];
                            $sequence += 1;
                            ?>

                            <tr>
                                <td><?php echo $sequence ?></td>
                                <td><?php echo $record['title']; ?></td>
                                <td><?php echo $record['Genre']; ?></td>
                                <td><?php echo $record['author']; ?></td>
                                <td><?php echo $record['language']; ?></td>
                                <td><?php echo $record['Date_inserted']; ?></td>
                                <td><?php echo $record['Date_archived']; ?></td>
                                <td> <?php echo ' <a href="returnbook.php?id=' . $record['serial'] . '">Return</a> |  <a href="deleteever.php?id=' . $id . '">Delete</a> '; ?></td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>

</htm>