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
        <link href="../Users/dashboard.css" type="text/css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body  {

                background-image: url("../upload/library.jpg");
                background-repeat: round;
                background-attachment: scroll;
            }</style>
    </head>
    <body style="opacity: 0.95">






        <?php
        if (isset($_POST['addbtn'])) {


            require '../connection.php';



            mysqli_select_db($con, "librarydb1");
            $SQL = " Insert into books (title,genre,author,publisher,pages,description,image_url,buy_url,note,pub_num,language,date_inserted)values ( '"
                    . $_POST['title'] . "','" . $_POST['genre'] . "','" . $_POST['author'] . "','" . $_POST['publisher'] . "','" . $_POST['pages'] . "','"
                    . $_POST['description'] . "','" . $_POST['image_url'] . "','" . $_POST['buy_url'] . "','" . $_POST['note'] . "','" . $_POST['pub_num'] . "','" . $_POST['language'] . "',CURTIME()) ";
            if (mysqli_query($con, $SQL)) {

                echo "<br/>Intserted Successfully ...";
            } else {
                echo mysqli_error($con);
                echo 'error';
            }
        } else {
            // echo 'no button selected';
            header('location=users.php');
        }
        ?> 

        <nav class="navbar navbar-default" id="navbar">

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

        <div class="container jumbotron">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Add Book</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form  method="post" action="addbook.php">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" maxlength="100"  required name="title" placeholder="Title">
                                </div>
                                <div class="form-group">
                                    <label>Genre</label>
                                    <select name="genre" class="form-control" >

<?php
require '../connection.php';
$SQL = "select * from genre order by sort desc";
$myData = mysqli_query($con, $SQL);
while ($record = mysqli_fetch_array($myData)) {
    echo "<option value='" . $record['title'] . "'>" . $record['title'] . "</option>";
}
?>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Author</label>
                                    <input type="text" class="form-control" maxlength="30" required name="author" placeholder="Author">
                                </div>
                                <div class="form-group">
                                    <label>Publisher</label>
                                    <input type="text" class="form-control" maxlength="30" required name="publisher" placeholder="Publisher">
                                </div>
                                <div class="form-group">
                                    <label>Pages</label>
                                    <input type="number" class="form-control" maxlength="5" required name="pages" placeholder="No of Pages">
                                </div>
                                <div class="form-group">
                                    <label>Language</label>
                                    <input type="text" class="form-control" maxlength="15" required name="language" placeholder="language">
                                </div>
                                <div class="form-group">
                                    <label>publish Number</label>
                                    <input type="text" class="form-control" maxlength="15" required name="pub_num" placeholder="Pages">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" maxlength="500" required name="description" placeholder="Description"></textarea>
                                </div>
                                <a href="upload.php">upload image</a>   
                                <div class="form-group">
                                    <label>Image Name</label>
                                    <input type="text" class="form-control" maxlength="30" target="_blank" required name="image_url" placeholder="Image URL" >
                                </div>

                                <div class="form-group">
                                    <label>Share Status</label>
                                    <input type="text" class="form-control" required maxlength="30"  name="buy_url" placeholder="Share Status = 1">
                                </div>
                                <div class="form-group">
                                    <label>note</label>
                                    <textarea class="form-control" name="note" maxlength="300" placeholder="make a note"></textarea>
                                </div>
                                <button type="submit" name="addbtn" class="btn btn-default">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script >

            window.onscroll = function () {
                myFunction()
            };

            var navbar = document.getElementById("navbar");
            var sticky = navbar.offsetTop;

            function myFunction() {
                if (window.pageYOffset >= sticky) {
                    navbar.classList.add("sticky")

                } else {
                    navbar.classList.remove("sticky");
                }
            }
        </script>
    </body>

</html>
