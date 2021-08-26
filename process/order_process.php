<?php
include ("DB/conn.php");






/*
--orders btn
*/
if(isset($_POST['add_order'])){
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $product_ordered = mysqli_real_escape_string($conn, $_POST['product_ordered']);
    $reference_number = mysqli_real_escape_string($conn, $_POST['reference_number']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $discount= mysqli_real_escape_string($conn, $_POST['discount']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $postal_code = mysqli_real_escape_string($conn, $_POST['postal_code']);
    if(empty($reference_number)){
        $_SESSION['r_error'] = "reference number field  is empty";
    }

    if(empty($quantity)){
        $_SESSION['q_error'] = "quantity field is empty";
    }

    if(empty($discount)){
        $_SESSION['d_error'] = "address field is  empty";
    }

    if(empty($address)){
        $_SESSION['a_error'] = "address field is empty";
    }

    if(empty($city)){
        $_SESSION['c_error'] = "city field is empty";
    }

    if(empty($country)){
        $_SESSION['co_error'] = "country field is empty";
    }

    if(empty($postal_code)){
        $_SESSION['p_error'] = "postal code field is empty";
    }else{
            // $sql = "INSERT INTO orders (`reference_number`, `quantity`, `discount`, `address`, `city`, `country`, `postal_code`) VALUES ( '$reference_number', '$quantity', '$discount', '$address', '$city', '$country', '$postal_code')";
            // $result = $conn->query($sql);
            // $_SESSION['success'] = "Record has been added successfully";
            // header("location:order.php");
            $sql = "INSERT INTO orders (`customer_name`, `product_ordered`, `reference_number`, `quantity`, `discount`, `address`, `city`, `country`, `postal_code`, `required_date`) VALUES ('$customer_name', '$product_ordered', '$reference_number', '$quantity', '$discount', '$address', '$city', '$country', '$postal_code', DATE_ADD(curdate(),INTERVAL 4 WEEK))";
            $result = $conn->query($sql);
        }
    
}

   /*   
    --Count All order Table
    */
    $query = "SELECT COUNT(order_id) AS COUNT FROM `orders`";
    $query_result = mysqli_query($conn, $query);

    $result = $conn->query("SELECT * FROM orders")or die($conn->error());
    while($row = mysqli_fetch_assoc($query_result)){
    $order_output = ""." ".$row['COUNT'];
    }

/*
--delete btn
*/
if (isset($_GET['delete_order'])){
    $order_id  = $_GET['delete_order'];
    $result = $conn->query("DELETE FROM orders WHERE order_id ='$order_id'")or die($conn->error());
    header("location:order.php");
    $_SESSION['delete'] = "Record has been deleted";
}

 /*
--edit btn
*/
$order_id = 0;
$customer_name = "";
$product_ordered = "";
$update = false;
$reference_number = "";
$quantity = "";
$discount = "";
$address = "";
$city = "";
$country = "";
$postal_code = "";

if(isset($_GET['edit_order'])){
    $order_id = $_GET['edit_order'];
    $update = true;
    $result = $conn->query("SELECT * FROM orders WHERE order_id=$order_id")or die($conn->error());
    $row = mysqli_fetch_assoc($result);
    $reference_number = $row['reference_number'];               
    $quantity = $row['quantity'];
    $discount =  $row['discount']; 
    $address = $row['address'];      
    $city = $row['city'];         
    $country = $row['country'];
    $postal_code = $row['postal_code'];                
    }
    


if(isset($_POST['update_order'])){
    $order_id = $_POST['order_id'];
    $customer_name = $_POST['customer_name'];
    $product_ordered = $_POST['product_ordered'];
    $reference_number = $_POST['reference_number'];               
    $quantity = $_POST['quantity'];
    $discount =  $_POST['discount']; 
    $address = $_POST['address'];       
    $city = $_POST['city'];
    $country = $_POST['country'];
    $postal_code= $_POST['postal_code']; 
    $result = $conn->query("UPDATE orders SET customer_name='$customer_name', product_ordered='$product_ordered', reference_number='$reference_number', quantity='$quantity', discount='$discount', address='$address', city='$city', country='$country', postal_code='$postal_code' WHERE  order_id=$order_id")or die($conn->error());
                 
    //$result = $conn->query("UPDATE orders SET reference_number='$reference_number', quantity='$quantity', discount='$discount', address='$address',  city='$city', country='$country', postal_code='$postal_code' WHERE  order_id=$order_id")or die($conn->error());
    $_SESSION['success']="Record has been updated ";
    header("location:order.php");


} 
?>
