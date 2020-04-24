<?php
session_start();
//including the database connection file

include_once("connect.php");


include("adminheader.php");


if(!isset($_SESSION['uname']) && $_SESSION['uname']!="Admin"){
    header("location:Login.php");
}

//fetching data in descending order (lastest entry first)
//$result = $pdo->query("SELECT * FROM user_details where username=:username");
$sql="select order_id,username,date,total,delivery_address from orders ";
$result = $pdo->prepare($sql);
//$result->execute();

    # code...

$result->execute();
//$result->bindparam(':username', $username);

?>
 
<html>
<head>    
    <title>Homepage</title>
</head>
 
<body>

    <div class="swe1">
        <h4 class="display-4" style="margin-top: 30px;">ALL ORDERS:</h4>
    </div>


    <div class="sai" style="margin-top: 200px;margin-bottom: 200px;">
 
    <table class="table table-hover table-bordered">

    <thead class="thead-dark"> 
    <tr>
        <th scope="row">Order-ID</th>
        <th scope="row">Username</th>
        <th scope="row">Date</th>
        <th scope="row">Price</th>
        <th scope="row">Address</th>
        
        
    </tr>
</thead>
    <?php     
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {         
        echo "<tr>";
        echo "<td>".$row['order_id']."</td>";
        echo "<td>".$row['username']."</td>";
        echo "<td>".$row['date']."</td>";
        echo "<td>".$row['total']."</td>";
        echo "<td>".$row['delivery_address']."</td>";
        echo "</tr>";
           
                
    }
    ?>

</tr>
    </table>


</div>
</body>


<?php include('footer.php');?>
</html>