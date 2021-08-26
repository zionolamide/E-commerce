<?php 
session_start(); 
 include ("layout/admin_header.php");
 include ("process/product_process.php");
?>
<?php if(!isset($_SESSION['login'])){
    header("location:index.php");
    $_SESSION['error'] = "you need to login to access this page";
}

?>

<link href="styles/forms_table.css" rel="stylesheet" type="text/css">
<div class="row">

  <div class="column">
  <input type="text" id="myInput" onkeyup="myFunctionProduct()" placeholder="Search for product name" title="Type in a name">
  </div>


  <div class="column">
    
  </div>

  <div class="column">
    <div class="content_one" >
        <h2  style = "font-size: 12px;text-align: center;">Total </h2>
        <h2 class="number"  style="    text-align: center;font-size: 10px;">
        <?php echo  $product_output ;?>
        </h2>
    
    </div>
  </div>
</div>

<div style="overflow-x:auto;">
  <table id="MyTable">
    <tr>
      <th>SN</th>
      <th>Image</th>
      <th>Name</th>
      <th>Description</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Category</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
    <?php  $result = mysqli_query($conn, "SELECT * FROM product")or die($conn->error());?>
        <?php while($row = $result->fetch_assoc()):?>
          <tr>
              <td>
                <?php echo $row['product_id'];?>
              </td>
              <td>
               <input type="hidden" name="size" value="1000000">
                <?php
                      echo "<div id='img_div'>";
                        echo "<img src='img/".$row['image']."' style='width: 50px; height: 50px; border-radius: 100%;'>";
                      echo "</div>";
                ?> 
              </td> 
              <td><?php echo $row['product_name'];?></td>               
              <td><?php echo $row['description'];?></td>
              <td><?php echo $row['price'];?></td> 
              <td><?php echo $row['quantity'];?></td>      
              <td><?php echo $row['category'];?></td>                            
              <td>
                <a href="product.php?edit_product=<?php echo $row['product_id'];?>" class="gradient-button-edit">Edit</a>
              </td>
              <td>
                <a href="product.php?delete_product=<?php echo $row['product_id'];?>"  class="gradient-button gradient-button-delete">Delete</a>
              </td>						   
          </tr>
       
        <?php endwhile;?>
        <?php 
          function pre_r($array){
          echo '<pre>';
          print_r($array);
          echo '</pre>';
            }
        
        ?>
     

    
  </table>
</div>
<div class="error_msg">
    <?php  if(isset($_SESSION['del_e'])) 
    { 
    ?> 
    <span class="del_msg">
        <?php  echo $_SESSION['del_e'];?>
    </span>
    <?php
    }
    unset($_SESSION['del_e']);
    ?>
</div>
<div class="success_msg">
    <?php  if(isset($_SESSION['success'])) 
    { 
    ?> 
    <span class="success">
        <?php  echo $_SESSION['success'];?>
    </span>
    <?php
    }
    unset($_SESSION['success']);
    ?>
