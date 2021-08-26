<?php 
include ("DB/conn.php");

if(isset($_POST['add_product_variation'])){
    $image = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $colour = mysqli_real_escape_string($conn, $_POST['colour']);
    $availability = mysqli_real_escape_string($conn, $_POST['availability']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $target = "img/".basename($image);

    if(empty($image)){
        $_SESSION['img_error'] = "you have not selected any image";
        
    }
    if(empty($colour)){
        $_SESSION['c_error'] = "colour field is empty";
    }

    if(empty($availability)){
        $_SESSION['a_error'] = " 	availability field is empty";
    }
    if(empty($quantity)){
        $_SESSION['q_error'] = "quantity field is empty";
    }
    if(empty($price)){
        $_SESSION['pr_error'] = "price field is empty";
    }
    
    if(empty($product_name)){
        $_SESSION['p_error'] = "product name fiels is empty is empty";
    }else{
         $sql_p = "SELECT * FROM product_variation WHERE product_name=$price";
         $res_p = $conn->query($sql_p);
         if(mysqli_num_rows($res_p) > 0){
             $_SESSION['p_error'] = "product name already exist";
         }else{
            $sql = "INSERT INTO product_variation (`image`, `colour`, `availability`, `quantity`, `price`, `product_name`) VALUES ( '$image', '$colour', '$availability', '$quantity', '$price', '$product_name')";
            $result = $conn->query($sql);
            $_SESSION['success'] = "Record has been added successfully";
            header("location:product_variation.php");
         }
        
            
        }
    
}

 /*   
--Count All product_variation Table
*/
$query = "SELECT COUNT(product_variation_id) AS COUNT FROM `product_variation`";
$query_result = mysqli_query($conn, $query);

$result = $conn->query("SELECT * FROM product_variation")or die($conn->error());
while($row = mysqli_fetch_assoc($query_result)){
$product_variation_output = ""." ".$row['COUNT'];
}

/*
--edit btn
*/
$product_variation_id = 0;
$update = false;
$image = "";
$colour = "";
$availability = "";
$quantity = "";
$price = "";
$product_name = "";

if(isset($_GET['edit_product_variation'])){
$product_variation_id = $_GET['edit_product_variation'];
$update = true;
$result = $conn->query("SELECT * FROM product_variation WHERE product_variation_id=$product_variation_id")or die($conn->error());
$row = mysqli_fetch_assoc($result);               
$colour = $row['colour'];
$availability  =  $row['availability']; 
$quantity = $row['quantity'];      
$price = $row['price'];     
$product_name = $row['product_name'];      
}


if(isset($_POST['update_product_variation'])){
$product_variation_id = $_POST['product_variation_id'];
    if(isset($_FILES['image']['name']) && ($_FILES['image']['name']!="")){
        $size = $_FILES['image']['size'];
        $temp = $_FILES['image']['tmp_name'];
        $type = $_FILES['image']['type'];
        $image_file = $_FILES['image']['name'];
        //delete old file from the folder
        unlink("img/$old_image");
        //new image uploaded to the folder
        move_uploaded_file($temp, "img/".$image_file);

    }else{
        $image_file = $old_image;
    }               
    $colour = $_POST['colour'];
    $availability =  $_POST['availability']; 
    $quantity = $_POST['quantity'];       
    $price = $_POST['price'];      
    $product_name = $_POST['product_name'];  
        if($image_file){  
        $result = $conn->query("UPDATE product_variation SET image='$image_file', colour='$colour', availability='$availability', quantity='$quantity',  price='$price', product_name='$product_name' WHERE  product_variation_id=$product_variation_id")or die($conn->error());
        $_SESSION['success']="Record has been updated ";
        header("location:product_variation.php");
        }else{
            $result = $conn->query("UPDATE product_variation SET colour='$colour', availability='$availability', quantity='$quantity',  price='$price', product_name='$product_name' WHERE  product_variation_id=$product_variation_id")or die($conn->error());
            $_SESSION['success']="Record has been updated ";
            header("location:product_variation.php");
            
        }
} 

/*
--delete btn
*/
if (isset($_GET['delete_product_variation'])){
$product_variation_id  = $_GET['delete_product_variation'];
$result = $conn->query("DELETE FROM product_variation WHERE product_variation_id ='$product_variation_id'")or die($conn->error());
header("location:product_variation.php");
$_SESSION['del_e'] = "Record has been deleted";
}




?>




