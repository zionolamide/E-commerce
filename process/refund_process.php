<?php
include ("DB/conn.php");


/*
--delete btn
*/
if (isset($_GET['delete_refund'])){
    $refund_id  = $_GET['delete_refund'];
    $result = $conn->query("DELETE FROM refund WHERE refund_id ='$refund_id'")or die($conn->error());
    header("location:refund.php");
    $_SESSION['delete'] = "Record has been deleted";
}

/*
--edit btn
*/
$refund_id = 0;
// $image = "";
$product = "";
$quantity = "";
$customer = "";
$update = false;
$amount_paid = "";
$card_number = "";
$ccv = "";
// $product_bought = "";
// $customer_name = "";

if(isset($_GET['edit_refund'])){
    $refund_id = $_GET['edit_refund'];
    $update = true;
    $result = $conn->query("SELECT * FROM refund WHERE refund_id=$refund_id")or die($conn->error());
    $row = mysqli_fetch_assoc($result);
    $product = $row['product'];
    $quantity = $row['quantity'];
    $customer = $row['customer'];
    $amount_paid = $row['amount_paid'];               
    $card_number = $row['card_number'];
    $ccv = $row['ccv'];

}

if(isset($_POST['update_refund'])){
    $refund_id = $_POST['refund_id'];
    $product = $_POST['product'];
    $quantity= $_POST['quantity'];
    $customer = $_POST['customer'];
    $amount_paid = $_POST['amount_paid'];               
    $card_number = $_POST['card_number'];
    $ccv = $_POST['ccv'];

        $result = $conn->query("UPDATE refund SET product='$product', quantity='$quantity',  customer='$customer', amount_paid='$amount_paid', card_number='$card_number', ccv='$ccv' WHERE refund_id=$refund_id")or die($conn->error());
        $_SESSION['success']="Record has been updated ";
        header("location:refund.php");

    
    
    
}  

/*
--add customer
*/

if(isset($_POST['add_refund'])){
    // $image = $_FILES['image']['name'];
    // $tempname = $_FILES['image']['tmp_name'];
    $product = mysqli_real_escape_string($conn, $_POST['product']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $customer = mysqli_real_escape_string($conn, $_POST['customer']);
    $amount_paid = mysqli_real_escape_string($conn, $_POST['amount_paid']);
    $card_number = mysqli_real_escape_string($conn, $_POST['card_number']);
    $ccv = mysqli_real_escape_string($conn, $_POST['ccv']);
    $target = "img/".basename($image);
    if(empty($amount_paid)){
        $_SESSION['a_error'] = "amount paid field is empty";
    }

    
    if(empty($card_number)){
        $_SESSION['c_error'] = "card number field is empty";
    }

    
    if(empty($ccv)){
        $_SESSION['ccv_error'] = "ccv field is empty";
    }

    // if(empty($product_bought)){
    //     $_SESSION['p_error'] = "product bought is empty";
    // }
    
    // if(empty($customer_name)){
    //     $_SESSION['cu_error'] = "customer name is empty";
    // }
    else{
            $sql = "INSERT INTO refund (`product`, `quantity`, `customer`, `amount_paid`, `card_number`, `ccv`) VALUES ('$product', '$quantity', '$customer', '$amount_paid', '$card_number', '$ccv')";
            $result = $conn->query($sql);
            $_SESSION['success'] = "Record has been added successfully";
            header("location:refund.php");
    }
}

    /*   
    --Count All customer Table
    */
    $query = "SELECT COUNT(refund_id) AS COUNT FROM `refund`";
    $query_result = mysqli_query($conn, $query);

    $result = $conn->query("SELECT * FROM refund")or die($conn->error());
    while($row = mysqli_fetch_assoc($query_result)){
    $refund_count = ""." ".$row['COUNT'];
    }
  /*   
    --Count All customer Table
    */
    $query = "SELECT SUM(amount_paid * quantity) AS SUM FROM `refund`";
    $query_result = mysqli_query($conn, $query);

    $result = $conn->query("SELECT * FROM refund")or die($conn->error());
    while($row = mysqli_fetch_assoc($query_result)){
    $refund_qty = ""." ".$row['SUM'];
    }





?>