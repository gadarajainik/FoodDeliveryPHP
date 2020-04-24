<?php include 'header.php' ?>
<?php
// including the database connection file
include_once("connect.php");
  session_start();
        if(!isset($_SESSION['uname']))
        {
                header("location: Login.php");
        }
        $username=$_SESSION['uname'];
 
 
if(isset($_POST['update']))
{    
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $mobile=$_POST['mobile'];
    $email=$_POST['email'];
    $address=$_POST['address'];    
    // checking empty fields
    if(empty($username) ||  empty($email)) {    
            
        if(empty($username)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }
        
        
        if(empty($email)) {
            echo "<font color='red'>Email field is empty.</font><br/>";
        }        
    } else {    
        //updating the table
        $sql = "UPDATE user_details SET firstname=:firstname,lastname=:lastname,mobile=:mobile,email=:email,address=:address WHERE username=:username";
     
        $query = $pdo->prepare($sql);
        echo $username;
        echo $dob;
                
        $query->bindValue(':username', $username);
        $query->bindValue(':firstname', $firstname);
        $query->bindValue(':lastname', $lastname);
        $query->bindValue(':mobile', $mobile);
        $query->bindValue(':email', $email);
        $query->bindValue(':address', $address);
           $result1=$query->execute();
           if($result1>0)
           {echo 'records updated succesfully';}
        
        
        // Alternative to above bindparam and execute
        // $query->execute(array(':id' => $id, ':name' => $name, ':email' => $email, ':age' => $age));
                
        //redirectig to the display page. In our case, it is index.php
        header("Location: MyAccount.php");
    }
}
?>
<?php
//getting id from url
$username = $_GET['username'];
 
//selecting data associated with this particular id
$sql = "SELECT * FROM user_details WHERE username=:username";
$query = $pdo->prepare($sql);
$query->execute(array(':username' => $username));
 
while($row = $query->fetch(PDO::FETCH_ASSOC))
{
    $username = $row['username'];
    $password = $row['password'];
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    
    $mobile = $row['mobile'];
    $email = $row['email'];
    $address = $row['address'];
}
?>
<html>
<head>    
    <title>Edit Data</title>
</head>
 
<body>
    
    <form name="form1" method="post" action="edit.php">
        <table border="0">

            
            <tr> 
                <td>FirstName</td>
                <td><input type="text" name="firstname" value="<?php echo $firstname;?>"></td>
            </tr>
             <tr> 
                <td>LastName</td>
                <td><input type="text" name="lastname" value="<?php echo $lastname;?>"></td>
            </tr>
             
             <tr> 
                <td>Mobile</td>
                <td><input type="text" name="mobile" value="<?php echo $mobile;?>"></td>
            </tr>
            <tr> 
                <td>Email</td>
                <td><input type="text" name="email" value="<?php echo $email;?>"></td>
            </tr>
             <tr> 
                <td>Address</td>
                <td><input type="text" name="address" value="<?php echo $address;?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="username" value=<?php echo $_GET['username'];?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>
<?php include 'footer.php' ?>