<?php
//including the database connection file
include_once("connect.php");
  session_start();
        if(!isset($_SESSION['uname']))
        {
                header('Location:Login.php');
        }
        $username=$_SESSION['uname'];

include("header.php");
//fetching data in descending order (lastest entry first)
//$result = $pdo->query("SELECT * FROM user_details where username=:username");
$sql="SELECT * FROM user_details where username=:username";
$result = $pdo->prepare($sql);
$result->execute(array(':username' => $username));
//$result->bindparam(':username', $username);

?>
 
<html>
<head>    
    <title>Homepage</title>
</head>
 
<body>

 
    <table class="table table-hover table-striped" >
    <thead>
    <tr>
        <th>Username</th>
        <th>FirstName</th>
        <th>LastName</th>
        <th>Mobile</th>
        <th>Email</th>
        <th>Address</th>
        <th>Modify</th>
    </tr>
</thead>

        
  
    <?php     
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {         
        echo "<tr>";
        echo "<td>".$row['username']."</td>";
        echo "<td>".$row['firstname']."</td>";
        echo "<td>".$row['lastname']."</td>";
        echo "<td>".$row['mobile']."</td>";
        echo "<td >".$row['email']."</td>";
        echo "<td>".$row['address']."</td>";    
        echo "<td><a href=\"edit.php?username=$row[username]\">Edit</a> | <a href=\"delete.php?username=$row[username]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";   
        echo "</tr>";     
    }
    ?>

    </table>
</body>

<?php include('footer.php');?>
</html>