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
                    <?php
                    $email = '';
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
                        <span style='color:grey;'> Welcome <a  href=userDetail.php?email=<?php echo $email; ?> '><?php echo $name; ?> </a>   @   <?php echo $job; ?></span>
                        <?php
                    } else
                        header('Location:../dashboard.php');
                    ?>
                    <?php if ($group == 'Manager') { ?> <a class="navbar-brand" href="../books.php">Bookstore</a>
                    <?php } else { ?><a class="navbar-brand" href="">Bookstore</a><?php } ?>
                </div>
                <div id="navbar1" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">

                        <?php if ($group == 'Manager') { ?>  <li><a href="../addbook.php">Add Book</a></li>
                            <li><a href="../addbook.php">Add Book</a></li>
                            <li><a href="../deletebook.php">Deleted Books</a></li>
                            <li><a href="../../Admin/Users/users.php">Users</a></li>
                        <?php } ?><li><a href="../Customer/dashboard.php">Dashboard</a></li>
                        <?php if ($group == 'Guest' || $group == 'Manager') { ?>   <li><a href="../Customer/myOrders.php">My Orders</a></li>
                        <?php } ?>
                        <?php if ($group == '') { ?>  <li><a href="login.php">Log in</a></li>
                            <?php } else { ?> <li><a href="logout.php">Log out</a></li><?php } ?>
                    </ul>
                </div>

            </div>

        </nav>

        <div class="container">

            <?php
            require '../../Admin/connection.php';
            $id = htmlspecialchars($_GET["id"]);

            // $SQL1 = "select * from books where serial=" . $id;
            $SQL1 = "select * from books,book_price where books.status=1 and book_price.status=1 and serial = book_id  and serial=" . $id;
            mysqli_select_db($con, "librarydb1");
            $result1 = mysqli_query($con, $SQL1) or die(mysql_error());
            if (mysqli_num_rows($result1) <> 1) {
                ?>
                <label class="jumbotron alert-danger">Sorry... Book Not Available for Sale or Price not Selected </label> 
                <?php
            } else {


                while ($row = mysqli_fetch_array($result1)) {


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
                    '<img style="width:100%;" src = "../../Admin/upload/' . $row['image_url'] . '">' .
                    '</div>' .
                    '<div class = "col-md-8">' .
                    '</p>' . $row['description'] . '</p>' .
                    '<ul class = "list-group">' .
                    '<li class = "list-group-item">Genre: ' . $row['Genre'] . '</li>' .
                    '<li class = "list-group-item">Author: ' . $row['author'] . '</li>' .
                    '<li class = "list-group-item">Publisher: ' . $row['publisher'] . '</li>' .
                    '<li class = "list-group-item">Pages: ' . $row['pages'] . '</li>' .
                    '<li class = "list-group-item">Language: ' . $row['language'] . '</li>';

                    $newprice = $row['price'];
                    if ($row['DiscountHotSale'] > 0) {
                        $newprice = $row['price'] - $row['DiscountHotSale'];
                        echo '<li class = "list-group-item">Price: ' . $row['price'] . 'IQD&nbsp&nbsp&nbsp<strong> Get Discount ' . $row['discount'] . ' IQD From  &nbsp ' . $row['discountfrom'] . ' &nbsp orders - New Price</strong> <span style="background-color:yellow;color:blue;font-weight:bolder;"> ' . $newprice . ' IQD</span> </li> ';
                    } else {
                        echo '<li class = "list-group-item">Price: ' . $row['price'] . 'IQD&nbsp&nbsp&nbsp<strong> Get Discount ' . $row['discount'] . ' IQD From  &nbsp ' . $row['discountfrom'] . ' &nbsp orders </strong></li>';
                    }


                    echo '<li class = "list-group-item">ISBN No: ' . $row['pub_num'] . '</li>' .
                    '<li class = "list-group-item">Shared: ' . $status . '</li>' .
                    '<li class = "list-group-item">Note: ' . $row['note'] . '</li>';

                    $sqllikes = "select sum(likes) as likes,sum(dislike) as dislike from book_likes where book_id=" . $row['serial'];
                    mysqli_select_db($con, "librarydb1");
                    $result = mysqli_query($con, $sqllikes) or die(mysql_error());
                    if (mysqli_num_rows($result) <> 1) {
                        echo 'User not Selected';
                    } else {


                        while ($row1 = mysqli_fetch_array($result)) {





                            echo '<li class = "list-group-item"><a   class = "btn btn-success" href="like.php?id=' . $row['serial'] . '&like=1&dislike=0">Like:' . $row1['likes'] . '</a> <span style=padding-left:100px;><a   class = "btn btn-danger" href="like.php?id=' . $row['serial'] . '&like=0&dislike=1">Dislike:' . $row1['dislike'] . '</a></span></li>' .
                            '</ul>';
                        }
                    }
                    $sqlfavour = "select * from books_favour where book_id=" . $row['serial'] . " and owner='" . $email . "'";
                    mysqli_select_db($con, "librarydb1");
                    $result = mysqli_query($con, $sqlfavour) or die(mysql_error());
                    if (mysqli_num_rows($result) <> 1) {
                        echo '<a   class = "btn btn-primary" href="addtomycard.php?id=' . $row['serial'] . '&addtocart=1">Add to My Card</a>';
                    } else {


                        while ($row1 = mysqli_fetch_array($result)) {


                            echo '<a   class = "btn btn-success" href="addtomycard.php?id=' . $row['serial'] . '&addtocart=0">Added to My Card</a>';
                        }
                    }
                    ?> 
                    <?php
                    echo '</div>' .
                    '</div>' .
                    ' <div class="pull-right">';
                    $sqlorder = "select * from book_order where owner='" . $email . "' and book_id=" . $row['serial'];

                    mysqli_select_db($con, "librarydb1");
                    $result = mysqli_query($con, $sqlorder) or die(mysql_error());
                    if (mysqli_num_rows($result) <> 1) {
                        $price = $newprice;
                        echo ' <a  href="orderbook.php?id=' . $row['serial'] . '&order=1&title=' . $row['title'] . '&price=' . $newprice . '">Buy</a> ';
                    } else {


                        while ($row1 = mysqli_fetch_array($result)) {
                            if ($row1['status'] == 'ordered') {
                                echo 'Ordered :  <a  href="orderbook.php?id=' . $row['serial'] . '&order=0&title=' . $row['title'] . '&price=' . $newprice . '">Reject</a> ';
                            } else {
                                echo ' <a  href="orderbook.php?id=' . $row['serial'] . '&order=3&title=' . $row['title'] . '">Bought</a> ';
                            }
                        }
                    }
                    echo '|  <a href="myOrders.php?id=' . $row['serial'] . '">My Orders</a> ';
                    echo '        </div> </div>';
                    ?>

                    <div class="col-sm-12 jumbotron scrollspy " >

                        <div class="row"><label>Related Books</label></div>


        <?php
        require '../../Admin/connection.php';

        $SQL = "select * from books,book_price where books.status=1 and book_price.status=1 and serial = book_id and  DiscountHotSale>=0 and genre='" . $row['Genre'] . "' and Language='" . $row['language'] . "' and serial<>" . $row['serial'];
        $myData = mysqli_query($con, $SQL);
        while ($record = mysqli_fetch_array($myData)) {
            $serial = $record['serial'];
            echo '<div class="col-sm-3 jumbotron scrollspy ">                     ';
            echo '<a href="bookdetail.php?id=' . $serial . '">';
            echo "<br/><label style='font-size:10;'>" . $record['title'] . "</label>";
            echo "<br/><label style='font-size:10;'>" . $record['price'] . "IQD</label>";
            echo '<img style=" width:50%;" class="thumbnail" src="../../Admin//upload/' . $record['image_url'] . '">';
            echo '</a> </div>';
        }
    }
    ?>                        </div>






                <div align="center" class="col-sm-12  jumbotron  " >
                    <div class="row"><label align="center">Hot Sale Books</label></div>
    <?php
    require '../../Admin/connection.php';



    $SQL = "select * from books,book_price where  books.status=1 and book_price.status=1 and serial = book_id and  DiscountHotSale>=0";
    $myData = mysqli_query($con, $SQL);
    while ($record = mysqli_fetch_array($myData)) {
        $serial = $record['serial'];
        $oldprice = $record['price'];
        $discount = $record['discount'];
        $DiscountHotSale = $record['DiscountHotSale'];
        $newprice = $oldprice - $DiscountHotSale;
        $ratio = 100 * $newprice / $oldprice;
        $discountratio = round(100 * ( $discount + $DiscountHotSale) / $oldprice);
        echo '<div class="col-sm-2  scrollspy " style="font-size:12;text-align:left;" >';

        echo '<a href="bookdetail.php?id=' . $serial . '">';
        echo "<br/><label>" . $record['title'] . "</label>";
        echo "<br/><label style='color:brown;' >Old Price <span style='text-decoration:line-through;color:brown;'> " . $record['price'] . "</span>IQD </label>";

        if ($record['DiscountHotSale'] > 0) {
            $newdiscount = $record['DiscountHotSale'];
            echo "<br/><label style='color:white;background-color:green'>Save " . $newdiscount . 'IQ ' . $discountratio . "%</label>";
        } else {
            echo "<br/><label>Save " . $record['DiscountHotSale'] . "IQD </label>";
        }
        echo "<br/><label style='color:green;' >New Price <span style='text-decoration:none'> " . $newprice . " &nbsp" . round($ratio) . "</span>% </label>";

        echo '<img style=" width:50%;" class="thumbnail" src="../../Admin/upload/' . $record['image_url'] . '">';
        echo '</a></div>';
    }
    ?>                        </div>

                <?php }
                ?>




        </div>
    </body>
</html>