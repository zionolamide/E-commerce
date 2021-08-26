<?php
include ("DB/conn.php");

/*
--delete btn
*/
if (isset($_GET['delete_transaction'])){
    $transaction_id  = $_GET['delete_transaction'];
    $result = $conn->query("DELETE FROM transactions WHERE transaction_id ='$transaction_id'")or die($conn->error());
    header("location:transaction.php");
    $_SESSION['delete'] = "Record has been deleted";
}

/*
--edit btn
*/
$transaction_id = 0;
$amount= "";
$description = "";
$update = false;

if(isset($_GET['edit_transaction'])){
    $transaction_id = $_GET['edit_transaction'];
    $update = true;
    $result = $conn->query("SELECT * FROM transactions WHERE transaction_id=$transaction_id")or die($conn->error());
    $row = mysqli_fetch_assoc($result);
    $amount = $row['amount'];
    $description = $row['description'];

}

/*
--update btn
*/
if(isset($_POST['update_transaction'])){
    $transaction_id = $_POST['transaction_id'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    
    $result = $conn->query("UPDATE transactions SET amount='$amount', description='$description' WHERE transaction_id=$transaction_id")or die($conn->error());
    $_SESSION['success']="Record has been updated ";
    header("location:transaction.php");
    
    
}  

/*
--add transactions
*/

if(isset($_POST['add_transaction'])){
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    if(empty($amount)){
        $_SESSION['a_e'] = "amount field is empty";
    }

    
    if(empty($description)){
        $_SESSION['d_e'] = "description field is empty";
    }else{
            $sql = "INSERT INTO transactions (`amount`, `description`) VALUES ( '$amount', '$description')";
            $result = $conn->query($sql);
            $_SESSION['success'] = "Record has been added successfully";
            header("location:transaction.php");
    }
}

    /*   
    --Sum All transaction Table
    */
    $query = "SELECT SUM(amount) AS SUM FROM `transactions`";
    $query_result = mysqli_query($conn, $query);

    $result = $conn->query("SELECT * FROM transactions")or die($conn->error());
    while($row = mysqli_fetch_assoc($query_result)){
    $transaction_output = ""." ".$row['SUM'];
    }

    /*   
    --Count All transaction Table
    */
    $query = "SELECT COUNT(transaction_id) AS COUNT FROM `transactions`";
    $query_result = mysqli_query($conn, $query);

    $result = $conn->query("SELECT * FROM transactions")or die($conn->error());
    while($row = mysqli_fetch_assoc($query_result)){
    $count_transaction_output = ""." ".$row['COUNT'];
    }





?>