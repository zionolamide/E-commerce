<?php
include ("DB/conn.php");

/*
--delete btn
*/
if (isset($_GET['delete_store'])){
    $store_id  = $_GET['delete_store'];
    $result = $conn->query("DELETE FROM store WHERE store_id ='$store_id'")or die($conn->error());
    header("location:store.php");
    $_SESSION['delete'] = "Record has been deleted";
}

/*
--edit btn
*/
$store_id = 0;
$update = false;
$store_name = "";
$phone = "";
$email = "";
$street= "";
$city = "";
$state = "";
$zip_code = "";

if(isset($_GET['edit_store'])){
    $store_id = $_GET['edit_store'];
    $update = true;
    $result = $conn->query("SELECT * FROM store WHERE store_id=$store_id")or die($conn->error());
    $row = mysqli_fetch_assoc($result);
    $store_name = $row['store_name'];               
    $phone = $row['phone'];
    $email = $row['email'];               
    $street = $row['street'];
    $city = $row['city'];               
    $state = $row['state'];
    $zip_code = $row['zip_code'];            

}

/*
--update btn
*/
if(isset($_POST['update_store'])){
    $store_id = $_POST['store_id'];
    
    $store_name = $_POST['store_name'];               
    $phone = $_POST['phone'];
    $email = $_POST['email'];               
    $street = $_POST['street'];
    $city = $_POST['city'];               
    $state= $_POST['state'];
    $zip_code = $_POST['zip_code'];               
    $result = $conn->query("UPDATE store SET store_name='$store_name', phone='$phone', email='$email', street='$street', city='$city', state='$state', zip_code='$zip_code' WHERE  store_id=$store_id")or die($conn->error());
    $_SESSION['success']="Record has been updated ";
    header("location:store.php");
    
} 

/*
--add customer
*/

if(isset($_POST['add_store'])){

    $store_name = mysqli_real_escape_string($conn, $_POST['store_name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $street = mysqli_real_escape_string($conn, $_POST['street']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $zip_code= mysqli_real_escape_string($conn, $_POST['zip_code']);
    
    if(empty($store_name)){
        $_SESSION['s_error'] = "store namefield is empty";
    }

    if(empty($phone)){
        $_SESSION['p_error'] = "phone field is empty";
    }

    if(empty($email)){
        $_SESSION['e_error'] = "email field is empty";
    }

    if(empty($street)){
        $_SESSION['street_e'] = "street field is empty";
    }

    if(empty($city)){
        $_SESSION['city_e'] = "city field is empty";
    }

    if(empty($state)){
        $_SESSION['state_e'] = "state field is empty";
    }

    if(empty($zip_code)){
        $_SESSION['zip_e'] = "zip code field is empty";
    }
    else{
        $sql_s = "SELECT * FROM store WHERE store_name='$store_name'";
        $res_s = mysqli_query($conn, $sql_s);

        $sql_e = "SELECT * FROM store WHERE email='$email'";
        $res_e = mysqli_query($conn, $sql_e);
        if (mysqli_num_rows($res_s) > 0){
            $_SESSION['s_error'] = "store name already exist";
        }else if (mysqli_num_rows($conn, $sql_e) > 0){
            $_SESSION['e_error'] = "email  already exist";
        }else{
            $sql = "INSERT INTO store (`store_name`, `phone`, `email`, `street`, `city`, `state`, `zip_code`) VALUES ('$store_name', '$phone', '$email', '$street', '$city', '$state', '$zip_code')";
            $result = $conn->query($sql);
            $_SESSION['success'] = "Record has been added successfully";
            header("location:store.php");
        }
    }
}

    /*   
    --Count All store Table
    */
    $query = "SELECT COUNT(store_id) AS COUNT FROM `store`";
    $query_result = mysqli_query($conn, $query);

    $result = $conn->query("SELECT * FROM store")or die($conn->error());
    while($row = mysqli_fetch_assoc($query_result)){
    $store_output = ""." ".$row['COUNT'];
    }





?>