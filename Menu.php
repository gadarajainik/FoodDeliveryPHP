<?php
session_start();
$db = new mysqli("localhost", "root", "", "test");

$add = filter_input(INPUT_POST, 'action');
$pid =(string)filter_input(INPUT_POST, 'pid');
$category=(string)filter_input(INPUT_GET, 'category');

if ($add === 'add') {
    $_SESSION['quantity']++;
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

$result = $db->query("select * from products where category='$category' ");
?>
<?php include 'header.php' ?>

                                <div class="deals">
                                    <div class="deals_title">
                                        <h1>Top amazing Pizzas!!!</h1>
                                    </div>
                                    <div class="sidenav" id="mySidenav">
                                        	<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                                        <a href="Menu.php?category=mains"><b>Mains</b></a>
                                        <a href="Menu.php?category=sides"><b>Sides</b></a>
                                        <a href="Menu.php?category=beverages"><b>Beverages</b></a>
                                        <a href="Menu.php?category=dessert"><b>Dessert</b></a>
                                    </div>
                                    <span style="font-size:30px;cursor:pointer;color:white;position:absolute;top:70%;left:2%;" onclick="openNav()">&#9776; open</span>
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
                                                        <b>&#x20b9;<?php echo $array["price"]; ?>&nbsp;&nbsp;&nbsp;</b><br>
                                                        <form action="Menu.php?category=<?php echo $category ?>" method="POST"> 
                                                        <input type="hidden" name="action" value="add">
                                                        <input type="hidden" name="pid" value="<?php echo $array["pid"] ?>"><br>
                                                        <input type="submit" class="btn1" value="Add To Cart">
                                                        </form>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>		


                            </body>
                           <?php include 'footer.php' ?>