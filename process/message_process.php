<?php
include ("DB/conn.php");


/*
--orders btn
*/
if(isset($_POST['add_message'])){
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    
    if(empty($customer_name)){
        $_SESSION['c_error'] = "customer name field  is empty";
    }
     if(empty($message)){
        $_SESSION['m_e'] = "message field is empty";
    }else{
        $sql_c = "SELECT * FROM messages WHERE customer_name='$customer_name'";
        $res_c = mysqli_query($conn, $sql_c);
        if(mysqli_num_rows($res_c) > 0 ){
            $_SESSION['c_error'] = "customer name already exist";
        }else{
            $sql = "INSERT INTO messages (`customer_name`, `message`) VALUES ('$customer_name', '$message')";
            $result = $conn->query($sql);
        }
            
    }
    
}

   /*   
    --Count All message Table
    */
    $query = "SELECT COUNT(message_id) AS COUNT FROM `messages`";
    $query_result = mysqli_query($conn, $query);

    $result = $conn->query("SELECT * FROM messages")or die($conn->error());
    while($row = mysqli_fetch_assoc($query_result)){
    $message_output = ""." ".$row['COUNT'];
    }

/*
--delete btn
*/
if (isset($_GET['delete_message'])){
    $message_id  = $_GET['delete_message'];
    $result = $conn->query("DELETE FROM messages WHERE message_id='$message_id'")or die($conn->error());
    header("location:message.php");
    $_SESSION['delete'] = "Record has been deleted";
}

 /*
--edit btn
*/
$message_id = 0;
$customer_name = "";
$message = "";
$update = false;


if(isset($_GET['edit_message'])){
    $message_id = $_GET['edit_message'];
    $update = true;
    $result = $conn->query("SELECT * FROM messages WHERE message_id=$message_id")or die($conn->error());
    $row = mysqli_fetch_assoc($result);
    $customer_name = $row['customer_name'];               
    $message = $row['message'];
               
    }
    


if(isset($_POST['update_message'])){
    $message_id = $_POST['message_id'];
    $customer_name = $_POST['customer_name'];
    $message= $_POST['message'];
    
    $result = $conn->query("UPDATE messages SET customer_name='$customer_name', message='$message' WHERE  message_id=$message_id")or die($conn->error());
                 
   
    $_SESSION['success']="Record has been updated ";
    header("location:message.php");


} 
?>
