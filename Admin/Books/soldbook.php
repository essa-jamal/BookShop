<htm>
    <head>
        <title>
            My Orders
        </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="Design/bootstrap-4.0.0/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="Design/bootstrap-4.0.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="Design/bootstrap-4.0.0/css/bootstrap-grid.css" rel="stylesheet" type="text/css">
        <link href="./dashboard.css" rel="stylesheet" type="text/css">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>

            body  {
                height: 120%;
                background-image: url("../upload/library.jpg");
                background-repeat: round;
                background-attachment: scroll;
            }</style>
        </style>
    </head>
    <body style="opacity: .95;">
        <script src="../Books/Client/StickyMenu.js"></script>
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="../Books/books.php">BookStore</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                      
                        <li><a href="books.php">Go Back</a></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="container jumbotron ">
            
            <h2 style="color:darkgreen;background-color: #c3e6cb;opacity: 0.85;">Sold Books</h2>





            <table  class="table table-hover table-bordered table-condensed container " >
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
                        <th>Sold Date</th>
                        <th>Confirm_by</th>

                        <th>Action</th>
                    </tr>
                </thead>
                <tbody style="background-color: grey;color: black; ">
                    <?php
                    require '../connection.php';
                    $SQL = "select * from book_sale ";
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
                            <td><?php echo $record['title']; ?></td>
                            <td><?php echo $record['owner']; ?></td>
                            <td><?php echo $record['price']; ?></td>
                            <td><?php echo $record['QTY']; ?></td>
                            <td ><?php
                                echo $record['status']; 
                                ?></td>
                            <td><?php echo $record['Date_inserted']; ?></td>

                            <td><?php if ($record['Inserted_by'] <> '0000-00-00') echo $record['Inserted_by']; ?></td>
                            <td > Sold</td>

                        </tr>
                            <?php } ?>
                        
                        
                        <?php
                    require '../connection.php';
                    $SQL = "select count(order_id)id,count(distinct book_id)book_id,count(distinct book_id)title,count(distinct status) status,count(distinct Date_inserted)Date_inserted,sum(qty)QTY,count(distinct owner)owner,count(distinct Inserted_by)Inserted_by,sum(price)price from book_sale ";
                    $myData = mysqli_query($con, $SQL);
                    $sequence = 0;
                    while ($record = mysqli_fetch_array($myData)) {
                        $id = $record['id'];
                        $sequence += 1;
                        ?>

                        <tr class="jumbotron">
                            <td><?php echo 'Total'; ?></td>
                            <td><?php echo $record['id']; ?></td>
                            <td><?php echo $record['book_id']; ?></td>
                            <td><?php echo $record['title']; ?></td>
                            <td><?php echo $record['owner']; ?></td>
                            <td><?php echo $record['price']; ?></td>
                            <td><?php echo $record['QTY']; ?></td>
                            <td ><?php
                                echo $record['status']; 
                                ?></td>
                            <td><?php echo $record['Date_inserted']; ?></td>

                            <td><?php if ($record['Inserted_by'] <> '0000-00-00') echo $record['Inserted_by']; ?></td>
                            <td > Sold</td>

                        </tr>
                            <?php } ?>
                </tbody>
            </table>
        </div>

        </div>
<?php
if (isset($_POST['addUser'])) {
    require '../connection.php';
    mysqli_select_db($con, "librarydb1");
    $SQL = "insert into users (FirstName,LastName,Email,phone,password,JobTitle,note,user_group,status,Inserted_Date,Inserted_By)"
            . "VALUES ('" . $_POST['firstname'] . "','" . $_POST['lastname'] . "','" . $_POST['email'] . "','" . $_POST['phone'] . "','" . $_POST['password'] . "','" . $_POST['jobe'] . "','" . $_POST['message'] . "','0','0',CURRENT_TIMESTAMP,'admin') ";
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
