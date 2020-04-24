<?php
//including the database connection file
include("connect.php");
 
//getting id of the data from url
$pid = $_GET['pid'];
 
//deleting the row from table
$sql = "DELETE FROM products WHERE pid=:pid";
$query = $pdo->prepare($sql);
$query->execute(array(':pid' => $pid));
 
//redirecting to the display page (index.php in our case)
header("Location:viewproducts.php");
?>