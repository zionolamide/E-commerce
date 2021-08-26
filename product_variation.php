<?php 
session_start(); 
 include ("layout/admin_header.php");
 include ("process/product_variation_process.php");
?>
<?php if(!isset($_SESSION['login'])){
    header("location:index.php");
    $_SESSION['error'] = "you need to login to access this page";
}

?>
<link href="styles/forms_table.css" rel="stylesheet" type="text/css">
<div class="row">

  <div class="column">
  <input type="text" id="myInput" onkeyup="myFunctionProVar()" placeholder="Search for product name" title="Type in a name">
  </div>


  <div class="column">
    
  </div>

  <div class="column">
    <div class="content_one" >
        <h2  style = "font-size: 12px;text-align: center;">Total No</h2>
        <h2 class="number"  style="    text-align: center;font-size: 10px;">
        <?php echo  $product_variation_output ;?>
        </h2>
    
    </div>
  </div>
</div>

<div style="overflow-x:auto;">
  <table id="MyTable">
    <tr>
      <th>SN</th>
      <th>Image</th>
      <th>Colour</th>
      <th>Availability</th>
      <th>Quantity</th>
      <th>price</th>
      <th>Product_name</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
    <?php  $result = mysqli_query($conn, "SELECT * FROM product_variation")or die($conn->error());?>
        <?php while($row = $result->fetch_assoc()):?>
          <tr>
              <td>
                <?php echo $row['product_variation_id'];?>
              </td>
              <td>
               <input type="hidden" name="size" value="1000000">
                <?php
                      echo "<div id='img_div'>";
                        echo "<img src='img/".$row['image']."' style='width: 50px; height: 50px; border-radius: 100%;'>";
                      echo "</div>";
                ?> 
              </td>                
              <td><?php echo $row['colour'];?></td>
              <td><?php 
                   //$product_variation_id = 0;
                   //$product_variation_id =$_GET['product_variation_id'];
                   $sql_q = "SELECT * FROM product_variation WHERE quantity='$quantity' AND product_variation_id='$quantity'";
                   $res_q = mysqli_query($conn, $sql_q);
                   if(mysqli_num_rows($res_q) > 0){
                    echo ' <button type="submit" class="avaliable" style="padding: 5px 20px; color: #FFF; font-size: 16px; border: none; outline: none; background-image: linear-gradient(to right, #77A1D3 0%, #79CBCA 51%, #77A1D3 100%); box-shadow: 0px 0px 20px #EEE; border-radius: 10px;">Available</button>';
                     }else{
                        echo ' <button type="submit" class="not_available" style="padding: 5px 20px; color: #FFF; font-size: 16px; border: none; outline: none; background-image: linear-gradient(to right, #eb394e 0%, #c6d9e4 51%, #ff6e7f 100%); box-shadow: 0px 0px 20px #EEE; border-radius: 10px;">Not Available</button>';
                }?></td> 
              <td><?php echo $row['quantity'];?></td>      
              <td><?php echo $row['price'];?></td>
              <td><?php echo $row['product_name'];?></td>                             
              <td>
                <a href="product_variation.php?edit_product_variation=<?php echo $row['product_variation_id'];?>" class="gradient-button-edit">Edit</a>
              </td>
              <td>
                <a href="product_variation.php?delete_product_variation=<?php echo $row['product_variation_id'];?>"  class="gradient-button gradient-button-delete">Delete</a>
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
<div class="my_form" >
    <form action="product_variation.php" method="post" style="margin-top: 113px;" enctype="multipart/form-data">
    <input type="hidden" name="product_variation_id" value="<?php echo $product_variation_id; ?>">	 
        <?php  
		   $result = mysqli_query($conn, "SELECT * FROM product_variation WHERE product_variation_id=$product_variation_id")or die($conn->error());
		   $row = $result->fetch_assoc();
	    ?> 
        <header class="headers">
            <h1>Add New Product Variation</h1>
            <?php if(isset($_GET['edit_product_variation'])):?>
            
             <button type="submit" name="update_product_variation" id="update_product_variation" class="gradient-button-add" style="padding: 5px 20px;">Update</button>
            <?php else:?>
             <button type="submit" name="add_product_variation" id="add" class="gradient-button-add" style="padding: 5px 20px;">Add</button>
            <?php endif;?>
        </header>
        <div class="body">
           
            <!--img row-->
            <div class="image">
                <label for="image" class="label_image">Image</label>
                <input type="file" name="image" accept="image/*" id="file" style="display:none;" class="inputfile" />
                
                <label for="file" class="label" id="img-preview" name="image" >add img
                <span>
                    <?php  if(isset($_GET['edit_product_variation'])):?>
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
            
            <div class="colour">
                <label for="colour" class="label_colour" style="    position: absolute;  margin-left: -100px;  margin-top: 18px; font-size: 15px;  color: #808080;">Colour</label>
                <input type="text" name="colour" id="colour" placeholder="enter colour" class="input" value="<?php echo $colour;?>">
                
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
            <div class="">
                <label for="availability" class="label_availability" style="position: absolute;margin-left: -96px;margin-top: 18px;font-size: 15px;color: #808080;">Availability</label>
                <input type="text" name="availability" id="availability" class="input" placeholder="enter availability" value="<?php echo $availability;?>">
            
            </div>
            <!--error msg-->
            <div class="error_msg">
                <?php  if(isset($_SESSION['a_error'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['a_error'];?>
                </span>
                <?php
                }
                unset($_SESSION['a_error']);
                ?>
            </div> 

            <div class="">
                <label for="quantity" class="label_quantity" style="position: absolute;margin-left: -116px;margin-top: 18px;font-size: 15px;color: #808080;">Quantity</label>
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
            
            <div class="price">
                <label for="price" class="label_price" style="position: absolute;margin-left: -97px;margin-top: 18px;font-size: 15px;color: #808080;">Price</label>
                <input type="text" name="price" list ="price" id="price" class="input" placeholder="enter price" value="<?php echo $price;?>"> 
                
            </div>
            <!--error msg-->
            <div class="error_msg">
                <?php  if(isset($_SESSION['p_e'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['p_e'];?>
                </span>
                <?php
                }
                unset($_SESSION['p_e']);
                ?>
            </div>

            <div class="product_name">
                <label for="product_name" class="label_product_name" style="position: absolute;margin-left: -161px;margin-top: 18px;font-size: 15px;color: #808080;">Product Name</label>
                <input type="text" name="product_name" list ="product_name" id="product_name" class="input" placeholder="enter product_name" value="<?php echo $product_name;?>"> 
                
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
            <?php 
            if(isset($_GET['edit_product_variation'])):
            ?>
            <a href="product_variation.php" class="gradient-button-cancel">Cancel editing</a>
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




<!-- <script type="text/javascript" src="open&closenav.js"></script> -->
