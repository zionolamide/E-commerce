<?php
session_start();
include ("DB/conn.php");

/*
---------------------
Customer process code
---------------------
*/



/*
------------------------
Admin login process code
------------------------
*/

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
        $res_p = $conn->query($sql_p);
        if($res_p->num_rows > 0){
            $admin = $res_p->fetch_assoc();
            $_SESSION['login'] =$login;
            header("location:customers.php");
        }else{
            $sql = "SELECT * FROM admins WHERE pwd='$pwd'";
            $res = mysqli_query($conn, $sql);
            if(mysqli_num_rows($res) == 0){
                $_SESSION['pwd_error']="password is not correct";
            }else{
                header("location:customers.php");
            }
        }
    }
        
}





/*
-------------------------
Product page process code
-------------------------
*/


/*
------------------------
Orders page process  code
------------------------
*/
