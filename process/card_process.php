<?php
include ("DB/conn.php");
/*
--delete btn
*/
if (isset($_GET['delete_card'])){
    $card_id  = $_GET['delete_card'];
    $result = $conn->query("DELETE FROM card WHERE card_id ='$card_id'")or die($conn->error());
    header("location:card.php");
    $_SESSION['delete'] = "Record has been deleted";
}

/*
--edit btn
*/
$card_id = 0;
$update = false;
$customer_name = "";
$card_number = "";
$ccv = "";

if(isset($_GET['edit_card'])){
    $card_id = $_GET['edit_card'];
    $update = true;
    $result = $conn->query("SELECT * FROM card WHERE card_id=$card_id")or die($conn->error());
    $row = mysqli_fetch_assoc($result);
    $customer_name = $row['customer_name'];
    $card_number = $row['card_number'];               
    $ccv = $row['ccv']; 

}

/*
--update btn
*/
if(isset($_POST['update_card'])){
    $card_id = $_POST['card_id'];
    $customer_name = $_POST['customer_name'];
    $card_number = $_POST['card_number'];               
    $ccv = $_POST['ccv'];
    $result = $conn->query("UPDATE card SET customer_name='$customer_name', card_number='$card_number', ccv='$ccv' WHERE  card_id=$card_id")or die($conn->error());
    $_SESSION['success']="Record has been updated ";
    header("location:card.php");
    
} 

/*
--add card
*/

if(isset($_POST['card_login'])){
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $card_number = mysqli_real_escape_string($conn, $_POST['card_number']);
    $ccv = mysqli_real_escape_string($conn, $_POST['ccv']);

    if(empty($customer_name)){
        $_SESSION['c_e'] = "customer name is empty";
    }
    if(empty($card_number)){
        $_SESSION['card_e'] = "card number field is empty";
    }

    if(empty($ccv)){
        $_SESSION['ccv_e'] = "ccv field is empty";
    }else{
        $sql_cu = "SELECT * FROM card WHERE customer_name='$customer_name'";
        $res_cu = mysqli_query($conn, $sql_cu);

        $sql_c = "SELECT * FROM card WHERE card_number='$card_number'";
        $res_c = mysqli_query($conn, $sql_c);

        $sql_ccv = "SELECT * FROM card WHERE ccv='$ccv'";
        $res_ccv = mysqli_query($conn, $sql_ccv);

        $sql = "SELECT * FROM card WHERE card_number='$card_number' AND ccv='$ccv'";
        $res = mysqli_query($conn, $sql);
        if (mysqli_num_rows($res_cu) > 0){
            $_SESSION['c_e'] = "customer name already exist";
        }else if (mysqli_num_rows($res_c) > 0){
            $_SESSION['card_e'] = "invalid card number";
        }else if (mysqli_num_rows($res_ccv) > 0){
            $_SESSION['ccv_e'] = "invalid ccv ";
        }else if (mysqli_num_rows($res) > 0){
            $_SESSION['card_ccv_e']= "card number and ccv is invalid";
        }else{
            $sql = "INSERT INTO card (`customer_name`, `card_number`, `ccv`) VALUES ( '$customer_name', '$card_number', '$ccv')";
            $result = $conn->query($sql);
            $_SESSION['success'] = "Record has been added successfully";
            header("location:card.php");
        }
    }
}

    /*   
    --Count All card Table
    */
    $query = "SELECT COUNT(card_id) AS COUNT FROM `card`";
    $query_result = mysqli_query($conn, $query);

    $result = $conn->query("SELECT * FROM card")or die($conn->error());
    while($row = mysqli_fetch_assoc($query_result)){
    $card_output = ""." ".$row['COUNT'];
    }





?>