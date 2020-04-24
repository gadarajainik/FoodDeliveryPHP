<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

$db = new mysqli("localhost", "root", "", "test");

$code = filter_input(INPUT_GET, "id");
$action = filter_input(INPUT_GET, "action");
$count = 0;
$sum = 0;
$sum1 = 0;

if ($_SESSION["logged"] == "true") {
    if ($action == "add") {
        $_SESSION['quantity']++;
        if (in_array($code, array_keys($_SESSION["cart"]))) {
            $_SESSION["cart"][$code]["quantity"] = $_SESSION["cart"][$code]["quantity"] + 1;
        }
    }
    if ($action == "remove") {
        if (in_array($code, array_keys($_SESSION["cart"]))) {
            $_SESSION['quantity']--;
            if ($_SESSION["cart"][$code]["quantity"] >= 1) {
                $_SESSION["cart"][$code]["quantity"] = $_SESSION["cart"][$code]["quantity"] - 1;
            } if ($_SESSION["cart"][$code]["quantity"] == 0) {
                unset($_SESSION["cart"][$code]);
            }
        }
    }
    if ($action == "delete") {
        $_SESSION['quantity']=$_SESSION['quantity']-$_SESSION["cart"][$code]['quantity'];
        unset($_SESSION["cart"][$code]);
    }
} else {
    header("location:Login.php?back=Cart.php");
}
//$sql = "select name,qua,price from buffercart where number='$number'";
//$result = $db->query($sql);
?>
<?php include('header.php') ?>
<?php if (!empty($_SESSION["cart"])) {
    ?>
    <center><h3 style="color:gray;text-height: 5px">----YOUR CART----</h3><br>
        <table border="2" style="float:left;margin-left: 50px;margin-top: 50px; width: 800px" >

            <?php
            foreach ($_SESSION["cart"] as $item) {
                ?>

                <?php ?>
                <!--<div class="l3">-->    
                <tr>
                    <td  width="50px"><img src="<?php echo $item["image"] ?>"height="80px" width="80px" ></img></td>
                    <td class="l1"><?php echo $item["name"] ?></td>
                    <td class="l4"><a href="Cart.php?action=remove&id=<?php echo $item['pid'] ?>&count=<?php echo $item["quantity"] ?>"><i class="fas fa-minus" style="padding:1px; background-color: gray; border: 2px solid;border-radius: 20px;color:white;"></i></a>  <?php echo $item["quantity"] ?>  <a href="Cart.php?action=add&id=<?php echo $item["pid"] ?>&count=<?php echo $item["quantity"] ?>"><i class="fas fa-plus" style="padding:1px; background-color: gray; border: 2px solid;border-radius: 20px;color:white;"></i></a> x <?php echo $item["price"] ?></td>
                    <td class="l3"><a href="Cart.php?action=delete&id=<?php echo $item['pid'] ?>"><i class="fas fa-trash-alt" style="padding:1px; background-color: transparent; border:none;border-radius: 20px;color:gray;"></i></a></td>
                    <td class="l2">&#x20b9; <?php echo $item["price"] * $item["quantity"] ?></td>
                    <?php
//                                echo $row["price"] * $row["qua"];
                    $sum = $sum + ($item["price"] * $item["quantity"]);
                    ?>
                </tr>
                <!--</div>-->
                <?php
            }
            $_SESSION["total"] = $sum;
            ?>
            <tr>
                <td colspan="4" style="text-align:right;">
                    <b>Total:
                </td>
                <td class="l2" ><b>&#x20b9; <?php echo$sum ?></td>
            </tr>
        </table><?php ?>
        <div class="container" style="height: 450px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" >
            <div style="text-align:left;display:inline "><h5>Subamount :</h5><h6 style="text-align:right;color: gray">&#x20b9; <?php echo $sum; ?></h6></br></div>
            <div style="text-align:left;display:inline "><h5>Tax : </h5><h6 style="text-align:right;color: gray">&#x20b9; <?php
                    echo$sum * 0.05;
                    $sum = $sum + 0.05 * $sum;
                    ?></h5></div>

            <br><form action="">
                <?php if ($sum >= 500) { ?>
                    <select name="promo">
                        <?php if ($sum > 500 && $sum < 1000) { ?>
                            <option value="DEAL150">DEAL150</option><pre>
                                  <input class="l2" type="submit" name="check" value="Check">
                                <?php
                            } else {
                                if ($sum > 1000 && $sum < 1500) {
                                    ?>
                                                                                                                                                                                                        <option value="DEAL150">DEAL150</option>
                                                                                                                                                                                                        <option value="DEAL200">DEAL200</option>
                                                                                                                                                                                                          <input type="submit" name="check" value="Check">
                                <?php }if ($sum > 1500) { ?>
                                                                                                                                                                                                        <option value="DEAL150">DEAL150</option>
                                                                                                                                                                                                        <option value="DEAL200">DEAL200</option>
                                                                                                                                                                                                        <option value="DEAL350">DEAL350</option>
                                                                                                                                                                                                                                                                                                                                                                                                                       <input type="submit" name="check" value="Check">
                                    <?php
                                }
                            }
                        }
                        ?>
                                                    </select>
                                                                             </form>


                        <?php
                        $sum_ini = filter_var($_SESSION['total']);
                        $sum = $sum_ini + $sum_ini * 0.05;
                        $_SESSION['total_ini'] = $sum_ini;
                        $_SESSION['total'] = $sum;
                        $_SESSION['grand_total'] = $sum;
                        if (filter_input(INPUT_GET, 'check')) {
                            ?>
                                                                                                    <h6 style="color: green">Congratulations!!!Promocode successfully applied.</h6>
                            <?php
                            if ((filter_input(INPUT_GET, 'promo') == 'DEAL150')) {
                                $sum1 = $sum - 150;
                                $_SESSION['grand_total'] = $sum1;
                                ?><br><h3>Grand Total: <?php echo $sum1 ?></h3><?php
                            } else {
                                if ((filter_input(INPUT_GET, 'promo') == 'DEAL200')) {
                                    $sum1 = $sum - 200;
                                    $_SESSION['grand_total'] = $sum1;
                                    ?><br><h3>Grand Total: <?php echo $sum1 ?></h3><?php
                                } else {
                                    if ((filter_input(INPUT_GET, 'promo') == 'DEAL350')) {
                                        $sum1 = $sum - 350;
                                        $_SESSION['grand_total'] = $sum1;
                                        ?><br><h3>Grand Total: <?php echo $sum1 ?></h3><?php
                                    } else {
                                        echo "INVALID PROMOCODE";
                                    }
                                }
                            }
                        } else {
                            $_REQUEST['grand_total'] = $sum;
                            ?><br><h3>Grand Total: <?php echo $sum ?></h3><?php
                        }
                        ?>
                            <form action="transaction.php" method="POST">
                                            <input class="btn" type="submit" name="proceed" value="Checkout">
                                                                                            </form>         
                                                                                            </div>
                    <?php } else { ?>
                                                <center><div class="full"><b>Your Cart is Empty</b><br><br><a href="Menu.php?category=mains"><input class="btn" type="button" value="Continue Shopping"></a></div></center>
                                                                                
                    <?php } ?>
                                                
                                                <div style="margin-top:800px;margin-left: -500px"><?php include 'footer.php'?></div>