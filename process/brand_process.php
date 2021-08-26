<?php
include ("DB/conn.php");

/*
--brand btn
*/

if(isset($_POST['add_brand'])){
    $image = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $brand_name = mysqli_real_escape_string($conn, $_POST['brand_name']);

    $target = "img/".basename($image);

    if(empty($image)){
        $_SESSION['img_e'] = "You have not selected any image";
    }
    if(empty($brand_name)){
        $_SESSION['b_e'] = "brand name field is empty";

    }else{
        $sql_b = "SELECT * FROM brand WHERE brand_name='$brand_name'";
        $res_b = mysqli_query($conn, $sql_b);
        if(mysqli_num_rows($res_b) > 0){
            $_SESSION['b_e'] = "brand name already exist"; 
        }else{
            $sql = "INSERT INTO brand (`image`, `brand_name`) VALUES ( '$image', '$brand_name')";
            $result = $conn->query($sql);
            $_SESSION['success'] = "Record has been added successfully";
            header("location:brand.php");
        }
    }
}

/*
--update btn
*/

if(isset($_POST['update_brand'])){
    $brand_id = $_POST['brand_id'];
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

    $brand_name = $_POST['brand_name'];

    if($image_file){
        $result = $conn->query("UPDATE brand SET image='$image_file', brand_name='$brand_name' WHERE  brand_id=$brand_id")or die($conn->error());
        $_SESSION['success']="Record has been updated ";
        header("location: brand.php");
    }else{
        $result = $conn->query("UPDATE brand SET brand_name='$brand_name' WHERE  brand_id=$brand_id")or die($conn->error());
        $_SESSION['success']="Record has been updated ";
        header("location: brand.php");
    }

    
}


/*
--delete
*/

if (isset($_GET['delete_brand'])){
    $brand_id = $_GET['delete_brand'];
    $result = $conn->query("DELETE FROM brand WHERE brand_id=$brand_id")or die($conn->error());
    $_SESSION['delete'] = "record has been deleted";
    header("location: brand.php");
}


/*
--edit btn
*/

$brand_id = 0;
$update = false;
$image = "";
$brand_name = "";
if(isset($_GET['edit_brand'])){
    $brand_id = $_GET['edit_brand'];
    $update = true;
    $result = $conn->query("SELECT * FROM brand WHERE brand_id=$brand_id")or die($conn->error());
    $row = mysqli_fetch_assoc($result);
    $brand_name = $row['brand_name'];                

}



/*   
--Count All brand Table
*/
$query = "SELECT COUNT(brand_id) AS COUNT FROM `brand`";
$query_result = mysqli_query($conn, $query);

$result = $conn->query("SELECT * FROM brand")or die($conn->error());
while($row = mysqli_fetch_assoc($query_result)){
$brand_output = ""." ".$row['COUNT'];
}


?>