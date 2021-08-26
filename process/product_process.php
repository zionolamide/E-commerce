<?php 
include ("DB/conn.php");

if(isset($_POST['add_product'])){
    $image = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $target = "img/".basename($image);

    if(empty($image)){
        $_SESSION['img_e'] = "you have not select any image";
    }

    if(empty($product_name)){
        $_SESSION['p_error'] = "product field is empty";
    }

    if(empty($description)){
        $_SESSION['d_error'] = "description field is empty";
    }

    if(empty($price)){
        $_SESSION['pr_error'] = "price field is empty";
    }

    if(empty($quantity)){
        $_SESSION['q_error'] = "quantity field is empty";
    }
    
    if(empty($category)){
        $_SESSION['c_error'] = "category field is empty";
    }else{
            $sql = "INSERT INTO product (`image`, `product_name`, `description`, `price`, `quantity`, `category`) VALUES ( '$image', '$product_name', '$description', '$price', '$quantity', '$category')";
            $result = $conn->query($sql);
            $_SESSION['success'] = "Record has been added successfully";
            header("location:product.php");
        }
    
}

 /*   
--Count All product Table
*/
$query = "SELECT COUNT(product_id) AS COUNT FROM `product`";
$query_result = mysqli_query($conn, $query);

$result = $conn->query("SELECT * FROM product")or die($conn->error());
while($row = mysqli_fetch_assoc($query_result)){
$product_output = ""." ".$row['COUNT'];
}

/*
--edit btn
*/
$product_id = 0;
$update = false;
$image = "";
$product_name = "";
$description = "";
$price = "";
$quantity = "";
$category = "";

if(isset($_GET['edit_product'])){
$product_id = $_GET['edit_product'];
$update = true;
$result = $conn->query("SELECT * FROM product WHERE product_id=$product_id")or die($conn->error());
$row = mysqli_fetch_assoc($result);
$product_name = $row['product_name'];               
$description = $row['description'];
$price =  $row['price']; 
$quantity = $row['quantity'];      
$category = $row['category'];         
}


if(isset($_POST['update_product'])){
$product_id = $_POST['product_id'];
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
$product_name = $_POST['product_name'];               
$description = $_POST['description'];
$price=  $_POST['price']; 
$quantity = $_POST['quantity'];       
$category = $_POST['category'];        
if($image_file){
  $result = $conn->query("UPDATE product SET image='$image_file', product_name='$product_name', description='$description', price='$price', quantity='$quantity', category='$category' WHERE  product_id=$product_id")or die($conn->error());
  $_SESSION['success']="Record has been updated ";
  header("location:product.php");
}else{
  $result = $conn->query("UPDATE product SET product_name='$product_name', description='$description', price='$price', quantity='$quantity',  category='$category' WHERE  product_id=$product_id")or die($conn->error());
  $_SESSION['success']="Record has been updated ";
  header("location:product.php");
}

} 

/*
--delete btn
*/
if (isset($_GET['delete_product'])){
$product_id  = $_GET['delete_product'];
$result = $conn->query("DELETE FROM product WHERE product_id ='$product_id'")or die($conn->error());
header("location:product.php");
$_SESSION['del_e'] = "Record has been deleted";
}
?>




