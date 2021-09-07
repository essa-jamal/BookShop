<htm>
    <head>
        <title>
            Users
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
                        <li><a href="../Books/books.php">Go Back</a></li>
                        
                    </ul>
                </div>
            </div>
        </nav>


        <div class="container jumbotron" style="opacity: .97;">
            <h2  style="opacity: .8;color: lightgray;background-color: white;text-align: center;">Our Staff</h2>


            <div class="container" >
                <form id="contact-form" method="post" action="users.php" role="form">
                    <?php
                    if (isset($_POST['addUserForm'])) {
                        ?>
                        <div class="messages"></div>

                        <div class="controls jumbotron" >

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form_name">First Name *</label>
                                        <input id="form_name" type="text" name="firstname" class="form-control" placeholder="First Name *" required="required" data-error="Firstname is required.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form_lastname">Last Name *</label>
                                        <input id="form_lastname" type="text" name="lastname" class="form-control" placeholder="Last Name *" required="required" data-error="Lastname is required.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form_email">Email *</label>
                                        <input id="form_email" type="email" name="email" class="form-control" placeholder="email@example.com" required="required" data-error="Valid email is required.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form_phone">Phone</label>
                                        <input id="form_phone" type="tel" name="phone" class="form-control" placeholder="Phone no.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form_name">Password *</label>
                                        <input id="form_name" type="password"  name="password" class="form-control" placeholder="Password *" required="required" data-error="Password is required.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form_Group">Job *</label>
                                        <input id="form_group" type="text" name="jobe" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="form_message">Message *</label>
                                        <textarea id="form_message" name="message" class="form-control" placeholder="Message for me *" rows="4" required="required" data-error="Please,leave us a message."></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input type="submit"  name="addUser" class="btn btn-success btn-send" value="addUser">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-muted"><strong>*</strong> Please Refill True Data </p>
                                </div>
                            </div>
                            <?php
                        } else {
                            echo ' <input type="submit"  name="addUserForm" class="btn btn-success btn-send" value="addUser">';
                        }
                        ?>
                    </div>

                </form>


                <table  class="table table-hover table-bordered table-condensed container ">
                    <thead class="jumbotron">
                        <tr >
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Group</th>
                            <th>Member By</th>
                            <th>Member Date</th>
                            <th>Update By</th>
                            <th>Update Date</th>
                            <th>Last Login</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: #212529;color: darkgrey;">
                        <?php
                        require '../connection.php';
                        $SQL = "select * from users ";
                        mysqli_select_db($con, "librarydb1");
                        $myData = mysqli_query($con, $SQL);
                        $sequence = 0;
                        while ($record = mysqli_fetch_array($myData)) {
                            $id = $record['id'];
                            $sequence += 1;
                            ?>

                            <tr>
                                <td><?php echo $sequence; ?></td>
                                <td><?php echo $record['FirstName']; ?></td>
                                <td><?php echo $record['LastName']; ?></td>
                                <td><?php echo $record['Email']; ?></td>
                                <td ><?php
                                    if ($record['status'] == 1) {
                                        echo '<a style="color: lightgrey;" href="disableUser.php?id=' . $id . '&status=0">Active</a>';
                                    } else {
                                        echo '<a style="color: darkgrey;" href="disableUser.php?id=' . $id . '&status=1">InActive</a>';
                                    }
                                    ?></td>
                                <td><?php echo $record['user_group']; ?></td>
                                <td><?php echo $record['Inserted_By']; ?></td>
                                <td><?php echo $record['Inserted_Date']; ?></td>
                                <td><?php echo $record['Updated_By']; ?></td>
                                <td><?php if ($record['Updated_Date'] <> '0000-00-00') echo $record['Updated_Date']; ?></td>
                                <td><?php if ($record['Last_Login'] <> '0000-00-00') echo $record['Last_Login']; ?></td>
                                <td > <?php
                                    echo ' <a style="color: darkgrey;" href="userDetail.php?id=' . $id . '">Detail</a>&nbsp|&nbsp<a style="color: darkgrey;" href="deleteUser.php?id=' . $id . '">Delete</a> ';
                                    ?></td>

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
                    . "VALUES ('" . $_POST['firstname'] . "','" . $_POST['lastname'] . "','" . $_POST['email'] . "','" . $_POST['phone'] . "','" . $_POST['password'] . "','" . $_POST['jobe'] . "','" . $_POST['message'] . "','0','0',CURRENT_TIMESTAMP,'essa') ";
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