</div>
<div class="my_form">
    <form action="product.php" method="post" style="margin-top: 113px;" enctype="multipart/form-data">
    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">	 
        <?php  
		   $result = mysqli_query($conn, "SELECT * FROM product WHERE product_id=$product_id")or die($conn->error());
		   $row = $result->fetch_assoc();
	    ?> 
        <header class="headers">
            <h1>Add New Product</h1>
            <?php if(isset($_GET['edit_product'])):?>
            
             <button type="submit" name="update_product" id="update_product" class="gradient-button-add" style="padding: 5px 20px;">Update</button>
            <?php else:?>
             <button type="submit" name="add_product" id="add" class="gradient-button-add" style="padding: 5px 20px;">Add</button>
            <?php endif;?>
        </header>
        <div class="body">
            <!--img row-->
            <div class="image">
                <label for="image" class="label_image">Image</label>
                <input type="file" name="image" accept="image/*" id="file" style="display:none;" class="inputfile" />
                
                <label for="file" class="label" id="img-preview" name="image" >add img
                <span>
                    <?php  if(isset($_GET['edit_product'])):?>
                    <?php
                        echo "<div id='img_div'>";
                            echo "<img src='img/".$row['image']."' class='myimg' style='width: 80px; height: 70px; margin-top: -41px; border-radius: 83px;'>";
                        echo "</div>";
                    ?> 
                    <?php endif;?>
                </span>
                </label>
            </div>
            <!--error msg-->
            <div class="error_msg">
                <?php  if(isset($_SESSION['img_e'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['img_e'];?>
                </span>
                <?php
                }
                unset($_SESSION['img_e']);
                ?>
            </div> 
            <div class="product_name">
                <label for="product_name" class="label_product_name" style="    position: absolute;  margin-left: -154px;  margin-top: 18px; font-size: 15px;  color: #808080;">Product name</label>
                <input type="text" name="product_name" id="product_name" placeholder="enter product name" class="input" value="<?php echo $product_name;?>">
            </div>
                <!--error msg-->
                <div class="error_msg">
                <?php  if(isset($_SESSION['p_error'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['p_error'];?>
                </span>
                <?php
                }
                unset($_SESSION['p_error']);
                ?>
            </div> 
            
            <div class="description">
                <label for="description" class="label_description" style="    position: absolute;  margin-left: -154px;  margin-top: 18px; font-size: 15px;  color: #808080;"> Description</label>
                <input type="text" name="description" id="description" placeholder="enter description" class="input" value="<?php echo $description;?>">
                
            </div>
            <!--error msg-->
            <div class="error_msg">
                <?php  if(isset($_SESSION['d_error'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['d_error'];?>
                </span>
                <?php
                }
                unset($_SESSION['d_error']);
                ?>
            </div> 
            <div class="price">
                <label for="price" class="label_price" style="position: absolute;margin-left: -113px;margin-top: 18px;font-size: 15px;color: #808080;"> Price</label>
                <input type="text" name="price" id="price" class="input" placeholder="enter price" value="<?php echo $price;?>">
            
            </div>
            <!--error msg-->
            <div class="error_msg">
                <?php  if(isset($_SESSION['pr_error'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['pr_error'];?>
                </span>
                <?php
                }
                unset($_SESSION['pr_error']);
                ?>
            </div> 

            <div class="quantity">
                <label for="quantity" class="label_quantity" style="position: absolute;margin-left: -135px;margin-top: 18px;font-size: 15px;color: #808080;">Quantity</label>
                <input type="text" name="quantity" id="quantity" class="input" placeholder="enter quantity" value="<?php echo $quantity;?>">
            </div>
            <!--error msg-->
            <div class="error_msg">
                <?php  if(isset($_SESSION['q_error'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['q_error'];?>
                </span>
                <?php
                }
                unset($_SESSION['q_error']);
                ?>
            </div>
            
            <div class="category">
                <label for="category" class="label_category" style="position: absolute;margin-left: -135px;margin-top: 18px;font-size: 15px;color: #808080;">Category</label>
                <input type="text" name="category" list ="category" id="category" class="input" placeholder="enter category" value="<?php echo $category;?>"> 
                <!-- <select id="category">
                    <option value="australia">Australia</option>
                    <option value="canada">Canada</option>
                    <option value="usa">USA</option>
                </select> -->
            </div>
            <!--error msg-->
            <div class="error_msg">
                <?php  if(isset($_SESSION['c_error'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['c_error'];?>
                </span>
                <?php
                }
                unset($_SESSION['c_error']);
                ?>
            </div>
            <?php if(isset($_GET['edit_product'])):?>
                <a href="product.php" class="gradient-button-cancel">Cancel editing</a>
                <?php else:?>
                    <?php endif;?>
            <div class="footer" style="margin-top: -178px; position: absolute;">
                <div class="line1"></div>
                <div class="lines"></div>
                <img src="Img/a.png" alt="" class="footer_img">
                <div class="line2"></div>
                <div class="liness"></div>
            </div>
        </div>
    </form>
</div>




<script type="text/javascript" src="js/display.js"></script>
<script type="text/javascript" src="js/filter_table.js"></script>
