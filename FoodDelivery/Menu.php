<?php
session_start();
$db = new mysqli("localhost", "root", "", "test");

$add = filter_input(INPUT_GET, 'action');
$pid = (string) filter_input(INPUT_GET, 'pid');
//echo $pid;

if ($add === 'add') {
//    echo "Hii";
    $result = $db->query("select * from products where pid='$pid'");
    $array = $result->fetch_assoc();
//    foreach ($_SESSION["cart"] as $item) {
//        echo "Before:".$array["pid"]."-".$item["name"]."-".$item["quantity"];
//    }
//    echo "ADD-".$array["pid"]."-".$array["name"];
    $itemArray = ["$pid" => ['name' => $array["name"], 'pid' => $array["pid"], 'image' => $array["image"], 'price' => $array["price"], 'quantity' => 1]];

    if (!empty($_SESSION["cart"])) {
        if (in_array($pid, array_keys($_SESSION["cart"]))) {
            foreach ($_SESSION["cart"] as $k => $v) {
                if ($pid == $k) {
//                    echo "EXSISTING";
                    $_SESSION["cart"][$k]["quantity"] = $_SESSION["cart"][$k]["quantity"] + 1;
                }
            }
        } else {
//            echo "UPDATE";
            $_SESSION["cart"] = array_merge($_SESSION["cart"], $itemArray);
        }
    } else {
//        echo "NEW";
        $_SESSION["cart"] = $itemArray;
    }

//    foreach ($_SESSION["cart"] as $item) {
//        echo "After:".$array["pid"]."-".$item["name"]."-".$item["quantity"];
//    }
}

$result = $db->query("select * from products ");
?>
<html>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>
            PIZZA MENU
        </title>
        <link rel="stylesheet" href="menu.css">
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"> 
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    </head>
    <nav class="navbar navbar-expand-sm navbar-dark fixed-top nimisha">
        <a class="navbar-brand" href="header.html">Home</a>
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link" href="Register.php">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Menu.php">Menu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Cart.php">Cart</a>
            </li>
            <li class="nav-item">
                <?php if (isset($_SESSION['uname'])) { ?>
                    <a class = "nav-link" href = "Logout.php"><i class = "fas fa-user" style = "font-size: 22px;margin-left: 850px;margin-top: -30px;display: inline-block"> <h5 style = "display:inline">
                                <?php echo $_SESSION['uname'];
                            } else {
                                ?>
                                <a class = "nav-link" href = "Login.php"><i class = "fas fa-user" style = "font-size: 22px;margin-left: 850px;margin-top: -30px;display: inline-block"> <h5 style = "display:inline">
                                            <?php
                                            echo "Login";
                                        }
                                        ?></h5></i></a>
                            </li>
                            </ul>
                            </nav>

                            <div class="container-fluid">
                                <div class="jumbotron">
                                    <h1 class="display">PIZZA Domenica</h1> 
                                    <h3 class="display2">L'arte  della pizza!Prime Pizza!</h3> 
                                </div>
                            </div>
                            <body>


                                <div class="deals">
                                    <div class="deals_title">
                                        <h1>Top amazing Pizzas!!!</h1>
                                    </div>
                                    <div class="deals_cards">
                                        <?php
                                        if (!empty($result)) {
                                            while ($array = $result->fetch_assoc()) {
                                                ?>
                                                <div class="card n1" style="width: 18rem;">
                                                    <img class="card-img-top" src="<?php echo $array["image"]; ?>" alt="Card image cap">
                                                    <div class="card-body">
                                                        <h5 class="card-title">"<?php echo $array["name"]; ?>"</h5>
                                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                        <b>&#x20b9;<?php echo $array["price"]; ?>&nbsp;&nbsp;&nbsp;</b>

                                                        <a href="Menu.php?action=add&pid=<?php echo $array["pid"] ?>"  class="btn btn-primary">Add To Cart</a>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>		


                            </body>
                            <footer class="footer">
                                <div class="about">
                                    <div class="about_heading">
                                        <h4>About</h4>
                                    </div>
                                    <div class="about_content">
                                        <ul class="ulno_marg">
                                            <li class="footer_li">Gift card</li>
                                            <li class="footer_li">FAQ</li>
                                            <li class="footer_li">Enquiry</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="legal">
                                    <div class="legal_heading">
                                        <h4>Legal</h4>
                                    </div>
                                    <div class="legal_content">
                                        <ul class="ulno_marg">
                                            <li class="footer_li">Disclaimer</li>
                                            <li class="footer_li">Terms & Conditions</li>
                                            <li class="footer_li">Privacy Policy</li>
                                        </ul>
                                    </div>

                                </div>
                                <div class="socialmedia">
                                    <div class="socialmedia_heading">
                                        <h4>Social Media</h4>
                                    </div>
                                    <div class="socialmedia_content">
                                        <i class="fab fa-facebook-square"></i>
                                        <i class="fab fa-instagram"></i>
                                        <i class="fab fa-twitter-square"></i>
                                    </div>

                                </div>


                            </footer>

                            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
                            </html>