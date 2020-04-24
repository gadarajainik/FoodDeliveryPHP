<?php
session_start();
?>
<?php include('header.php'); ?>
<div style="display: block">
    <?php
    if (!empty($_SESSION["cart"])) {
        $db = new mysqli("localhost", "root", "", "test");
        $uname = $_SESSION['uname'];
        $date = date("Y/m/d");
        $add = $_POST['address'];
        $order_id = random_int(100000, 999999);
        $total = $_SESSION['grand_total'];
        $sql1 = "INSERT INTO orders values('$uname','$order_id','$date','$add','$total')";
        $query1 = $db->query($sql1);
        foreach ($_SESSION["cart"] as $item) {
            $pid = $item["pid"];
            $quantity = $item["quantity"];
            $name = $item["name"];
            $image = $item["image"];
            $price = $item["price"];
            $sql2 = "INSERT INTO order_detail values('$order_id','$pid','$quantity','$price','$image','$name')";
            $query2 = $db->query($sql2);
        }
        $to = $_POST['email'];
        $subject = 'Pizza Domenica Order-' . $order_id;
        $message = 'Your Order has been placed successfully with '
                . 'total amount-' . $_SESSION['grand_total'];
        $headers = "From: demo56651@gmail.com\r\n";
        if (mail($to, $subject, $message, $headers) && $query1 && $query2) {
            ?>
            <center><h4 style="color:green">Your Order Is Successfully Placed</h4><form action="" method="POST"><br><a href="Menu.php?category=mains"><input style="width: 200px" class="btn" type="submit" name="continue" value="Continue Ordering"></a></form></center>

            <br><br><center><h3 style="color:gray;">----SUMMARY----</h3><center><br>
                    <center>
                        <table border="2" style="float:left;margin-left: 50px;margin-top: 50px; width: 800px">

                            <?php
                            foreach ($_SESSION["cart"] as $item) {
                                ?>

                                <!--<div class="l3">-->    
                                <tr>
                                    <td  width="50px"><img src="<?php echo $item["image"] ?>"height="80px" width="80px" ></img></td>
                                    <td class="l1"><?php echo $item["name"] ?></td>
                                    <td class="l4"><?php echo $item["quantity"] ?></td>
                                    <td class="l2">&#x20b9; <?php echo $item["price"] * $item["quantity"] ?></td>
                                </tr>
                                <?php
                            }
                            ?><tr><td style="text-align: right" colspan="4"><h4>SubAmount: &#x20b9;<?php echo $_SESSION['total_ini'] ?></h4></tr>
                            <tr><td style="text-align: right" colspan="4"><h4>Tax: &#x20b9;<?php echo 0.05 * $_SESSION['total_ini'] ?></h4></tr>
                            <tr><td style="text-align: right" colspan="4"><h4>Discount: &#x20b9;<?php echo $_SESSION['total'] - $_SESSION['grand_total']; ?></h4></td></tr>
                            <tr><td style="text-align: right" colspan="4"><h4>Amount: &#x20b9;<?php echo $_SESSION['grand_total'] ?></h4></tr>
                        </table></center><br><br>
                    <?php
                    unset($_SESSION['cart']);
                } else {
                    ?>
                    <center><h4 style="color:red">Something went Wrong !!!!</h4></center>
                    <?php
                }
            } else {
                header("location:Menu.php?category=mains");
            }
            ?>
            </div>
            <div style="margin-top:500px"><?php include('footer.php'); ?><div>
