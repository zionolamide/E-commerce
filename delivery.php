<?php  
session_start();
 include ("layout/admin_header.php");
 include ("process/delivery_process.php");
?>
<?php if(!isset($_SESSION['login'])){
    header("location:index.php");
    $_SESSION['error'] = "you need to login to access this page";
}

?>
<link href="styles/forms_table.css" rel="stylesheet" type="text/css">
<div class="row">

  <div class="column">
  <input type="text" id="myInput" onkeyup="myFunctionDelivery()" placeholder="Search for customer" title="Type in a name">
  </div>


  <div class="column">
    
  </div>

  <div class="column">
    <div class="content_one" >
        <h2  style = "font-size: 12px;text-align: center;">Total Delivery</h2>
        <h2 class="number"  style="    text-align: center;font-size: 10px;"><?php echo  $delivery_output ;?></h2>
    
    </div>
  </div>
</div>


<div style="overflow-x:auto;">
  <table id="MyTable">
    <tr>
      <th>ID</th>
      <th>Customer Name</th>
      <th>Product Name</th>
      <th>Comment</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
    <?php  $result = mysqli_query($conn, "SELECT * FROM delivery")or die($conn->error());?>
        <?php while($row = $result->fetch_assoc()):?>
          <tr>
              <td>
                <?php echo $row['delivery_id'];?>
              </td>
              <td>
                <?php echo $row['customer'];?>
              </td>
              <td>
                <?php echo $row['product'];?>
              </td>
              <td><?php echo $row['comment'];?></td>                
              <td>
                <a href="delivery.php?edit_delivery=<?php echo $row['delivery_id'];?>" class="gradient-button-edit">Edit</a>
              </td>
              <td>
                <a href="delivery.php?delete_delivery=<?php echo $row['delivery_id'];?>"  class="gradient-button gradient-button-delete">Delete</a>
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
    <form action="delivery.php" method="post" style="margin-top: 113px;" enctype="multipart/form-data">
    <input type="hidden" name="delivery_id" value="<?php echo $delivery_id; ?>">	 
        <?php  
		   $res = mysqli_query($conn, "SELECT * FROM delivery WHERE delivery_id=$delivery_id")or die($conn->error());
           $row = $res->fetch_assoc();
	    ?>  
        <header class="headers">
            <h1>Add New Delivery</h1>
            <?php if(isset($_GET['edit_delivery'])):?>
            
             <button type="submit" name="update_delivery" id="update_delivery" class="gradient-button-add" style="padding: 5px 20px;">Update</button>
            <?php else:?>
             <button type="submit" name="add_delivery" id="add" class="gradient-button-add" style="padding: 5px 20px;">Add</button>
            <?php endif;?>
        </header>
        <div class="body">  
            
            <div class="customer">
                <label for="customer" class="customer" style="position: absolute;margin-left: -140px;margin-top: 18px;font-size: 15px;color: #808080;">Customer Name</label>
                <input type="text" name="customer" id="customer" placeholder="enter customer" class="input" value="<?php echo $customer;?>">
                <select id="user" class="select" onChange="display()">
                   <option value=""></option>
                   <?php 
                      $result = mysqli_query($conn, "SELECT * FROM customer")or die($conn->error());
                      while($row = $result->fetch_assoc()):
                   ?>
                   <option value="<?php echo $row['fullname']?>" name="customer"><?php echo $row['fullname']?></option>
                   <?php endwhile; ?>
                </select>
            </div>
            <!--error msg-->
            <div class="error_msg">
                <?php  if(isset($_SESSION['cu_e'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['cu_e'];?>
                </span>
                <?php
                }
                unset($_SESSION['cu_e']);
                ?>
            </div> 
            

            <div class="product">
                <label for="product" class="product" style="position: absolute;margin-left: -140px;margin-top: 18px;font-size: 15px;color: #808080;">Product Name</label>
                <input type="product" name="product" id="product" placeholder="enter product" class="input" value="<?php echo $product;?>">
                <select  id="goods" class="select" onChange="myUpdate()">
                  <option value=""></option>
                   <?php 
                      $result = mysqli_query($conn, "SELECT * FROM product")or die($conn->error());
                      while($row = $result->fetch_assoc()):
                   ?>
                   <option value="<?php echo $row['product_name']?>" name="product"><?php echo $row['product_name']?></option>
                   <?php endwhile; ?>
                </select>
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
            

            <div class="comment">
                <label for="comment" class="comment" style="    position: absolute;  margin-left: -114px;  margin-top: 18px; font-size: 15px;  color: #808080;">comment</label>
                <input type="text" name="comment" id="comment" placeholder="enter comment" class="input" value="<?php echo $comment;?>">
                
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
            
            <?php
             if(isset($_GET['edit_delivery'])):
            ?>
            <a href="delivery.php" class="gradient-button-cancel">Cancel editing</a>
            <?php else:?>
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
<script type="text/javascript" src="js/display_deli.js"> </script>
<!-- <script type="text/javascript" src="js/display_pro.js"> </script> -->