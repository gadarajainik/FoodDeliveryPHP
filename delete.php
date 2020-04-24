
<?php
//including the database connection file
include("connect.php");
 
//getting id of the data from url
$username = $_GET['username'];
 
//deleting the row from table
$sql = "DELETE FROM user_details WHERE username=:username";
$query = $pdo->prepare($sql);
$query->execute(array(':username' => $username));
 
//redirecting to the display page (index.php in our case)
header("Location:Logout.php");
?>