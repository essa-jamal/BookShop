<html>
    <head>
        <title>
            Register Your Name
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








        if (!isset($_SESSION)) {
            if ($_SESSION['name'] <> '') {

                echo 'hello ' . $_SESSION['name'];
            }
        }
        ?>
        <form method="post" action="addGuestUser.php">
        <div class="col-md-2"></div>
        <div class="container-fluid col-md-8">


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
                if (isset($_POST['addUser'])) {
                    require 'connection.php';
                    mysqli_select_db($con, "librarydb1");
                    $SQL = "insert into users (FirstName,LastName,Email,phone,password,JobTitle,note,user_group,status,Inserted_Date,Inserted_By)"
                            . "VALUES ('" . $_POST['firstname'] . "','" . $_POST['lastname'] . "','" . $_POST['email'] . "','" . $_POST['phone'] . "','" . $_POST['password'] . "','" . $_POST['jobe'] . "','" . $_POST['message'] . "','Guest','1',CURRENT_TIMESTAMP,'essa') ";
                    if (mysqli_query($con, $SQL)) {
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="btn-success">User Added to The system you can  : </label><a href="login.php"> login</a>
                            </div>
                        </div>
                    <?php } else {
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="alert-danger">Erron on Insert - this email already exist
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>


            </div>


        </div>

    </form>





</body>

</html>

