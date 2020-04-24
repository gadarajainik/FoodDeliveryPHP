<?php
session_start();
$username = filter_input(INPUT_POST, "username");
$password = filter_input(INPUT_POST, "password");
if (!isset($_SESSION["logged"])) {
    if (!empty($username) && !empty($password)) {
        if ($username == 'admin' && $password == 'admin') {
            $_SESSION['uname'] = "Admin";
            header("location:admin.php");
        }

        $db = new PDO('mysql:host=127.0.0.1;dbname=test', 'root', '');
        $sql = "select * from user_details where username=? and password=?";
        $stmt = $db->prepare($sql);
        if ($stmt->execute(array($username, $password))) {
            if ($stmt->rowcount() == 1) {
                while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $_SESSION['logged'] = "true";
                    $_SESSION['fname']=$r['firstname'];
                    $_SESSION['uname'] = $r["username"];
                    $_SESSION['add'] = $r['address'];
                    $_SESSION['email'] = $r['email'];
                    $_SESSION['mobile']=$r['mobile'];
                    $_SESSION['name'] = $r['firstname'] . " " . $r['lastname'];
                    $_SESSION['quantity']=0;
//                echo $_SESSION['uname'];
                    if (!empty(filter_input(INPUT_GET, 'back'))) {
                        header("location:" . filter_input(INPUT_GET, 'back'));
                    } else {
                        header("location:Menu.php?category=mains");
                    }
                }
            } else {
                $_SESSION['msg'] = "Invalid Credentials";
            }
        }
    }
}else{
    header("location:Menu.php?category=mains");
}
    ?>

    <html>
        <?php include('header.php') ?>
        <head>
            <style>
                body{

                    font-family: sans-serif;
                }

                .bg{
                    /*background-image: url("../images/pic1.jpg");*/

                    /* Add the blur effect */
                    filter: blur(8px);
                    -webkit-filter: blur(8px);

                    /* Full height */
                    height: 100%;

                    /* Center and scale the image nicely */
                    background-position: center;
                    background-repeat: no-repeat;
                    background-size: cover;
                }

                .loginbox{
                    margin-top: 220px;
                    width: 320px;
                    max-height: 500px;
                    background: #000;
                    color: #fff;
                    top: 50%;
                    left: 50%;
                    position: absolute;
                    transform: translate(-50%,-50%);
                    box-sizing: border-box;
                    padding: 70px 30px;
                }

                .avatar{
                    width: 100px;
                    height: 100px;
                    border-radius: 50%;
                    position: absolute;
                    top: -50px;
                    left: calc(50% - 50px);
                }

                h1{
                    margin: 0;
                    padding: 0 0 20px;
                    text-align: center;
                    font-size: 22px;
                }

                .loginbox p{
                    margin: 0;
                    padding: 0;
                    font-weight: bold;
                }

                .loginbox input{
                    width: 100%;
                    margin-bottom: 20px;
                }

                .loginbox input[type="text"], input[type="password"]
                {
                    border: none;
                    border-bottom: 1px solid #fff;
                    background: transparent;
                    outline: none;
                    height: 40px;
                    color: #fff;
                    font-size: 16px;
                }
                .loginbox input[type="submit"]
                {
                    border: none;
                    outline: none;
                    height: 40px;
                    width:55%;
                    background: #f15a22;
                    color: #fff;
                    font-size: 18px;
                    border-radius: 30px;
                    margin:20px auto;
                    display: block;
                }
                .loginbox input[type="submit"]:hover
                {
                    cursor: pointer;
                    color: #000;
                }
                .loginbox a{
                    text-decoration: none;
                    font-size: 12px;
                    line-height: 20px;
                    color: darkgrey;
                }

                .loginbox a:hover
                {
                    color: #ffc107;
                }

            </style>
        </head>
        <body>
        <center>

            <div class="loginbox" style="margin-top:300px">
            <!--<img src="../images/avatar.png" class="avatar">-->
                <?php if (!empty($_SESSION['msg'])) { ?>
                    <b id="error" style="color: red"><?php echo $_SESSION['msg']; ?></b>
                <?php } ?>
                <p id="error" style="color: red"></p>
                <h1>Login</h1>
                <form action="Login.php" method="post">
                    <p>Username</p>
                    <input type="text" id="username" name="username" placeholder="Enter Username">
                    <p>Password</p>
                    <input type="password" id="password" name="password" placeholder="Enter Password"><br>
                    <input type="submit" name="login" value="Login">
                    <a href="reg.php">Don't have an account?</a>
                </form>


            </div>
        </center>
        <div style="margin-top:700px"><?php include('footer.php') ?></div>
</body>

</html>
