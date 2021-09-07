<html>
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
  <nav class="navbar navbar-default">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
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
                            <span style='color:grey;'> Welcome <a  href='../../Client/Customer/userDetail.php?email=<?php echo $email; ?> '><?php echo $name; ?> </a>   @   <?php echo $job; ?></span>
                <?php  }
    if (isset($_POST['updatebtn'])) {
        require '../connection.php';
        mysqli_select_db($con, "librarydb1");
        
        $SQL = " update  users set "
                  . "  Email='" . $_POST['Email'] . "'"
                . " , user_group='" . $_POST['group'] . "'"
                . " ,  note='" . $_POST['note'] . "'"
                . " ,  Updated_Date=CURTIME()"
                . " ,  Updated_By='" . $email . "'"
                . " where id=" . $_POST['id'];


        echo 'error SQL='.$SQL;
      

        $retval = mysqli_query($con, $SQL);
        if (!$retval) {
            die('Could not update data: ' . mysql_error());
        } else {
            if(isset($_GET['id'])){
            header('Location:users.php?');}
 else {
            header('Location:../../Client/Customer/dashboard.php');
 } }
    } else {
        $SQL = '';
        $id = 0;
        $email = '';
        if (isset($_GET['id'])) {
            if (htmlspecialchars($_GET["id"]) == NULL) {
                header('Location:users.php');
            } else {
                $id = htmlspecialchars($_GET["id"]);
                $SQL = "select * from users where id=" . $id;
            }
        } else if (isset($_GET['email'])) {
            if (htmlspecialchars($_GET["email"]) == NULL) {
                header('Location:../Client/dashboard');
            } else {
                $email = htmlspecialchars($_GET["email"]);
                $SQL = "select * from users where email='" . $email . "'";
            }
        }



        require '../connection.php';
        // echo $SQL;
        mysqli_select_db($con, "librarydb1");
        $result = mysqli_query($con, $SQL) or die(mysql_error());
        if (mysqli_num_rows($result) <> 1) {
            //echo '  User not Selected '. mysqli_error($con);
        } else {
            while ($row = mysqli_fetch_array($result)) {
                ?> 
              
                            <a class="navbar-brand" href="../Books/books.php">Bookstore</a>
                        </div>
                        <div id="navbar" class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="../Books/books.php">Go Back</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="container jumbotron">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Update User</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form  method="post" action="userDetail.php">
                                        <div class="form-group " >
                                            <label>First Name</label>
                                            <input type="text"  
                                                   accesskey=""accept="" <?php echo 'value="' . $row['FirstName'] . '"';
            if (!isset($_GET['email'])) {
                echo ' disabled';
            } ?> 
                                                   class="form-control"  maxlength="30"  name="FirstName" placeholder="First Name">
                                        </div>

                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" maxlength="30"   <?php echo 'value="' . $row['LastName'] . '"';
            if (!isset($_GET['email'])) {
                echo ' disabled';
            } ?>  class="form-control" name="LastName" placeholder="Last Name" value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text"  class="form-control"   maxlength="30"   <?php echo ' value="' . $row['Email'] . '"';
            if (isset($_GET['email'])) {
                echo ' disabled';
            } ?>  name="Email" placeholder="email@example.com">
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control"  maxlength="10" <?php echo 'value="' . $row['password'] . '"';
            if (!isset($_GET['email'])) {
                echo ' disabled';
            } ?>  name="password" placeholder="*****">
                                        </div>
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" class="form-control" maxlength="10" name="phone"  <?php echo 'value="' . $row['phone'] . '"';
            if (!isset($_GET['email'])) {
                echo ' disabled';
            } ?>  placeholder="Phone no">
                                        </div>
                                        <div class="form-group">
                                            <label>Job</label>
                                            <input type="text" class="form-control" maxlength="30" name="JobTitle"  <?php echo 'value="' . $row['JobTitle'] . '"';
            if (!isset($_GET['email'])) {
                echo ' disabled';
            } ?>  placeholder="Publish Number">
                                        </div>

                                        <div class="form-group">
                                            <label>Group</label>
                                            <select <?php if (!isset($_GET['id'])) {
                                        echo 'disabled';
                                    } ?> name="group"   accesskey=""   class="form-control">
            <?php
            require '../connection.php';
            $SQL = "select * from groups where group_name<> '" . $row['user_group'] . "' order by group_id ";
            $myData = mysqli_query($con, $SQL);
            echo "<option value='" . $row['user_group'] . "'>" . $row['user_group'] . "</option>";
            while ($record = mysqli_fetch_array($myData)) {
                echo "<option value='" . $record['group_name'] . "'>" . $record['group_name'] . "</option>";
            }
            ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>note</label>
                                            <textarea class="form-control" name="note" maxlength="100"   placeholder="make a note"> <?php echo $row['note'] ?></textarea>
                                        </div>
                                        <input type="hidden" class="form-control" name="id"  <?php echo 'value="' . $row['id'] . '"' ?> >
                                        <button type="submit" name="updatebtn" class="btn btn-default">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
        }
    }
}
?>
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
