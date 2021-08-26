<?php

include ("DB/conn.php");
if(isset($_POST['admin_login'])){
    /*
    --receive all input values from the form
    */
    $pwd = "";
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    /*
    --form validation: ensure that the form is correctly filled 
    */
    if(empty($pwd)){ 
        $_SESSION['pwd_error'] ="password field is empty";
    }else{
        $sql_p ="SELECT * FROM admins WHERE pwd='$pwd'";
        $res_p = mysqli_query($conn, $sql_p);
        if(mysqli_num_rows ($res_p) > 0 ){
            $admin = $res_p->fetch_assoc();
            $_SESSION['login'] = $admin;

            
            header("location:customers.php");
        }
        $_SESSION['pwd_error'] = "access denied";
        // else{
        //     $sql = "SELECT * FROM admins WHERE pwd='$pwd'";
        //     $res = mysqli_query($conn, $sql);
        //     if(mysqli_num_rows($res) == 0){
        //         $_SESSION['pwd_error']="password is not correct";
        //     }
            //else{
            //     $sql = "INSERT INTO admins (`pwd`) VALUES ( '$pwd')";
            //     $result = $conn->query($sql);
            //     $_SESSION['success'] = "Record has been added successfully";
            //     header("location:admin_details.php");
            // }
        // }
    }
        
}



if(isset($_POST['add_admin'])){
    /*
    --receive all input values from the form
    */
    $image = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);


    $target = "img/".basename($image);

    /*
    --form validation: ensure that the form is correctly filled 
    */

    if(empty($image)){
        $_SESSION['img_e'] = "you have not select any image";
    }
    if(empty($pwd)){ 
        $_SESSION['pwd_e'] ="password field is empty";
    }
    if(empty($username)){ 
        $_SESSION['user_e'] ="username field is empty";
    }else{
            $sql_p = "SELECT * FROM admins WHERE pwd='$pwd'";
            $res_p = mysqli_query($conn, $sql_p);

            
            $sql_u = "SELECT * FROM admins WHERE username=$username";
            $res_u = mysqli_query($conn, $sql_u);
            if(mysqli_num_rows($res_p) > 0){
                $_SESSION['pwd_e'] = "password already exist";
            }else if(mysqli_num_rows($res_u) > 0){
                $_SESSION['user_e']="username already exist";
            }else{
                $sql = "INSERT INTO admins (`image`, `pwd`, `username`) VALUES ('$image', '$pwd', '$username')";
                $result = $conn->query($sql);
                $_SESSION['success'] = "Record has been added successfully";
                header("location:admin_details.php");
            }
    }
}



/*
--delete btn
*/
if (isset($_GET['delete_admin'])){
    $admin_id  = $_GET['delete_admin'];
    $result = $conn->query("DELETE FROM admins WHERE admin_id ='$admin_id'")or die($conn->error());
    header("location:admin_details.php");
    $_SESSION['delete'] = "Record has been deleted";
}

/*
--edit btn
*/
$admin_id = 0;
$update = false;
$image = "";
$pwd = "";
$username = "";
if(isset($_GET['edit_admin'])){
    $admin_id = $_GET['edit_admin'];
    $update = true;
    $result = $conn->query("SELECT * FROM admins WHERE admin_id=$admin_id")or die($conn->error());
    $row = mysqli_fetch_assoc($result);              
    $pwd =  $row['pwd'];
    $username = $row['username'];

}

// /*
// --update btn
// */

if(isset($_POST['update_admin'])){
    $admin_id = $_POST['admin_id'];
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
    $pwd =  $_POST['pwd'];
    $username =  $_POST['username']; 

    if($image_file){
      $result = $conn->query("UPDATE admins SET image='$image_file', pwd='$pwd', username='$username' WHERE  admin_id=$admin_id")or die($conn->error());
      $_SESSION['success']="Record has been updated ";
      header("location:admin_details.php");
    }else{
      $result = $conn->query("UPDATE admins SET pwd='$pwd', username='$username' WHERE  admin_id=$admin_id")or die($conn->error());
      $_SESSION['success']="Record has been updated ";
      header("location:admin_details.php");
    }
    
} 
    /*   
    --Count All customer Table
    */
    $query = "SELECT COUNT(admin_id) AS COUNT FROM `admins`";
    $query_result = mysqli_query($conn, $query);

    $result = $conn->query("SELECT * FROM admins")or die($conn->error());
    while($row = mysqli_fetch_assoc($query_result)){
    $admin_output = ""." ".$row['COUNT'];
    }










