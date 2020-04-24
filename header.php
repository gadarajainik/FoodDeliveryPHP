<html>
    <head>
        <style>
            body{
                background-color: black;
            }
        </style>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>
            PIZZA MENU
        </title>
        <link rel="stylesheet" href="login.css">
        <link rel="stylesheet" href="menu.css">
        <link rel="stylesheet" href="registration.css">
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"> 
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
        <script>
            function openNav() {
                document.getElementById("mySidenav").style.width = "250px";
                document.getElementById("mySidenav").style.height = "300px";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
            }
        </script>
    </head>
    <nav class="navbar navbar-expand-sm navbar-dark fixed-top nimisha" style="background: black!important;">
        <a class="navbar-brand" href="Menu.php?category=mains">Home</a>
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link" href="reg.php">Register</a>
            </li>
            <li class="nav-item" style="width:100px">
                <a class="nav-link" href="about_us.php">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Menu.php?category=mains">Menu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Cart.php">Cart</a>
            </li>
            <li class="nav-item">
                <?php if (isset($_SESSION['fname'])) { ?>
                    <img src="https://cdn.iconscout.com/icon/free/png-256/avatar-375-456327.png"  style="width:3%;height:4%;display:inline-block; margin-left:800px; margin-top: 7px;">
                    <div class="dropdown">
                        <button class="dropbtn" style="margin-left:100px"><?php
                            echo $_SESSION['fname'];
                            ?></button> 
                        <div class="dropdown-content" style="margin-left:100px">
                            <a href="MyAccount.php">MyAccount</a>
                            <a href="myorder.php">Orders</a>
                            <a href="Logout.php">Logout</a>
                        </div>
                    </div>

                    <?php
                } else {
                    ?>
                    <a class = "nav-link" href = "Login.php" style="display:inline-block;"><img src="https://cdn.iconscout.com/icon/free/png-256/avatar-372-456324.png" style="width:3%;height:4%;display:inline-block; margin-left:850px;"> 
                        <?php
                        echo "Login";
                    }
                    ?></a>
            </li>
        </ul>
    </nav>



    <div class="jumbotron">
        <h1 class="display animated fadeInRight text-center">PIZZA Domenica</h1> 
        <h3 class="display2 animated fadeInLeft">L'arte  della pizza!Prime Pizza!</h3> 
    </div>

    