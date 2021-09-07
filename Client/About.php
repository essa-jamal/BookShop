<html>
    <head>
        <title>
            About System
        </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="Design/bootstrap-4.0.0/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="Design/bootstrap-4.0.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="Design/bootstrap-4.0.0/css/bootstrap-grid.css" rel="stylesheet" type="text/css">
        <link href="../../Users/dashboard.css" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style>
            body  {

                background-image: url("../Admin/upload/library.jpg");
                background-repeat: round;
                background-attachment: scroll;
            }</style>
    </head><body style="opacity: 0.95;" >

        <nav class="navbar navbar-default " id="navbar">
            <div class="container" id="nav2">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    </button>
                    <a class="navbar-brand" href="About.php">Bookstore</a>

                </div>
                <div id="navbar1" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                       
                        <li><a href="../Client/dashboard.php">Dashboard</a></li>

                        <li><a href="../Admin/login.php">Log in</a></li>

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
                        <div class="col-sm-2 jumbotron navbar-collapse">
                            <div class="form-group">
                                <label>Related Category</label>
                                <ul>
                                    <?php
                                    require '../Admin/connection.php';
                                    $SQL = "select * from genre order by sort desc";
                                    $myData = mysqli_query($con, $SQL);
                                    while ($record = mysqli_fetch_array($myData)) {
                                        ?>
                                        <a href='dashboard.php?BookType=<?php echo $record['title']; ?> '><li><?php echo $record['title']; ?></li></a>

                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="form-group">
                                <label>Books Language</label>
                                <ul>
                                    <?php
                                    require '../Admin/connection.php';
                                    $SQL = "select distinct (language) from books where status in (1) order by 1 asc";
                                    $myData = mysqli_query($con, $SQL);
                                    while ($record = mysqli_fetch_array($myData)) {
                                        ?>
                                        <a href='dashboard.php?Language=<?php echo $record['language']; ?> '><li><?php echo $record['language']; ?></li></a>
                                    <?php }
                                    ?>
                                </ul>
                            </div>


                        </div>
                        <div class="col-sm-6">
                            <p ><pre>
                                This is Library System ...
Welcome to Library System
You can see Books in the dashboard.
See Book Detail and buy book on Book Detail Button,
You can create You Dashboard also.

You can <a href="../Admin/login.php">login</a> or <a href="../Admin/Users/addUser.php">Register </a>


</pre>
                            </p>
                        </div>
                        <div class="col-sm-2"></div>
                        <div class="col-sm-3 jumbotron scrollspy "><label>Hot Sale Books</label>
                            <?php
                            require '../Admin/connection.php';
                            // $SQL for admin
                            // $SQL for staff
                            // $SQL for customer
                            //$SQL for guest


                            $SQL = "select * from books where status in (1)";
                            $myData = mysqli_query($con, $SQL);
                            while ($record = mysqli_fetch_array($myData)) {
                                $serial = $record['serial'];
                                echo '<a href="bookdetail.php?id=' . $serial . '">';
                                echo "<br/><label>" . $record['title'] . "</label>";
                                echo '<img style=" width:50%;" class="thumbnail" src="../Admin/upload/' . $record['image_url'] . '">';
                                echo '</a>';
                            }
                            ?>                        </div>

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