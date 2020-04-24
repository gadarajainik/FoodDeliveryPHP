<?php
session_start();
//including the database connection file
include_once("connect.php");


include("adminheader.php");


if (!isset($_SESSION['uname']) && $_SESSION['uname'] != "Admin") {
    header("location:Login.php");
}
//fetching data in descending order (lastest entry first)
//$result = $pdo->query("SELECT * FROM user_details where username=:username");
$sql = "SELECT * FROM products";
$result = $pdo->prepare($sql);
$result->execute();
//$result->bindparam(':username', $username);
?>

<html>
    <head>    
        <title>View Products</title>
    </head>

    <body>


        <table class="table table-hover table-striped" >
            <thead>
                <tr>
                    <th>pid</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Images</th>
                    <th>Modify</th>
                </tr>
            </thead>



            <?php
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['pid'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td>" . $row['category'] . "</td>";
                echo "<td>" . $row['image'] . "</td>";
                echo "<td><a href=\"updateproducts.php?pid=$row[pid]\">Edit</a> | <a href=\"deleteproducts.php?pid=$row[pid]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
                echo "</tr>";
            }
            ?>

        </table>
    </body>

    <?php include('footer.php'); ?>
</html>