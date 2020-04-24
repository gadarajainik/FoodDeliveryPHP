<?php
session_start();

if(!isset($_SESSION['uname']) && $_SESSION['uname']!="Admin"){
    header("location:Login.php");
}
?>
<!DOCTYPE html>
<html>
<title>ADMIN</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<!-- Sidebar -->
<div class="w3-sidebar w3-light-grey w3-bar-block" style="width:25%">
  <h3 class="w3-bar-item">Manage Task</h3>
  <a href="addproducts.php" class="w3-bar-item w3-button">Add Products</a>
  <a href="viewproducts.php" class="w3-bar-item w3-button">View Products</a>
  <a href="vieworder.php" class="w3-bar-item w3-button">View Orders</a>
  <a href="Logout.php" class="w3-bar-item w3-button">Logout</a>

</div>

<!-- Page Content -->
<div style="margin-left:25%">

<div class="w3-container w3-teal">
  <h1>Welcome,Admin!</h1>
</div>

<img src="image/pizza.jpg" alt="Car" style="width:100%">

<div class="w3-container">

</div>

</div>
      
</body>
</html>
