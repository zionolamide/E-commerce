<?php 
include ("DB/conn.php");
if(isset($_POST['add_discount'])){
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $discount_value = mysqli_real_escape_string($conn, $_POST['discount_value']);
    $coupon_code = mysqli_real_escape_string($conn, $_POST['coupon_code']);
    $max_discount_value = mysqli_real_escape_string($conn, $_POST['max_discount_value']);
    $min_order_value = mysqli_real_escape_string($conn, $_POST['min_order_value']);

    if(empty($product_name)){
        $_SESSION['p_error'] = "product name field is empty";
    }

    if(empty($discount_value)){
        $_SESSION['d_error'] = "discount value field is empty";
    }

    if(empty($coupon_code)){
        $_SESSION['c_error'] = "coupon code field is empty";
    }

    if(empty($max_discount_value)){
        $_SESSION['m_error'] = "max discount value field is empty";
    }
    
    if(empty($min_order_value)){
        $_SESSION['min_error'] = "min order value field is empty";
    }else{
            $sql = "INSERT INTO discount (`product_name`, `discount_value`, `coupon_code`, `max_discount_value`, `min_order_value`) VALUES ('$product_name', '$discount_value', '$coupon_code', '$max_discount_value', '$min_order_value')";
            $result = $conn->query($sql);
            $_SESSION['success'] = "Record has been added successfully";
            header("location:discount.php");
        }
    
}

 /*   
--Count All discount Table
*/
$query = "SELECT COUNT(discount_id) AS COUNT FROM `discount`";
$query_result = mysqli_query($conn, $query);

$result = $conn->query("SELECT * FROM discount")or die($conn->error());
while($row = mysqli_fetch_assoc($query_result)){
    $discount_output = ""." ".$row['COUNT'];
}

/*
--edit btn
*/
$discount_id = 0;
$update = false;
$product_name = "";
$discount_value = "";
$coupon_code = "";
$max_discount_value = "";
$min_order_value = "";

if(isset($_GET['edit_discount'])){
$discount_id = $_GET['edit_discount'];
$update = true;
$result = $conn->query("SELECT * FROM discount WHERE discount_id=$discount_id")or die($conn->error());
$row = mysqli_fetch_assoc($result);
$product_name = $row['product_name'];               
$discount_value = $row['discount_value'];
$coupon_code =  $row['coupon_code']; 
$max_discount_value = $row['max_discount_value'];      
$min_order_value = $row['min_order_value'];         
}


if(isset($_POST['update_discount'])){
    $discount_id = $_POST['discount_id'];
    $product_name = $_POST['product_name'];               
    $discount_value = $_POST['discount_value'];
    $coupon_code =  $_POST['coupon_code']; 
    $max_discount_value = $_POST['max_discount_value'];       
    $min_order_value = $_POST['min_order_value']; 

    $result = $conn->query("UPDATE discount SET product_name='$product_name', discount_value='$discount_value', coupon_code='$coupon_code', max_discount_value='$max_discount_value',  min_order_value='$min_order_value' WHERE  discount_id=$discount_id")or die($conn->error());
    $_SESSION['success']="Record has been updated ";
    header("location:discount.php");

} 

/*
--delete btn
*/
if (isset($_GET['delete_discount'])){
$discount_id  = $_GET['delete_discount'];
$result = $conn->query("DELETE FROM discount WHERE discount_id ='$discount_id'")or die($conn->error());
header("location:discount.php");
$_SESSION['del_e'] = "Record has been deleted";
}
?>




