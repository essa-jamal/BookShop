<html>
    <head>
        <title>
            Add Book Price
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
        $discountErr = '';
        if (isset($_POST['addbtn'])) {


            require '../connection.php';

            if ($_POST['price'] < $_POST['discount']) {
                $discountErr = 'Discount is greater than Price';
            } else {

                mysqli_select_db($con, "librarydb1");
                if ($_POST['discountHotSale'] == '' || $_POST['discountHotSale'] < 0) {
                    $DiscountHotSale = -1;
                } else {
                    $DiscountHotSale = $_POST['discountHotSale'];
                }
                $SQL = " Insert into book_price (book_id,Title,price,discount,discountfrom,DiscountHotSale,Inserted_by,inserted_date) "
                        . "values (SUBSTRING_INDEX( '" . $_POST['title'] . "','.',1),SUBSTRING_INDEX( '" . $_POST['title'] . "','.',-1),'"
                        . $_POST['price'] . "','" . $_POST['discount'] . "','" . $_POST['discountfrom'] . "'," . $DiscountHotSale . ",'admin',CURTIME()) ";
                if (mysqli_query($con, $SQL)) {

                    //  echo "<br/>Intserted Successfully ...";
                } else {
                    echo mysqli_error($con);
                    echo 'error';
                }
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
                    <h3 class="panel-title">Add Book Brice</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form  method="post" action="book_price.php">
                                <div class="form-group">
                                    <label>Title</label>

                                    <select name="title" class="form-control" >

                                        <?php
                                        require '../connection.php';
                                        $SQL = "select * from books where serial not in (select book_id from book_price where status=1)order by serial";
                                        $myData = mysqli_query($con, $SQL);
                                        while ($record = mysqli_fetch_array($myData)) {
                                            echo "<option name='title' value='" . $record['serial'] . '.' . $record['title'] . "'>" . $record['serial'] . ".    " . $record['title'] . "</option>";
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" class="form-control" maxlength="10" required name="price" placeholder="Price IQD">
                                </div>
                                <div class="form-group">
                                    <label>Discount</label>
                                    <input type="number" class="form-control" maxlength="5" required name="discount" placeholder="Discount IQD">
                                </div>
                                <div class="form-group">
                                    <label>Discount From</label>
                                    <input type="number" class="form-control" maxlength="5" required name="discountfrom" placeholder="Discount QTY">
                                </div>
                                <div class="form-group">
                                    <label>Hot Sale</label>
                                    <input type="number" class="form-control" maxlength="5"   name="discountHotSale" placeholder="Extra Discount HotSale">
                                </div>
                                <?php if ($discountErr <> '') { ?>   <div class="form-group"> <span class="alert alert-danger">* <?php echo $discountErr; ?></span> </div> <?php } ?>

                                <button type="submit" name="addbtn" class="btn btn-default">Submit</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <table  class="table table-hover table-bordered table-condensed container  " style="display:block; overflow:auto; height:450px;">
                <thead class="jumbotron">
                    <tr >
                        <th>#</th>
                        <th>Book_Id</th>
                        <th>Book_Name</th>
                        <th>Price</th>
                        <th>discount</th>
                        <th>from</th>
                        <th>HotSale</th>
                        <th>status</th>
                        <th>Add_By</th>
                        <th>Added_Date</th>
                        <th>Update_By</th>
                        <th>Update_Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody style="background-color: #138496;color: white;overflow:auto; height:450px;">
                    <?php
                    require '../connection.php';
                    $SQL = "select * from book_price order by book_id,id";
                    mysqli_select_db($con, "librarydb1");
                    $myData = mysqli_query($con, $SQL);
                    $sequence = 0;
                    while ($record = mysqli_fetch_array($myData)) {
                        $id = $record['id'];
                        $sequence += 1;
                        ?>

                        <tr>
                            <td><?php echo $sequence; ?></td>
                            <td><?php echo $record['book_id']; ?></td>
                            <td ><?php echo $record['Title']; ?></td>
                            <td><?php echo $record['price']; ?></td>
                            <td><?php echo $record['discount']; ?></td>
                            <td><?php echo $record['discountfrom']; ?></td>
                            <td><?php if ($record['DiscountHotSale'] == -1)
                        echo 'undefined';
                    else
                        echo $record['DiscountHotSale'];
                        ?></td>
                            <td ><?php
                                if ($record['status'] == 1) {
                                    echo '<a style="color: lightgrey;" href="disablePrice.php?id=' . $id . '&status=0&bookid=' . $record['book_id'] . '">Active</a>';
                                } else {
                                    echo '<a style="color: darkgrey;" href="disablePrice.php?id=' . $id . '&status=1&bookid=' . $record['book_id'] . '">InActive</a>';
                                }
                                ?></td>


                            <td><?php echo $record['Inserted_by']; ?></td>
                            <td><?php echo $record['inserted_date']; ?></td>
                            <td><?php echo $record['updated_by']; ?></td>
                            <td><?php if ($record['updated_date'] <> '0000-00-00') echo $record['updated_date']; ?></td>
                            <td > <?php
                            //  echo ' <a style="color: darkgrey;" href="userDetail.php?id=' . $id . '">Detail</a>&nbsp| &nbsp<a style="color: darkgrey;" href="delete_book_price.php?id=' . $id . '">Delete</a> ';
                            echo ' &nbsp<a style="color: darkgrey;" href="delete_book_price.php?id=' . $id . '">Delete</a> ';
                                ?></td>

                        </tr>
<?php } ?>
                </tbody>
            </table>
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
