<html>
    <head>
        <title>
            Books
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
            }</style>
    </head><body style="opacity: 0.95;" >

        <nav class="navbar navbar-default " id="navbar">
            <div class="container" id="nav2">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    </button>
                    <a class="navbar-brand" href="books.php">Bookstore</a>
                </div>
                <div id="navbar1" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="addbook.php">Add Book</a></li>
                        <li><a href="book_price.php">Add Book Price</a></li>
                        <li><a href="soldbook.php">Sold Books</a></li>
                        <li><a href="deletebook.php">Deleted Books</a></li>
                        <li><a href="../Users/users.php">Users</a></li>
                        <li><a href="../../Client/Customer/dashboard.php">Dashboard</a></li>
                        <li><a href="../../Client/dashboard.php">Log out</a></li>
                    </ul>
                </div>

            </div>

        </nav>

        <div class="container">
            <div class="panel panel-default" >

                <div class="panel-heading">
                    <h3 class="panel-title">Latest Books</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <?php
                        require '../connection.php';
                        // $SQL for admin
                        // $SQL for staff
                        // $SQL for customer
                        //$SQL for guest
                        $SQL = "select * from books where status in (0,1)";

                        $myData = mysqli_query($con, $SQL);

                        while ($record = mysqli_fetch_array($myData)) {

                            echo '    <div class="col-md-6">'
                            . '<div class="col-md-6">';

                            if (mb_detect_encoding($record['title']) == 'UTF-8') {
                                echo ' <h4 style="text-align:right;">' . $record['title'] . '</h4>';
                            } else {
                                echo ' <h4>' . $record['title'] . '</h4><p > ';
                            }
                            if (mb_detect_encoding($record['description']) == 'UTF-8') {
                                echo '<p style="text-align:right;">' . $record['description'] . '</p>';
                            } else {
                                echo '<p > ' . $record['description'] . '</p>';
                            }


                            require '../connection.php';
                            $SQL2 = "select * from book_price where status=1 and  book_id=" . $record['serial'];
                            $myData2 = mysqli_query($con, $SQL2);
                            while ($record2 = mysqli_fetch_array($myData2)) {
                                ?>
                                <div class="container alert-heading">
                                    <h5> Price: <?php echo $record2['price']; ?></h5>
                                    <h5> Discount: <?php echo $record2['discount'] . '&nbsp&nbsp&nbsp Discount From ' . $record2['discountfrom']; ?>  </h5>
                                </div>
                                <?php
                            }



                            echo ' <a class="btn btn-primary" href="bookdetail.php?id=' . $record['serial'] . '">View Details</a>' .
                            ' </div>' .
                            '<div class="col-md-6">' .
                            '  <img style=" width:100%;" class="thumbnail" src="../upload/' . $record['image_url'] . '">' .
                            ' </div>' .
                            '</div>';
                        }
                        ?> 
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