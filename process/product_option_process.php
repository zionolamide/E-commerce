<?php 
include ("DB/conn.php");

if(isset($_POST['add_product_option'])){
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $colour = mysqli_real_escape_string($conn, $_POST['colour']);
    $size = mysqli_real_escape_string($conn, $_POST['size']);
    $sku = mysqli_real_escape_string($conn, $_POST['sku']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);

    if(empty($product_name)){
        $_SESSION['p_error'] = "product name field is empty";
    }

    if(empty($colour)){
        $_SESSION['c_error'] = "colour field is empty";
    }

    if(empty($size)){
        $_SESSION['s_error'] = "size field is empty";
    }

    if(empty($sku)){
        $_SESSION['sku_error'] = "sku field is empty";
    }
    
    if(empty($price)){
        $_SESSION['p_e'] = "price field is empty";
    }
    if(empty($quantity)){
        $_SESSION['q_error'] = "quantity is empty";
    }else{
            $sql = "INSERT INTO product_option (`product_name`, `colour`, `size`, `sku`, `price`, `quantity`) VALUES ( '$product_name', '$colour', '$size', '$sku', '$price', '$quantity')";
            $result = $conn->query($sql);
            $_SESSION['success'] = "Record has been added successfully";
            header("location:product_option.php");
        }
    
}

 /*   
--Count All product option Table
*/
$query = "SELECT COUNT(product_option_id) AS COUNT FROM `product_option`";
$query_result = mysqli_query($conn, $query);

$result = $conn->query("SELECT * FROM product_option")or die($conn->error());
while($row = mysqli_fetch_assoc($query_result)){
$product_option_output = ""." ".$row['COUNT'];
}

/*   
--sum All price field
*/
$query = "SELECT SUM(price * quantity) AS SUM FROM `product_option`";
$query_result = mysqli_query($conn, $query);

$result = $conn->query("SELECT * FROM product_option")or die($conn->error());
while($row = mysqli_fetch_assoc($query_result)){
$result_output= ""." ".$row['SUM'];
}



/*
--edit btn
*/
$product_option_id = 0;
$update = false;
$product_name = "";
$colour = "";
$size = "";
$sku = "";
$price = "";
$quantity = "";

if(isset($_GET['edit_product_option'])){
$product_option_id = $_GET['edit_product_option'];
$update = true;
$result = $conn->query("SELECT * FROM product_option WHERE product_option_id=$product_option_id")or die($conn->error());
$row = mysqli_fetch_assoc($result);
$product_name = $row['product_name'];               
$colour = $row['colour'];
$size =  $row['size']; 
$sku = $row['sku'];      
$price = $row['price'];
$quantity = $row['quantity'];              
}


if(isset($_POST['update_product_option'])){
$product_option_id = $_POST['product_option_id'];
$product_name = $_POST['product_name'];               
$colour = $_POST['colour'];
$size=  $_POST['size']; 
$sku = $_POST['sku'];       
$price = $_POST['price'];  
$quantity = $_POST['quantity'];              
  $result = $conn->query("UPDATE product_option SET product_name='$product_name', colour='$colour', size='$size', sku='$sku',  price='$price', quantity='$quantity' WHERE  product_option_id=$product_option_id")or die($conn->error());
  $_SESSION['success']="Record has been updated ";
  header("location:product_option.php");
} 

/*
--delete btn
*/
if (isset($_GET['delete_product_option'])){
$product_option_id  = $_GET['delete_product_option'];
$result = $conn->query("DELETE FROM product_option WHERE product_option_id ='$product_option_id'")or die($conn->error());
header("location:product_option.php");
$_SESSION['del_e'] = "Record has been deleted";
}
?>




