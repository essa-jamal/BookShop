<html>
    <head>
        <title>
            Login Page
        </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="Design/bootstrap-4.0.0/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="Design/bootstrap-4.0.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="Design/bootstrap-4.0.0/css/bootstrap-grid.css" rel="stylesheet" type="text/css">

        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
    <body style="opacity: .93;background-image: url(upload/library.jpg);background-repeat: round;background-attachment: scroll;">
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
        <script>
            $(document).ready(function () {

                $("lbl1").hide();
            });
        </script>
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
                        <h3>Please Login</h3><br/>
                        <form method="post" action="Login.php">
                            <div class="form-group input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user">

                                    </span>

                                </span>

                                <input type="email" required="" name="username" placeholder="Enter Username" class="form-control">
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon" >
                                    <span class="glyphicon glyphicon-lock">

                                    </span>

                                </span>                                <input type="password" required="" name="password" placeholder="password" class="form-control">
                            </div>
                            <div class="checkbox">
                                <label >    <input type="checkbox" > Remember me.</label>
                            </div>

                            <button type="submit" class="btn btn-primary form-control"  name="bttnLogin" >Login</button>
                            <div class="form-group ">
                                Forget <a href="checkpassword.php"> Password</a>
                                <br/>Register<a href="addGuestUser.php"> New</a>  Account.
                            </div>

<?php
if (isset($_POST['bttnLogin'])) {
    require 'connection.php';
    $SQL = " select status,FirstName,Password,user_group,email,LastName,JobTitle from Users where status=1 and email='$_POST[username]' and Password='$_POST[password]' ";

    if ($myData = mysqli_query($con, $SQL)) {
        //    echo mysqli_num_rows();
        $num_rows = mysqli_num_rows($myData);
        //echo $num_rows;
        if ($num_rows == 1) {


// Start the session


            while ($record = mysqli_fetch_array($myData)) {


                $_SESSION['name'] = $record['FirstName'];
                $_SESSION['lname'] = $record['LastName'];
                $_SESSION['email'] = $record['email'];
                $_SESSION['group'] = $record['user_group'];
                $_SESSION['status'] = $record['status'];

                $_SESSION['Job'] = $record['JobTitle'];
            }
            $UpdateSQL = " Update Users set last_Login=CURTIME() where email='" . $_POST['username'] . "' and Password='$_POST[password]'  ";

            if (!mysqli_query($con, $UpdateSQL)) {
                echo 'Error on Login.' . mysql_error();
            } else {
                $login_error = '';

                header('Location:../Client/Customer/dashboard.php');
            }
        } else {
            ?>
                                        <label class="alert-danger">User Not Found ... Please Contact Adminstor</label>
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


        </div>

    </body>

</html>

