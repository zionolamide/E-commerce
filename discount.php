<?php 
session_start(); 
 include ("layout/admin_header.php");
 include ("process/discount_process.php");
?>
<?php if(!isset($_SESSION['login'])){
    header("location:index.php");
    $_SESSION['error'] = "you need to login to access this page";
}

?>
<link href="styles/forms_table.css" rel="stylesheet" type="text/css">
<div class="row">

  <div class="column">
  <input type="text" id="myInput" onkeyup="myFunctionDiscount()" placeholder="Search for customer" title="Type in a name">
  </div>


  <div class="column">
    
  </div>

  <div class="column">
    <div class="content_one" >
        <h2  style = "font-size: 12px;text-align: center;">Total Discount</h2>
        <h2 class="number"  style="    text-align: center;font-size: 10px;"><?php echo  $discount_output ;?></h2>
    
    </div>
  </div>
</div>


<div style="overflow-x:auto;">
  <table id="MyTable">
    <tr>
      <th>SN</th>
      <th>Product Name</th>
      <th>Discount Value</th>
      <th>Coupon Code</th>
      <th>Max Discount Value</th>
      <th>Min Order Value</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
    <?php  $result = mysqli_query($conn, "SELECT * FROM discount")or die($conn->error());?>
        <?php while($row = $result->fetch_assoc()):?>
          <tr>
              <td>
                <?php echo $row['discount_id'];?>
              </td>
              <td>
                <?php echo $row['product_name'];?>
              </td>
              <td>
                <?php echo $row['discount_value'] . '%';?>
              </td>              
              <td><?php echo $row['coupon_code'];?></td>  
              <td><?php echo $row['max_discount_value'] . '%';?></td>   
              <td><?php echo $row['min_order_value'];?></td>                
              <td>
                <a href="discount.php?edit_discount=<?php echo $row['discount_id'];?>" class="gradient-button-edit">Edit</a>
              </td>
              <td>
                <a href="discount.php?delete_discount=<?php echo $row['discount_id'];?>"  class="gradient-button gradient-button-delete">Delete</a>
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
<div class="my_form">
    <form action="discount.php" method="post" style="margin-top: 113px;" enctype="multipart/form-data">
    <input type="hidden" name="discount_id" value="<?php echo $discount_id; ?>">	 
        <?php  
		   $res = mysqli_query($conn, "SELECT * FROM discount WHERE discount_id=$discount_id")or die($conn->error());
           $row = $res->fetch_assoc();
	    ?>  
        <header class="headers">
            <h1>Add New Discount</h1>
            <?php if(isset($_GET['edit_discount'])):?>
            
             <button type="submit" name="update_discount" id="update_discount" class="gradient-button-add" style="padding: 5px 20px;">Update</button>
            <?php else:?>
             <button type="submit" name="add_discount" id="add" class="gradient-button-add" style="padding: 5px 20px;">Add</button>
            <?php endif;?>
        </header>
        <div class="body">        
            <div class="product_name">
                <label for="product_name" class="product_name" style="position: absolute;margin-left: -137px;margin-top: 18px;font-size: 15px;color: #808080;">Product Name</label>
                <input type="text" name="product_name" id="value" placeholder="enter product" class="input" value="<?php echo $product_name;?>">
                <select  id="names" class="select" onChange="update()">
                    <option value=""></option>
                    <?php 
                      $result = mysqli_query($conn, "SELECT * FROM product")or die($conn->error());
                      while($row = $result->fetch_assoc()):
                    ?>
                   <option value="<?php echo $row['product_name']?>"name="product"><?php echo $row['product_name']?></option>
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

            <div class="discount_value">
                <label for="discount_value" class="discount_value" style="position: absolute;margin-left: -140px;margin-top: 18px;font-size: 15px;color: #808080;">Discount Value</label>
                <input type="text" name="discount_value" id="discount_value" placeholder="enter amount paid" class="input" value="<?php echo $discount_value;?>">
                
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
         

            
            <div class="coupon_code">
                <label for="coupon_code" class="coupon_code" style="    position: absolute;  margin-left: -137px;  margin-top: 18px; font-size: 15px;  color: #808080;">Coupon Code</label>
                <input type="text" name="coupon_code" id="coupon_code" placeholder="enter coupon_code" class="input" value="<?php echo $coupon_code;?>">
                
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
            <div class="max_discount_value">
                <label for="max_discount_value" class="label_max_discount_value" style="position: absolute;margin-left: -175px;margin-top: 18px;font-size: 15px;color: #808080;">Max Discount Value</label>
                <input type="text" name="max_discount_value" id="max_discount_value" class="input" placeholder="enter max discount value" value="<?php echo $max_discount_value;?>">
            
            </div>
            <!--error msg-->
            <div class="error_msg">
                <?php  if(isset($_SESSION['m_error'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['m_error'];?>
                </span>
                <?php
                }
                unset($_SESSION['m_error']);
                ?>
            </div> 

            <div class="min_order_value">
                <label for="min_order_value" class="label_min_order_value" style="position: absolute;margin-left: -150px;margin-top: 18px;font-size: 15px;color: #808080;">Min Order Value</label>
                <input type="text" name="min_order_value" id="min_order_value" class="input" placeholder="enter min order value" value="<?php echo $min_order_value;?>">
            
            </div>
            <!--error msg-->
            <div class="error_msg">
                <?php  if(isset($_SESSION['min_error'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['min_error'];?>
                </span>
                <?php
                }
                unset($_SESSION['min_error']);
                ?>
            </div> 

            <?php 
              if(isset($_GET['edit_discount'])):
            ?>
            <a href="discount.php" class="gradient-button-cancel">Cancel editing</a>
            <?php else: ?>
            <?php endif; ?>
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
<script type="text/javascript" src="js/display.js">
//     function update() {
//     var select = document.getElementById('good');
//     var option = select.options[select.selectedIndex];

//     document.getElementById("product_name").value = option.value;
   
// }
// update();
</script>