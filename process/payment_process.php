<?php
include ("DB/conn.php");

/*
--refund  btn
*/
if (isset($_GET['refund_payment'])){
    $payment_id  = $_GET['refund_payment'];
    $image = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $product = mysqli_real_escape_string($conn, $_POST['product']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $customer = mysqli_real_escape_string($conn, $_POST['customer']);
    $amount_paid = mysqli_real_escape_string($conn, $_POST['amount_paid']);
    $card_number = mysqli_real_escape_string($conn, $_POST['card_number']);
    $ccv = mysqli_real_escape_string($conn, $_POST['ccv']);
    $target = "img/".basename($image);
    $update = true;
    $result = $conn->query("SELECT * FROM payment WHERE payment_id=$payment_id")or die($conn->error());
    $row = mysqli_fetch_assoc($result);
    $product = $row['product'];
    $quantity = $row['quantity'];
    $customer = $row['customer'];
    $amount_paid = $row['amount_paid'];               
    $card_number = $row['card_number'];
    $ccv = $row['ccv'];
    $result = $conn->query("DELETE FROM payment WHERE payment_id ='$payment_id'")or die($conn->error());
    $sql = "INSERT INTO refund (`product`, `quantity`, `customer`, `amount_paid`, `card_number`, `ccv`) VALUES ('$product', '$quantity', '$customer', '$amount_paid', '$card_number', '$ccv')";
    $result = $conn->query($sql);
    header("location:refund.php");
    $_SESSION['delete'] = "Record has been deleted";
}

/*
--delete btn
*/
if (isset($_GET['delete_payment'])){
    $payment_id  = $_GET['delete_payment'];
    $result = $conn->query("DELETE FROM payment WHERE payment_id ='$payment_id'")or die($conn->error());
    header("location:payment.php");
    $_SESSION['del_e'] = "Record has been deleted";
    }
/*
--edit btn
*/
$payment_id = 0;
$image = "";
$product = "";
$quantity = "";
$customer = "";
$update = false;
$amount_paid = "";
$card_number = "";
$ccv = "";

/*
--ediit btn
*/
if(isset($_GET['edit_payment'])){
    $payment_id = $_GET['edit_payment'];
    $update = true;
    $result = $conn->query("SELECT * FROM payment WHERE payment_id=$payment_id")or die($conn->error());
    $row = mysqli_fetch_assoc($result);
    $product = $row['product'];
    $quantity = $row['quantity'];
    $customer = $row['customer'];
    $amount_paid = $row['amount_paid'];               
    $card_number = $row['card_number'];
    $ccv = $row['ccv'];

}

/*
--update btn
*/
if(isset($_POST['update_payment'])){
    $payment_id = $_POST['payment_id'];
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
    $product = $_POST['product'];
    $quantity = $_POST['quantity'];
    $customer = $_POST['customer'];

    $amount_paid = $_POST['amount_paid'];               
    $card_number = $_POST['card_number'];
    $ccv = $_POST['ccv'];
   
      if($image_file){      
            $result = $conn->query("UPDATE payment SET image='$image_file', product='$product', quantity='$quantity', customer='$customer', amount_paid='$amount_paid', card_number='$card_number', ccv='$ccv'  WHERE  payment_id=$payment_id")or die($conn->error());
            $_SESSION['success']="Record has been updated ";
            header("location:payment.php");
      }else{
        $result = $conn->query("UPDATE payment SET product='$product', quantity='$quantity', customer='$customer', amount_paid='$amount_paid', card_number='$card_number', ccv='$ccv'  WHERE  payment_id=$payment_id")or die($conn->error());
        $_SESSION['success']="Record has been updated ";
        header("location:payment.php"); 
      }
    
} 

/*
--add customer
*/

if(isset($_POST['add_payment'])){
    $image = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $product = mysqli_real_escape_string($conn, $_POST['product']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $customer = mysqli_real_escape_string($conn, $_POST['customer']);
    $amount_paid = mysqli_real_escape_string($conn, $_POST['amount_paid']);
    $card_number = mysqli_real_escape_string($conn, $_POST['card_number']);
    $ccv = mysqli_real_escape_string($conn, $_POST['ccv']);
    $target = "img/".basename($image);
    if(empty($image)){
        $_SESSION['img_e'] = "image field is empty";
    }

    
    if(empty($product)){
        $_SESSION['error_p'] = "product field is empty";
    }

    
    if(empty($quantity)){
        $_SESSION['q_error'] = "quantity field is empty";
    }

    if(empty($customer)){
        $_SESSION['cus_e'] = "customer field is empty";
    }
    
    if(empty($amount_paid)){
        $_SESSION['a_error'] = "amount field is empty";
    }
    if(empty($card_number)){
        $_SESSION['error_c'] = "card number is empty";
    }
    if(empty($ccv)){
        $_SESSION['ccv_error'] = "ccv field is empty";
    }else{
        $sql_p = "SELECT * FROM payment WHERE product='$product'";
        $res_p = mysqli_query($conn, $sql_p);

        $sql_c = "SELECT * FROM payment WHERE customer='$customer'";
        $res_c = mysqli_query($conn, $sql_c);

        $sql_ca = "SELECT * FROM payment WHERE card_number='$card_number'";
        $res_ca = mysqli_query($conn, $sql_c);
        
        $sql_ccv = "SELECT * FROM payment WHERE ccv='$ccv'";
        $res_ccv = mysqli_query($conn, $sql_ccv);

        if(mysqli_num_rows ($res_p) > 0 ){
            $_SESSION['error_p'] = "product name already exist";
        }

        if(mysqli_num_rows ($res_c) > 0 ){
            $_SESSION['cus_e'] = "customer name already exist";
        }
        if(mysqli_num_rows ($res_ca) > 0 ){
            $_SESSION['error_c'] = "card number already exist";
        }
        if(mysqli_num_rows ($res_ccv) > 0 ){
            $_SESSION['ccv_error'] = "ccv number already exist";
        }else{
            $sql = "INSERT INTO payment (`image`, `product`,  `quantity`,  `customer`, `amount_paid`, `card_number`, `ccv`) VALUES ( '$image', '$product', '$quantity',  '$customer', '$amount_paid', '$card_number', '$ccv')";
            $result = $conn->query($sql);
            $_SESSION['success'] = "Record has been added successfully";
            header("location:payment.php");
        }

    }
}
    $query = "SELECT SUM(amount_paid * quantity) AS SUM FROM `payment`";
    $query_result = mysqli_query($conn, $query);

    $result = $conn->query("SELECT * FROM payment")or die($conn->error());
    while($row = mysqli_fetch_assoc($query_result)){
    $payment_add_output = ""." ".$row['SUM'];
    }
    

    /*   
    --COUNT All payment Table
    */
    $query = "SELECT COUNT(payment_id) AS COUNT FROM `payment`";
    $query_result = mysqli_query($conn, $query);

    $result = $conn->query("SELECT * FROM card")or die($conn->error());
    while($row = mysqli_fetch_assoc($query_result)){
    $payment_count = ""." ".$row['COUNT'];
    }






?>