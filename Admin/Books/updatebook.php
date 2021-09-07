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

        <?php
        if (isset($_POST['updatebtn'])) {
            require '../connection.php';
            mysqli_select_db($con, "librarydb1");
            $SQL = " update  books set "
                    . " title='" . $_POST['title'] . "'"
                    . " , genre='" . $_POST['genre'] . "'"
                    . " , author='" . $_POST['author'] . "'"
                    . " , publisher='" . $_POST['publisher'] . "'"
                    . " , pages='" . $_POST['pages'] . "'"
                    . " , description='" . $_POST['description'] . "'"
                    . " , image_url='" . $_POST['image_url'] . "'"
                   
                    . " ,  note='" . $_POST['note'] . "'"
                    . " , pub_num='" . $_POST['pub_num'] . "'"
                    . " , language='" . $_POST['language'] . "'"
                    . " where serial=" . $_POST['id'];




            $retval = mysqli_query($con, $SQL);
            if (!$retval) {
                die('Could not update data: ' . mysql_error());
            } else {
                header('Location:bookdetail.php?id1=3&id=' . $_POST['id']);
            }
        } else {
            if (htmlspecialchars($_GET["id"]) == NULL) {
                header('Location:books.php');
            }
            require '../connection.php';
            $id = htmlspecialchars($_GET["id"]);
            $SQL = "select * from books where serial=" . $id;
            mysqli_select_db($con, "librarydb1");
            $result = mysqli_query($con, $SQL) or die(mysql_error());
            if (mysqli_num_rows($result) <> 1) {
                echo 'User not Selected';
            } else {
                while ($row = mysqli_fetch_array($result)) {
                    ?> 
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
                    <div class="container jumbotron">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Update Book</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form  method="post" action="updatebook.php">
                                            <div class="form-group " >
                                                <label>Title</label>
                                                <input type="text" 
                                                       accesskey=""accept="" <?php echo 'value="' . $row['title'] . '"' ?> 
                                                       class="form-control"  maxlength="30"  name="title" placeholder="Title">
                                            </div>
                                            <div class="form-group">
                                                <label>Genre</label>
                                                <select name="genre"  accesskey=""   class="form-control">
                                                    <?php
                                                    require '../connection.php';
                                                    $SQL = "select * from genre where title<> '" . $row['Genre'] . "' order by sort desc";
                                                    $myData = mysqli_query($con, $SQL);
                                                    echo "<option value='" . $row['Genre'] . "'>" . $row['Genre'] . "</option>";
                                                    while ($record = mysqli_fetch_array($myData)) {
                                                        echo "<option value='" . $record['title'] . "'>" . $record['title'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Author</label>
                                                <input type="text" maxlength="30"   <?php echo 'value="' . $row['author'] . '"' ?>  class="form-control" name="author" placeholder="Author" value="">
                                            </div>
                                            <div class="form-group">
                                                <label>Publisher</label>
                                                <input type="text" class="form-control" maxlength="30"  <?php echo 'value="' . $row['publisher'] . '"' ?>  name="publisher" placeholder="Publisher">
                                            </div>
                                            <div class="form-group">
                                                <label>Pages</label>
                                                <input type="text" maxlength="5" class="form-control"  <?php echo 'value="' . $row['pages'] . '"' ?>  name="pages" placeholder="Pages">
                                            </div>
                                            <div class="form-group">
                                                <label>Language</label>
                                                <input type="text" class="form-control" maxlength="10" name="language"  <?php echo 'value="' . $row['language'] . '"' ?>  placeholder="language">
                                            </div>
                                            <div class="form-group">
                                                <label>publish Number</label>
                                                <input type="text" class="form-control" maxlength="15" name="pub_num"  <?php echo 'value="' . $row['pub_num'] . '"' ?>  placeholder="Publish Number">
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea  class='form-control' maxlength="500" rows='3' name='description' placeholder='Description'> <?php echo $row['description']; ?></textarea>

                                            </div>
                                            <a href="upload.php" target="_blank">upload image</a>   
                                            <div class="form-group">
                                                <label>Image Name</label>
                                                <input type="text" maxlength="20" class="form-control"  <?php echo 'value="' . $row['image_url'] . '"' ?>  name="image_url" placeholder="Image URL" >
                                            </div>

                                            
                                            <div class="form-group">
                                                <label>note</label>
                                                <textarea class="form-control" name="note" maxlength="50"  placeholder="make a note"></textarea>
                                            </div>
                                            <input type="hidden" class="form-control" name="id"  <?php echo 'value="' . $row['serial'] . '"' ?> >
                                            <button type="submit" name="updatebtn" class="btn btn-default">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                }
            }
        }
        ?>
    </body>

</html>
