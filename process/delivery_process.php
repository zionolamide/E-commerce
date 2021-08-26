<?php
include ("DB/conn.php");
/*
--orders btn
*/
if(isset($_POST['add_delivery'])){
    $customer = mysqli_real_escape_string($conn, $_POST['customer']);
    $product = mysqli_real_escape_string($conn, $_POST['product']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    if(empty($customer)){
        $_SESSION['cu_e'] = "customer name  is empty";
    }
    if(empty($product)){
        $_SESSION['p_e'] = "product field is empty";
    }
    if(empty($comment)){
        $_SESSION['c_error'] = "comment field  is empty";
    }else{
        $sql_c = "SELECT * FROM delivery WHERE customer='$customer'";
        $res_c = mysqli_query($conn, $sql_c);

        $sql_p = "SELECT * FROM delivery WHERE product='$product'";
        $res_p = mysqli_query($conn, $sql_p);

        if(mysqli_num_rows($res_c) > 0){
            $_SESSION['cu_e'] = "customer name already exist";
        }else if(mysqli_num_rows($res_p) > 0){
            $_SESSION['p_e'] = "product name already exist";
        }else{
            $sql = "INSERT INTO delivery (`customer`, `product`, `comment`) VALUES ('$customer', '$product', '$comment')";
            $result = $conn->query($sql);
        }
           
    }
    
}

   /*   
    --Count All delivery Table
    */
    $query = "SELECT COUNT(delivery_id) AS COUNT FROM `delivery`";
    $query_result = mysqli_query($conn, $query);

    $result = $conn->query("SELECT * FROM delivery")or die($conn->error());
    while($row = mysqli_fetch_assoc($query_result)){
    $delivery_output = ""." ".$row['COUNT'];
    }

/*
--delete btn
*/
if (isset($_GET['delete_delivery'])){
    $delivery_id  = $_GET['delete_delivery'];
    $result = $conn->query("DELETE FROM delivery WHERE delivery_id ='$delivery_id'")or die($conn->error());
    header("location:delivery.php");
    $_SESSION['delete'] = "Record has been deleted";
}

 /*
--edit btn
*/
$delivery_id = 0;
$customer = "";
$product = "";
$update = false;
$comment = "";


if(isset($_GET['edit_delivery'])){
    $delivery_id = $_GET['edit_delivery'];
    $update = true;
    $result = $conn->query("SELECT * FROM delivery WHERE delivery_id=$delivery_id")or die($conn->error());
    $row = mysqli_fetch_assoc($result);
    $customer = $row['customer'];
    $product = $row['product'];
    $comment = $row['comment'];                             
    }
    


if(isset($_POST['update_delivery'])){
    $delivery_id = $_POST['delivery_id'];
    $customer = $_POST['customer'];
    $product = $_POST['product'];
    $comment = $_POST['comment'];                
    $result = $conn->query("UPDATE delivery SET customer='$customer', product='$product', comment='$comment' WHERE  delivery_id=$delivery_id")or die($conn->error());
                 
    //$result = $conn->query("UPDATE orders SET reference_number='$reference_number', quantity='$quantity', discount='$discount', address='$address',  city='$city', country='$country', postal_code='$postal_code' WHERE  order_id=$order_id")or die($conn->error());
    $_SESSION['success']="Record has been updated ";
    header("location:delivery.php");


} 
?>
