<?php
// including the database connection file

include("adminheader.php");
include_once("connect.php");


 $pid = $_GET['pid'];

session_start();

if(!isset($_SESSION['uname']) && $_SESSION['uname']!="Admin"){
    header("location:Login.php");
}




if(isset($_POST['update']))
{    
    $name=$_POST['name'];
    $price=$_POST['price'];
    $category=$_POST['category'];
    $image=$_POST['image'];
     

    // checking empty fields
    
        //updating the table
        $sql = "UPDATE products SET name=:name,price=:price, category=:category, image=:image WHERE pid=:pid";
     
        $query = $pdo->prepare($sql);
       
        
                
        $query->bindValue(':name', $name);
        $query->bindValue(':price', $price);
        $query->bindValue(':category', $category);
        $query->bindValue(':image', $image);
        $query->bindValue(':pid', $pid);
   
           $result1=$query->execute();
           if($result1>0)
           {header("location:viewproducts.php");}
        
        
        // Alternative to above bindparam and execute
        // $query->execute(array(':id' => $id, ':name' => $name, ':email' => $email, ':age' => $age));
                
        //redirectig to the display page. In our case, it is index.php
        // header("Location: viewproducts.php");
    
}
?>
<?php
//getting id from url
$pid = $_GET['pid'];
 
//selecting data associated with this particular id
$sql = "SELECT * FROM products WHERE pid=:pid";
$query = $pdo->prepare($sql);
$query->execute(array(':pid' => $pid));
 
while($row = $query->fetch(PDO::FETCH_ASSOC))
{
    $pid = $row['pid'];
    $name = $row['name'];
    $price = $row['price'];
    $category = $row['category'];
    $image = $row['image'];
   
}
?>
<html>
<head>    
    <title>Edit Data</title>
</head>
 
<body>
    
    <br/><br/>
    <form name="form1" method="post" action="updateproducts.php?pid=<?php echo $_GET['pid'];?>">
        <table border="0">

            
            <tr> 
                <td>Name</td>
                <td><input type="text" name="name" value="<?php echo $name;?>"></td>
            </tr>
             <tr> 
                <td>Price</td>
                <td><input type="text" name="price" value="<?php echo $price;?>"></td>
            </tr>
             <tr> 
                <td>category</td>
                <td><input type="text" name="category" value="<?php echo $category;?>"></td>
            </tr>
             <tr> 
                <td>image</td>
                <td><input type="text" name="image" value="<?php echo $image;?>"></td>
            </tr>
            
            <tr>
                <td><input type="hidden" name="pid" value=<?php echo $_GET['pid'];?>></td>
                <td><input type="submit" name="update" value="update"></td>
            </tr>
        </table>
    </form>
</body>

<?php
 include("footer.php");
?>
</html>

