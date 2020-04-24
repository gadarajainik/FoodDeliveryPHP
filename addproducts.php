<?php
session_start();
//including the database connection file
include_once("connect.php");
include("adminheader.php");


if (!isset($_SESSION['uname']) && $_SESSION['uname'] != "Admin") {
    header("location:Login.php");
}

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $image = $_POST['image'];
    $pid = $_POST['pid'];


    // checking empty fields
    if (empty($name) || empty($price) || empty($category) || empty($pid)) {

        if (empty($pid)) {
            echo "<font color='red'>PROduct-ID field is empty.</font><br/>";
        }

        if (empty($name)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }

        if (empty($price)) {
            echo "<font color='red'>price field is empty.</font><br/>";
        }

        if (empty($category)) {
            echo "<font color='red'>category field is empty.</font><br/>";
        }

        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else {
        // if all the fields are filled (not empty) 
        //insert data to database        
        $sql = "INSERT INTO products(pid,name, price, category,image) VALUES(:pid,:name, :price, :category,:image)";
        $query = $pdo->prepare($sql);

        $query->bindparam(':pid', $pid);
        $query->bindparam(':name', $name);
        $query->bindparam(':price', $price);
        $query->bindparam(':category', $category);
        $query->bindparam(':image', $image);
        $query->execute();

        // Alternative to above bindparam and execute
        // $query->execute(array(':name' => $name, ':email' => $email, ':age' => $age));
        //display success message

        header("location:viewproducts.php");
    }
}
?>

<html>
    <head>
        <style>
            body{
                background-color: white;
            }
        </style>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>
            ADD PRODUCTS
        </title>
        <link rel="stylesheet" href="addproduct.css">
    </head>
    <form action="addproducts.php" method="post">
        <div class="container" style="margin-left:450px;width:500px;height: 760px;">
            <h1>ADD PRODUCTS</h1>
            <p>fill all details</p>
            <hr>
            <label for="pid"><b>Product-ID</b></label>
            <input type="text" placeholder="Enter name" name="pid" required>

            <label for="name"><b>name</b></label>
            <input type="text" placeholder="Enter name" name="name" required>

            <label for="name"><b>price</b></label>
            <input type="text" placeholder="Enter price" name="price" required>



            <label for="name"><b>Category</b></label>
            <input type="text" placeholder="enter category" name="category" required>


            <label for="name"><b>Enter image address</b></label>
            <input type="text" placeholder="enter image" name="image" required>
            <hr>

            <button type="submit" name="add" class="registerbtn">Add</button>
            
        </div>


    </form>
</html>





