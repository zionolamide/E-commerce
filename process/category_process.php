<?php
include ("DB/conn.php");
/*
--delete btn
*/
if (isset($_GET['delete_category'])){
    $category_id  = $_GET['delete_category'];
    $result = $conn->query("DELETE FROM category WHERE category_id ='$category_id'")or die($conn->error());
    header("location:category.php");
    $_SESSION['delete'] = "Record has been deleted";
}

/*
--edit btn
*/
$category_id = 0;
$update = false;
$image = "";
$categories = "";
$description = "";

if(isset($_GET['edit_category'])){
    $category_id = $_GET['edit_category'];
    $update = true;
    $result = $conn->query("SELECT * FROM category WHERE category_id=$category_id")or die($conn->error());
    $row = mysqli_fetch_assoc($result);
    $categories = $row['categories'];               
    $description = $row['description']; 

}

/*
--update btn
*/
if(isset($_POST['update_category'])){
    $category_id = $_POST['category_id'];
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
    $categories = $_POST['categories'];               
    $description = $_POST['description'];
    if($image_file){
      $result = $conn->query("UPDATE category SET image='$image_file', categories='$categories', description='$description' WHERE  category_id=$category_id")or die($conn->error());
      $_SESSION['success']="Record has been updated ";
      header("location:category.php");
    }else{
      $result = $conn->query("UPDATE category SET categories='$categories', description='$description' WHERE  category_id=$category_id")or die($conn->error());
      $_SESSION['success']="Record has been updated ";
      header("location:category.php");
    }
    
} 

/*
--add customer
*/

if(isset($_POST['category_login'])){
    $image = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $categories = mysqli_real_escape_string($conn, $_POST['categories']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $target = "img/".basename($image);

    if(empty($image)){
        $_SESSION['img_e'] = "you have not select any image";
    }
    if(empty($categories)){
        $_SESSION['c_error'] = "category field is empty";
    }

    if(empty($description)){
        $_SESSION['d_error'] = "description field is empty";
    }else{
        $sql_c = "SELECT * FROM category WHERE categories='$categories'";
        $res_c = mysqli_query($conn, $sql_c);
        if (mysqli_num_rows($res_c) > 0){
            $_SESSION['c_error'] = "category already taken";
        }else{
            $sql = "INSERT INTO category (`image`, `categories`, `description`) VALUES ( '$image', '$categories', '$description')";
            $result = $conn->query($sql);
            $_SESSION['success'] = "Record has been added successfully";
            header("location:category.php");
        }
    }
}

    /*   
    --Count All category Table
    */
    $query = "SELECT COUNT(category_id) AS COUNT FROM `category`";
    $query_result = mysqli_query($conn, $query);

    $result = $conn->query("SELECT * FROM category")or die($conn->error());
    while($row = mysqli_fetch_assoc($query_result)){
    $category_output = ""." ".$row['COUNT'];
    }





?>