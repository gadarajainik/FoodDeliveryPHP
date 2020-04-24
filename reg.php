<?php
session_start();
$db = new PDO('mysql:host=127.0.0.1;dbname=test', 'root', '');
$_SESSION['msg'] = "";
if (!empty($_POST['username']) && !empty($_POST['pwd']) && !empty($_POST['rpwd'])) {
    $username = filter_input(INPUT_POST, "username");
    $pass = ($_POST['pwd']);
    $rpass = ($_POST['rpwd']);
    $firstname = ($_POST['fname']);
    $lastname = ($_POST['lname']);
    $address = ($_POST['address']);
    $email = ($_POST['email']);
    $mobile = ($_POST['mobile']);

    if ($rpass != $pass) {
        $_SESSION['msg'] = "Password and Re-Entered Password doesn't match";
    } else {
        $sql = "SELECT * FROM user_details WHERE username =?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($username));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        ;
        if ($stmt->rowcount() == 1) {
            $_SESSION['msg'] = 'Username already exists!';
        } else {
            $sql1 = "INSERT INTO user_details VALUES ('$username','$pass','$firstname','$lastname','$mobile','$email','$address')";
            $stmt = $db->query($sql1);

            //Execute the statement and insert the new account.

            if ($stmt) {
                 $_SESSION['logged'] = "true";
                 $_SESSION['fname']=$firstname;
                $_SESSION['uname'] = $username;
                $_SESSION['add'] = $address;
                $_SESSION['mobile']=$mobile;
                $_SESSION['email']=$email;
                $_SESSION['name'] = $firstname . " " . $lastname;
                header("location:Menu.php?category=mains");
            } else {
                $_SESSION['msg'] = "Something Went Wrong!!!";
            }
        }
        //If the signup process is successful.
    }
}
?>
<?php include 'header.php' ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Colorlib Templates">
        <meta name="author" content="Colorlib">
        <meta name="keywords" content="Colorlib Templates">

        <!-- Title Page-->
        <title>Register</title>

        <!-- Icons font CSS-->
        <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
        <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
        <!-- Font special for pages-->
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Vendor CSS-->
        <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
        <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

        <!-- Main CSS-->
        <link href="css/main.css" rel="stylesheet" media="all">
    </head>

    <body>
        <div class="page-wrapper bg-gra-01 p-t-180 p-b-100 font-poppins">
            <div class="wrapper wrapper--w780">
                <div class="card card-3">
                    <div class="card-heading"></div>
                    <div class="card-body">
                        <b style="color:red"><?php echo $_SESSION['msg'] ?>
                        </b>
                        <h2 class="title">Registration Info</h2>

                        <form method="POST" action="">
                            <div class="input-group">
                                <input class="input--style-3" type="text" placeholder="First Name" name="fname" required="required">
                            </div>
                            <div class="input-group">
                                <input class="input--style-3" type="text" placeholder="Last Name" name="lname" required="required">
                            </div>
                            <div class="input-group">
                                <input class="input--style-3" type="text" placeholder="UserName" name="username" required="required">
                            </div>
                            <div class="input-group">
                                <input class="input--style-3" type="password" placeholder="Password" name="pwd" required="required">
                            </div>
                            <div class="input-group">
                                <input class="input--style-3" type="password" placeholder="Re-Password" name="rpwd" required="required">
                            </div>
                            <div class="input-group">
                                <input class="input--style-3" type="email" placeholder="Email" name="email" required="required">
                            </div>
                            <div class="input-group">
                                <input class="input--style-3" type="text" placeholder="Phone" name="mobile" required="required">
                            </div>
                            <div class="input-group">
                                <textarea class="input--style-3" placeholder="Address" name="address" required="required"></textarea>
                            </div>
                            <div class="p-t-10">
                                <button class="btn btn--pill btn--green" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jquery JS-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <!-- Vendor JS-->
        <script src="vendor/select2/select2.min.js"></script>
        <script src="vendor/datepicker/moment.min.js"></script>
        <script src="vendor/datepicker/daterangepicker.js"></script>

        <!-- Main JS-->
        <script src="js/global.js"></script>

    </body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->