<?php
//including the database connection file

include_once("connect.php");

session_start();
if (!isset($_SESSION['uname'])) {
    header('Location:Login.php');
}
$username = $_SESSION['uname'];
include("header.php");

//fetching data in descending order (lastest entry first)
//$result = $pdo->query("SELECT * FROM user_details where username=:username");
$sql = "select * from orders where username=:username";
//$sql="select username,date,name,price,delivery_address from products inner join(select orders.order_id,pid,quantity,username,date,delivery_address,total from order_detail inner join orders on order_detail.order_id=orders.order_id)as t on t.pid=products.pid where username=:username;";
$result = $pdo->prepare($sql);
//$result->execute();
# code...
$result->execute(array(':username' => $username))
//$result->bindparam(':username', $username);
?>

<html>
    <head>    
        <title>Homepage</title>
    </head>

    <body>

        <div class="swe1">
            <h4 class="display-4" style="margin-top: 30px;">MY PREVIOUS ORDERS:</h4>
        </div>



        <div class="sai" style="margin-top: 100px;margin-bottom: 200px;">
            <?php while ($row1 = $result->fetch(PDO::FETCH_ASSOC)) {
                ?>
            <b>Ordered on:</b>&nbsp;&nbsp;<?php echo $row1['date'] ;?><br>
            <b>Delivered At:</b>&nbsp;&nbsp;<?php echo $row1['delivery_address'] ;?><br><br>
                <table class="table table-hover table-bordered">

                    <thead class="thead-dark"> 
                        <tr>

                            <th scope="row">Image</th>
                            <th scope="row">Product Name</th>
                            <th scope="row">Quantity</th>
                            <th scope="row">Price</th>



                        </tr>
                    </thead>
                    <?php
                    $orderid = $row1['order_id'];
                    $sql2 = "select * from order_detail where order_id=:orderid";
                    $result2 = $pdo->prepare($sql2);
                    $result2->execute(array(':orderid' => $orderid));
                    ?> 
                    <?php
                    while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";?>
                    <td><img src="<?php echo $row['image'];?>" height="80px" width="80px"></td><?php
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['quantity'] . "x</td>";
                        echo "<td>" . $row['price'] . "</td>";

                        echo "</tr>";
                    }
                    ?>
                    <tr>
                        <td colspan="4" style="text-align: right"><b>Total:<?php echo $row1['total'] ;?></b></td>
                    </tr>
                </table>
            <br><br><br>
            <?php } ?>

        </div>
    </body>


    <?php include('footer.php'); ?>
</html>