<html>
    <head>
        <title>
            Check Password
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

                background-image: url("upload/library.jpg");
                background-repeat: round;
                background-attachment: scroll;
            }
        </style>
    </head>
    <body style="opacity: 0.93;" >
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="">Bookstore</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">

                        <li><a href="../Client/dashboard.php">Dashboard</a></li>


                    </ul>
                </div>

            </div>
        </nav>


        <link href="Design/bootstrap-4.0.0/jquery/jquery-3.3.1.min.js"  type="text/javascript">

        <?php
        session_start();
        $_SESSION['name'] = '';
        $_SESSION['email'] = '';
        $_SESSION['Job'] = '';
        $_SESSION['lname'] = '';
        $_SESSION['group'] = '';
        $login_error = '';
        ?>
        <div class="container-fluid">

            <div class="row">          
                <div class="col-lg-4"></div>

                <div class="col-lg-4">

                    <div class="jumbotron" style="margin-top: 150px;">  
                        <h3>Please Refill</h3><br/>
                        <form method="post" action="checkpassword.php">
                            <div class="form-group input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user">

                                    </span>

                                </span>

                                <input type="email" required="" name="username" placeholder="example@example.com" class="form-control">
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon" >
                                    <span class="glyphicon glyphicon-lock">

                                    </span>

                                </span>                                <input type="text" required="" name="fname" placeholder="First Name" class="form-control">
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon" >
                                    <span class="glyphicon glyphicon-phone">

                                    </span>

                                </span>                                <input type="number" required="" name="phone" placeholder="phone" class="form-control">
                            </div>


                            <button type="submit" class="btn btn-primary form-control"  name="bttnLogin" >Check</button>
                            <?php
                            if (isset($_POST['bttnLogin'])) {
                                require 'connection.php';
                                $SQL = " select FirstName,Password,user_group,email,LastName,JobTitle from Users where status=1 and email='$_POST[username]' and FirstName='$_POST[fname]' and phone ='" . $_POST['phone'] . "'";

                                if ($myData = mysqli_query($con, $SQL)) {
                                    //    echo mysqli_num_rows();
                                    $num_rows = mysqli_num_rows($myData);
                                    //echo $num_rows;
                                    if ($num_rows == 1) {


// Start the session


                                        while ($record = mysqli_fetch_array($myData)) {


                                            echo "<label class='btn-success' style='font-size:24;'>Password Is :" . $record['Password'] . " </label> <br> You can <a href='login.php'>login</a> to the system .";
                                        }
                                    } else {
                                        
                                        ?>
                                        <label class="alert-danger">User Not Found ... Please Contact Administer</label>
                                        <?php
                                    }
                                }
                            } else {
                                // echo mysqli_error();
                            } if (!isset($_SESSION)) {
                                if ($_SESSION['name'] <> '') {

                                    echo 'hello ' . $_SESSION['name'];
                                }
                            }
                            ?>

                        </form>
                    </div>


                </div>
            </div>

    </body>

</html>

