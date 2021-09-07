<html>
    <head>
        <title>
            Add Book
        </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="Design/bootstrap-4.0.0/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="Design/bootstrap-4.0.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="Design/bootstrap-4.0.0/css/bootstrap-grid.css" rel="stylesheet" type="text/css">
        <link href="../Users/dashboard.css" rel="stylesheet" type="text/css">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body  {

                background-image: url("../upload/library.jpg");
                background-repeat: round;
                background-attachment: scroll;
            }
        </style>
    </head>
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
                </div><!--/.nav-collapse -->

            </div>
        </nav>
        <div class="container">

            <?php
            require '../connection.php';
            $id = htmlspecialchars($_GET["id"]);

            $SQL = "select * from books where serial=" . $id;
            mysqli_select_db($con, "librarydb1");
            $result = mysqli_query($con, $SQL) or die(mysql_error());
            if (mysqli_num_rows($result) <> 1) {
                echo 'User not Selected';
            } else {


                while ($row = mysqli_fetch_array($result)) {


                    if ($row['Status'] == 1) {

                        $status = 'Yes.';
                    } elseif ($row['Status'] == 0) {

                        $status = 'No.';
                    } else
                        $status = 'Archived';

                    echo '<div class="panel panel-default" > '
                    . '<div class = "panel-heading">' .
                    '<h3 class = "panel-title">' . $row['title'] . '</h3>'
                    . '</div> ' .
                    '<div class = "panel-body">' .
                    '<div class = "row">' .
                    '<div class = "col-md-4">' .
                    '<img style="width:100%;" src = "../upload/' . $row['image_url'] . '">' .
                    '</div>' .
                    '<div class = "col-md-8">' .
                    '</p>' . $row['description'] . '</p>' .
                    '<ul class = "list-group">' .
                    '<li class = "list-group-item">Genre: ' . $row['Genre'] . '</li>' .
                    '<li class = "list-group-item">Author: ' . $row['author'] . '</li>' .
                    '<li class = "list-group-item">Publisher: ' . $row['publisher'] . '</li>' .
                    '<li class = "list-group-item">Pages: ' . $row['pages'] . '</li>' .
                    '<li class = "list-group-item">Language: ' . $row['language'] . '</li>' .
                    '<li class = "list-group-item">ISBN No: ' . $row['pub_num'] . '</li>' .
                    '<li class = "list-group-item">Shared: ' . $status . '</li>' .
                    '<li class = "list-group-item">Note: ' . $row['note'] . '</li>' ;
                     $sqllikes = "select sum(likes) as likes,sum(dislike) as dislike from book_likes where book_id=" . $row['serial'];
                    mysqli_select_db($con, "librarydb1");
                    $result = mysqli_query($con, $sqllikes) or die(mysql_error());
                    if (mysqli_num_rows($result) <> 1) {
                        echo ' not Selected';
                    } else {


                        while ($row1 = mysqli_fetch_array($result)) {





                                    echo '<li class = "list-group-item">Likes: ' . $row1['likes'] . '<span style=padding-left:100px;>Dislikes: ' . $row1['dislike'] . '</span></li>' ;

                                    '</ul>';
                        }
                    }
                            
                    echo '</ul>';
                    if ($row['Status'] == 1) {
                        echo '<a   class = "btn btn-success" href="shareBook.php?id=' . $row['serial'] . '&share=0">UnShared For Sale</a>';
                    } else {
                        echo '<a   class = "btn btn-primary" href="shareBook.php?id=' . $row['serial'] . '&share=1">Share For Sale</a>';
                    }
                    echo '</div>' .
                    '</div>' .
                   
                    ' <div class="pull-right">' .
                    ' <a href="updatebook.php?id=' . $row['serial'] . '&return=0">Edit</a> |  <a href="deletebook.php?id=' . $row['serial'] . '">Delete</a> ' .
                    ' </div>         </div>';
                }
            }
            ?>




        </div>
    </body>
</html>