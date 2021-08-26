<?php  
session_start();
 include ("layout/admin_header.php");
 include ("process/product_option_process.php");
?>
<?php if(!isset($_SESSION['login'])){
    header("location:index.php");
    $_SESSION['error'] = "you need to login to access this page";
}

?>
<link href="styles/forms_table.css" rel="stylesheet" type="text/css">
<div class="row">

  <div class="column">
  <input type="text" id="myInput" onkeyup="myFunctionProOp()" placeholder="Search for product name" title="Type in a name">
  </div>


  <div class="column">
    <div class="content_one" >
        <h2 style = "font-size: 12px; text-align:center;">No Of Payment</h2>
        <h2 class="number"  style="    text-align: center;font-size: 10px;"><?php echo  $product_option_output ;?></h2>
    
    </div>
  </div>

  <div class="column">
    <div class="content_one" >
        <h2  style = "font-size: 12px;text-align: center;">Total Payment</h2>
        <h2 class="number"  style="    text-align: center;font-size: 10px;">
        <?php 
            if ($result_output == 0){
                echo '&#8358;' . number_format(0, 2);
            }else{
               // $amount_output = $amount_output * $quantity_output ;
                echo '&#8358;' . number_format ($result_output, 2);
            }
            

        ?>
        </h2>
    
    </div>
  </div>
</div>


<div style="overflow-x:auto;">
  <table id="MyTable">
    <tr>
      <th>SN</th>
      <th>Product Name</th>
      <th>Colour</th>
      <th>Size</th>
      <th>Sku</th>
      <th>price</th>
      <th>Quantity</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
    <?php  $result = mysqli_query($conn, "SELECT * FROM product_option")or die($conn->error());?>
        <?php while($row = $result->fetch_assoc()):?>
          <tr>
              <td>
                <?php echo $row['product_option_id'];?>
              </td>
              <td><?php echo $row['product_name'];?></td>               
              <td><?php echo $row['colour'];?></td>
              <td><?php echo $row['size'];?></td> 
              <td><?php echo $row['sku'];?></td>      
              <td><?php echo '&#8358;' . number_format ($row['price'], 2);?>
 
            </td>
              <td><?php echo $row['quantity'];?></td>                             
              <td>
                <a href="product_option.php?edit_product_option=<?php echo $row['product_option_id'];?>" class="gradient-button-edit">Edit</a>
              </td>
              <td>
                <a href="product_option.php?delete_product_option=<?php echo $row['product_option_id'];?>"  class="gradient-button gradient-button-delete">Delete</a>
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
    <form action="product_option.php" method="post" style="margin-top: 113px;" enctype="multipart/form-data">
    <input type="hidden" name="product_option_id" value="<?php echo $product_option_id; ?>">	 
        <?php  
		   $result = mysqli_query($conn, "SELECT * FROM product_option WHERE product_option_id=$product_option_id")or die($conn->error());
		   $row = $result->fetch_assoc();
	    ?> 
        <header class="headers">
            <h1>Add New Product Option</h1>
            <?php if(isset($_GET['edit_product_option'])):?>
            
             <button type="submit" name="update_product_option" id="update_product" class="gradient-button-add" style="padding: 5px 20px;">Update</button>
            <?php else:?>
             <button type="submit" name="add_product_option" id="add" class="gradient-button-add" style="padding: 5px 20px;">Add</button>
            <?php endif;?>
        </header>
        <div class="body">
           
            <div class="product_name">
                <label for="product_name" class="label_product_name" style="    position: absolute;  margin-left: -154px;  margin-top: 18px; font-size: 15px;  color: #808080;">Product name</label>
                <input type="text" name="product_name" id="values" placeholder="enter product name" class="input" value="<?php echo $product_name;?>">
                <select   id="name" class="select" onChange="update()">
                   <option value=""></option>
                   <?php 
                     $result = mysqli_query($conn, "SELECT * FROM product")or die($conn->error());
                      while($row = $result->fetch_assoc()):
                   ?>
                   
                   <option value="<?php echo $row['product_name']?>" name="product" id="product" ><?php echo $row['product_name']?></option> 
                   <?php endwhile; ?>
                   

                </select>

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
            
            <div class="colour">
                <label for="colour" class="label_colour" style="    position: absolute;  margin-left: -110px;  margin-top: 18px; font-size: 15px;  color: #808080;">Colour</label>
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
            <div class="size">
                <label for="size" class="label_size" style="position: absolute;margin-left: -98px;margin-top: 18px;font-size: 15px;color: #808080;"> Size</label>
                <input type="text" name="size" id="size" class="input" placeholder="enter size" value="<?php echo $size;?>">
            
            </div>
            <!--error msg-->
            <div class="error_msg">
                <?php  if(isset($_SESSION['s_error'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['s_error'];?>
                </span>
                <?php
                }
                unset($_SESSION['s_error']);
                ?>
            </div> 

            <div class="sku">
                <label for="sku" class="label_sku" style="position: absolute;margin-left: -100px;margin-top: 18px;font-size: 15px;color: #808080;">Sku</label>
                <input type="text" name="sku" id="sku" class="input" placeholder="enter sku" value="<?php echo $sku;?>">
            </div>
            <!--error msg-->
            <div class="error_msg">
                <?php  if(isset($_SESSION['sku_error'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['sku_error'];?>
                </span>
                <?php
                }
                unset($_SESSION['sku_error']);
                ?>
            </div>
            
            <div class="price">
                <label for="price" class="label_price" style="position: absolute;margin-left: -111px;margin-top: 18px;font-size: 15px;color: #808080;">Price</label>
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

            <div class="quantity">
                <label for="quantity" class="label_quantity" style="position: absolute;margin-left: -136px;margin-top: 18px;font-size: 15px;color: #808080;">Quantity</label>
                <input type="text" name="quantity" list ="quantity" id="quantity" class="input" placeholder="enter quantity" value="<?php echo $quantity;?>"> 
                
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
            <?php 
              if(isset($_GET['edit_product_option'])):
            ?>
            <a href="product_option.php" class="gradient-button-cancel">Cancel editing</a>
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


<script type="text/javascript" src="js/filter_table.js"></script>
<script type="text/javascript" src="js/display.js"></script>
