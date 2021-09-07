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
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style>
            body  {

                background-image: url("../../Admin/upload/library.jpg");
                background-repeat: round;
                background-attachment: scroll;
            }</style>
    </head><body style="opacity: 0.95;" >

        <nav class="navbar navbar-default " id="navbar">
            <div class="container" id="nav2">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    </button>
                      <?php  $email = '';
                        $name = '';
                        $group = '';
                        $job = '';
                        if (!isset($_SESSION)) {
                            session_start();
                        } if ($_SESSION['name'] <> "") {
                            $email = $_SESSION['email'];
                            $name = $_SESSION['name'];
                            $group = $_SESSION['group'];
                            $job = $_SESSION['Job'];

                           ?>
                    <span style='color:grey;'> Welcome <a  href='userDetail.php?email=<?php echo $email ?>'><?php echo $name; ?> </a>   @   <?php echo $job; ?></span>
                        <?php  if ($group=='Manager'){
                            ?>
                    <a class="navbar-brand" href="/Admin/Books/books.php">Bookstore</a>
                    <?php } else { ?>
                    <a class="navbar-brand" href="../About.php">Bookstore</a>
                    <?php } ?>
                </div>
                <div id="navbar1" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                        } else
                            header('Location:../../Admin/login.php');
                        ?>
                        <?php if ($group == 'Manager') { ?>  <li><a href="../../Admin/Books/addbook.php">Add Book</a></li>
                        <li><a href="../../Admin/Books/book_price.php">Add Book Price</a></li>
                        <li><a href="../../Admin/Books/deletebook.php">Deleted Books</a></li>
                            <li><a href="../../Users_old/users.php">Users</a></li>
                        <?php } ?><li><a href="../Customer/dashboard.php">Dashboard</a></li>
                        <?php if ($group == 'Guest') { ?>   <li><a href="myOrders.php">My Orders</a></li>
                                                                                       <li><a href='../../Client/Customer/dashboard.php?favour=<?php echo $email; ?>'>My Dashboard</a></li>

                        <?php
                        }
                        if ($group == 'Manager') {
                            ?>   <li><a href="myOrders.php">Orders</a></li>
                        <?php } if ($group == '') { ?>  <li><a href="login.php">Log in</a></li>
                            <?php } else { ?> <li><a href="../dashboard.php">Log out</a></li><?php } ?>
                    </ul>
                </div>

            </div>

        </nav>


        <div class="container jumbotron">
            <h2>My Orders</h2>





            <table  class="table table-hover table-bordered table-condensed container ">
                <thead class="jumbotron">
                    <tr >
                        <th>#</th>
                        <th>Order Id</th>
                        <th>Book Id</th>
                        <th>Book Title</th>
                        <th>Owner</th>
                        <th>Price</th>
                        <th>QTY</th>
                        <th>Status</th>
                        <th>Order Date</th>
                        <th>Admin Update</th>

                        <th>Action</th>
                    </tr>
                </thead>
                <tbody style="background-color: #138496;color: darkgrey;">
                    <?php
                    require '../../Admin/connection.php';
                    if ($group == 'Manager') {
                        $SQL = "select * from book_order  ";
                    } else {
                        $SQL = "select * from book_order where owner= '" . $_SESSION['email'] . "'";
                    }
                    
                    $myData = mysqli_query($con, $SQL);
                    $sequence = 0;
                    while ($record = mysqli_fetch_array($myData)) {
                        $id = $record['id'];
                        $sequence += 1;
                        ?>

                        <tr>
                            <td><?php echo $sequence; ?></td>
                            <td><?php echo $record['id']; ?></td>
                            <td><?php echo $record['book_id']; ?></td>
                            <td><?php echo $record['Title']; ?></td>
                            <td><?php echo $record['owner']; ?></td>
                            <td><?php echo $record['Price']; ?></td>
                            <td><?php echo $record['QTY']; ?></td>
                            <td ><?php
                                if ($record['status'] == 'ordered') {
                                    if ($group == 'Guest')
                                        echo '<abbr title="Please contact admin"><a style="color: lightgrey;" href="">Ordered:Send to Qeue</a></<abbr>';
                                    else
                                        echo '<a style="color: lightgrey;" href="../../Admin/Books/salebook.php?id=' . $id . '&status=qeued">Ordered:Send to Qeue</a>';
                                } else if ($record['status'] == 'qeued') {
                                    if ($group == 'Guest')
                                        echo '<abbr title="Please contact admin"><a style="color: darkgrey;" href="">Waiting to contact:0730111112</a></<abbr>';
                                    else
                                        echo '<a style="color: darkgrey;" href="../../Admin/Books/salebook.php?id=' . $id . '&status=sold">Waiting to contact:0730111112</a>';
                                } else if ($record['status'] == 'sold') {
                                    if ($group == 'Guest')
                                        echo '<abbr title="Please contact admin"><a style="color: darkgrey;" href="">Sold</a></<abbr>';
                                    else
                                        echo '<a style="color: darkgrey;" href="../../Admin/Books/salebook.php?id=' . $id . '&status=archived">Sold</a>';
                                } else {
                                    if ($group == 'Guest')
                                        echo '<abbr title="Please contact admin"><a style="color: darkgrey;" href="">archived</a></<abbr>';
                                    else
                                        echo '<a style="color: darkgrey;" href="../../Admin/Books/soldbook.php">archived</a>';
                                }
                                ?></td>
                            <td><?php echo $record['date_inserted']; ?></td>

                            <td><?php if ($record['date_updated'] <> '0000-00-00') echo $record['date_updated']; ?></td>
                            <td > <?php
                                if ($record['status'] == 'ordered' || $record['status'] == 'qeued')
                                    echo '  <a style="color: darkgrey;" href="orderbook.php?id=' . $record['book_id'] . '&order=0&title=' . $record['Title'] . '&price=' . $record['Price'] . '">Delete</a> ';
                                else
                                    echo ' <abbr title="Please contact admin"> <a style="color: darkgrey;" href="">Delete</a> </abbr>';

                                ?></td>

                        </tr>
<?php } ?>
                </tbody>
            </table>
        </div>

    </div>
    <?php
    if (isset($_POST['addUser'])) {
        require '../../Admin/connection.php';
        mysqli_select_db($con, "librarydb1");
        $SQL = "insert into users (FirstName,LastName,Email,phone,password,JobTitle,note,user_group,status,Inserted_Date,Inserted_By)"
                . "VALUES ('" . $_POST['firstname'] . "','" . $_POST['lastname'] . "','" . $_POST['email'] . "','" . $_POST['phone'] . "','" . $_POST['password'] . "','" . $_POST['jobe'] . "','" . $_POST['message'] . "','0','0',CURRENT_TIMESTAMP,'" . $_SESSION['name'] . "') ";
        if (mysqli_query($con, $SQL)) {

            //echo "<br/>Intserted Successfully ...";
        } else {
            echo 'error ' . mysqli_error($con);
        }
    }
    ?>


    <script >

        window.onscroll = function () {
            myFunction();
        };

        var navbar = document.getElementById("navbar");
        var sticky = navbar.offsetTop;

        function myFunction() {
            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky");

            } else {
                navbar.classList.remove("sticky");
            }
        }
    </script>

</body>
</htm>
