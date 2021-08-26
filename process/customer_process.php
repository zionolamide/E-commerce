<?php
include ("DB/conn.php");
/*
--delete btn
*/
if (isset($_GET['delete_customer'])){
    $customer_id  = $_GET['delete_customer'];
    $result = $conn->query("DELETE FROM customer WHERE customer_id ='$customer_id'")or die($conn->error());
    header("location:customers.php");
    $_SESSION['delete'] = "Record has been deleted";
}

/*
--edit btn
*/
$customer_id = 0;
$update = false;
$image = "";
$fullname = "";
$email = "";
$phone = "";
$address = "";
$state = "";
$country = "";
$city = "";
$pwd = "";
$username = "";
if(isset($_GET['edit_customer'])){
    $customer_id = $_GET['edit_customer'];
    $update = true;
    $result = $conn->query("SELECT * FROM customer WHERE customer_id=$customer_id")or die($conn->error());
    $row = mysqli_fetch_assoc($result);
    $fullname = $row['fullname'];               
    $email = $row['email'];
    $phone =  $row['phone']; 
    $address = $row['address'];               
    $state = $row['state'];
    $country =  $row['country'];
    $city =  $row['city'];               
    $pwd =  $row['pwd'];
    $username =  $row['username']; 

}

/*
--update btn
*/
if(isset($_POST['update_customer'])){
    $customer_id = $_POST['customer_id'];
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
    $fullname = $_POST['fullname'];               
    $email = $_POST['email'];
    $phone =  $_POST['phone']; 
    $address = $_POST['address'];               
    $state = $_POST['state'];
    $country =  $_POST['country'];
    $city =  $_POST['city'];               
    $pwd =  $_POST['pwd'];
    $username =  $_POST['username']; 

    if($image_file){
      $result = $conn->query("UPDATE customer SET image='$image_file', fullname='$fullname', email='$email', phone='$phone', address='$address', state='$state', country='$country', city='$city', pwd='$pwd', username='$username' WHERE  customer_id=$customer_id")or die($conn->error());
      $_SESSION['success']="Record has been updated ";
      header("location:customers.php");
    }else{
      $result = $conn->query("UPDATE customer SET fullname='$fullname', email='$email', phone='$phone', address='$address', state='$state', country='$country', city='$city', pwd='$pwd', username='$username' WHERE  customer_id=$customer_id")or die($conn->error());
      $_SESSION['success']="Record has been updated ";
      header("location:customers.php");
    }
    
} 

/*
--add customer
*/

if(isset($_POST['customer_login'])){
    $image = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);

    $target = "img/".basename($image);

    if(empty($image)){
        $_SESSION['img_e'] = "you have not select any image";
    }

    if(empty($fullname)){
        $_SESSION['f_error'] = "fullname field is empty";
    }

    if(empty($email)){
        $_SESSION['e_error'] = "email field is empty";
    }

    if(empty($phone)){
        $_SESSION['p_error'] = "phone  number field is empty";
    }

    if(empty($address)){
        $_SESSION['a_error'] = "address field is empty";
    }

    if(empty($state)){
        $_SESSION['s_error'] = "state field is empty";
    }

    if(empty($country)){
        $_SESSION['c_error'] = "country field is empty";
    }

    if(empty($city)){
        $_SESSION['ci_e'] = "city field is empty";
    }

    if(empty($pwd)){
        $_SESSION['pwd_e'] = "password field is empty";
    }

    if(empty($username)){
        $_SESSION['u_error'] = "username field is empty";
    }else{
        $sql_u = "SELECT * FROM customer WHERE username='$username'";
        $sql_e = "SELECT * FROM customer WHERE email='$email'";
        $res_u = mysqli_query($conn, $sql_u);
        $res_e = mysqli_query($conn, $sql_e);
        if (mysqli_num_rows($res_u) > 0){
            $_SESSION['u_error'] = "username already taken";
        }else if(mysqli_num_rows($res_e) > 0){
            $_SESSION['e_error'] = "email already exist"; 
        }else{
            $sql = "INSERT INTO customer (`image`, `fullname`, `email`, `phone`, `address`, `state`, `country`, `city`, `pwd`, `username`) VALUES ( '$image', '$fullname', '$email', '$phone', '$address', '$state', '$country', '$city', '$pwd', '$username')";
            $result = $conn->query($sql);
            $_SESSION['success'] = "Record has been added successfully";
            header("location:customers.php");
        }
    }
}

    /*   
    --Count All customer Table
    */
    $query = "SELECT COUNT(customer_id) AS COUNT FROM `customer`";
    $query_result = mysqli_query($conn, $query);

    $result = $conn->query("SELECT * FROM customer")or die($conn->error());
    while($row = mysqli_fetch_assoc($query_result)){
    $customer_output = ""." ".$row['COUNT'];
    }





?>