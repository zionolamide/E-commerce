<?php 
session_start(); 
 include ("layout/admin_header.php");
 include ("process/payment_process.php");
?>
<?php if(!isset($_SESSION['login'])){
    header("location:index.php");
    $_SESSION['error'] = "you need to login to access this page";
}

?>
<link href="styles/forms_table.css" rel="stylesheet" type="text/css">
<div class="row">

  <div class="column">
  <input type="text" id="myInput" onkeyup="myFunctionPayment()" placeholder="Search for customer" title="Type in a name">
  </div>


  <div class="column">
    <div class="content_one" >
        <h2 style = "font-size: 12px; text-align:center;">No Of Payment</h2>
        <h2 class="number"  style="    text-align: center;font-size: 10px;">
        <?php 
            echo $payment_count;
        ?></h2>
    
    </div>
  </div>

  <div class="column">
    <div class="content_one" >
        <h2  style = "font-size: 12px;text-align: center;">Total Payment</h2>
        <h2 class="number"  style="    text-align: center;font-size: 10px;">
        <?php 
            if ($payment_add_output == 0){
                echo '&#8358;' . number_format(0, 2);
            }else{
               // $amount_output = $amount_output * $quantity_output ;
                echo '&#8358;' . number_format ($payment_add_output, 2);
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
      <th>Image</th>
      <th>Product Name</th>
      <th>Quantity</th>
      <th>Customer Name</th>
      <th>Amount Paid</th>
      <th>Card Number</th>
      <th>Ccv</th>
      <th>Date Paid</th>
      <th>Edit</th>
      <th>Delete</th>
      <th>Refund</th>
    </tr>
    <?php  $result = mysqli_query($conn, "SELECT * FROM payment")or die($conn->error());?>
        <?php while($row = $result->fetch_assoc()):?>
          <tr>
              <td>
                <?php echo $row['payment_id'];?>
              </td>
              <td>
               <input type="hidden" name="size" value="1000000">
                <?php
                      echo "<div id='img_div'>";
                        echo "<img src='img/".$row['image']."' style='width: 50px; height: 50px; border-radius: 100%;'>";
                      echo "</div>";
                ?> 
              </td> 
              <td>
                <?php echo $row['product'];?>
              </td>
              <td>
                <?php echo $row['quantity'];?>
              </td>
              <td>
                <?php echo $row['customer'];?>
              </td>
              <td>
                 <?php echo '&#8358;' . number_format($row['amount_paid'], 2); ?></h2>
              </td>               
              <td><?php echo $row['card_number'];?></td>  
              <td><?php echo $row['ccv'];?></td>   
              <td><?php echo $row['date_paid'];?></td>                
              <td>
                <a href="payment.php?edit_payment=<?php echo $row['payment_id'];?>" class="gradient-button-edit">Edit</a>
              </td>
              <td>
                <a href="payment.php?delete_payment=<?php echo $row['payment_id'];?>"  class="gradient-button gradient-button-delete">Delete</a>
              </td>
              <td>
                <a href="payment.php?refund_payment=<?php echo $row['payment_id'];?>"  class="gradient-button gradient-button-delete">Refund</a>
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

<div class="my_form" >
    <form action="payment.php" method="post" style="margin-top: 113px;" enctype="multipart/form-data">
    <input type="hidden" name="payment_id" value="<?php echo $payment_id; ?>">	 
        <?php  
		   $res = mysqli_query($conn, "SELECT * FROM payment WHERE payment_id=$payment_id")or die($conn->error());
           $row = $res->fetch_assoc();
	    ?>  
        <header class="headers">
            <h1>Add New Payment</h1>
            <?php if(isset($_GET['edit_payment'])):?>
            
             <button type="submit" name="update_payment" id="update_payment" class="gradient-button-add" style="padding: 5px 20px;">Update</button>
            <?php else:?>
             <button type="submit" name="add_payment" id="add" class="gradient-button-add" style="padding: 5px 20px;">Add</button>
            <?php endif;?>
        </header>
        <div class="body">   
            <!--img row-->
            <div class="image">
                <label for="image" class="label_image">Image</label>
                <input type="file" name="image" accept="image/*" id="file" style="display:none;" class="inputfile" />
                
                <label for="file" class="label" id="img-preview" name="image" >
                 <p style=" text-align: center; margin-top: 29px;">add img</p>   
                <span>
                    <?php  if(isset($_GET['edit_payment'])):?>
                    <?php
                        echo "<div id='img_div' style='margin-top:-51px;'>";
                            echo "<img src='img/".$row['image']."' class='myimg' '>";
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
            <div class="product">
                <label for="product" class="product" style="position: absolute;margin-left: -140px;margin-top: 18px;font-size: 15px;color: #808080;">Product Bought</label>
                <input type="text" name="product" id="values" placeholder="enter product" class="input" value="<?php echo $product;?>">
                
                <select  id="name" class="select" onChange="myFunction(one)">
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
                <?php  if(isset($_SESSION['error_p'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['error_p'];?>
                </span>
                <?php
                }
                unset($_SESSION['error_p']);
                ?>
            </div> 

            <div class="quantity">
                <label for="quantity" class="quantity" style="position: absolute;margin-left: -92px;margin-top: 18px;font-size: 15px;color: #808080;">Quantity</label>
                <input type="quantity" name="quantity" id="quantity" placeholder="enter quantity" class="input" value="<?php echo $quantity;?>">
                
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

            <div class="customer">
                <label for="customer" class="customer" style="position: absolute;margin-left: -140px;margin-top: 18px;font-size: 15px;color: #808080;">Customer Name</label>
                <input type="text" name="customer" id="value" placeholder="enter customer" class="input" value="<?php echo $customer;?>">
                <select  id="names" class="select" onChange="update()">
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
                <?php  if(isset($_SESSION['cus_e'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['cus_e'];?>
                </span>
                <?php
                }
                unset($_SESSION['cus_e']);
                ?>
            </div> 
         

            
            <div class="amount_paid">
                <label for="amount_paid" class="amount_paid" style="    position: absolute;  margin-left: -114px;  margin-top: 18px; font-size: 15px;  color: #808080;">Amount paid</label>
                <input type="text" name="amount_paid" id="amount_paid" placeholder="enter amount paid" class="input" value="<?php echo $amount_paid;?>">
                
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
            <div class="card_number">
                <label for="card_number" class="label_card_number" style="position: absolute;margin-left: -122px;margin-top: 18px;font-size: 15px;color: #808080;">Card Number</label>
                <input type="text" name="card_number" id="card_number" class="input" placeholder="enter card number" value="<?php echo $card_number;?>">
            
            </div>
            <!--error msg-->
            <div class="error_msg">
                <?php  if(isset($_SESSION['error_c'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['error_c'];?>
                </span>
                <?php
                }
                unset($_SESSION['error_c']);
                ?>
            </div> 

            <div class="ccv">
                <label for="ccv" class="label_ccv" style="position: absolute;margin-left: -62px;margin-top: 18px;font-size: 15px;color: #808080;">Ccv</label>
                <input type="text" name="ccv" id="ccv" class="input" placeholder="enter ccv" value="<?php echo $ccv;?>">
            
            </div>
            <!--error msg-->
            <div class="error_msg">
                <?php  if(isset($_SESSION['ccv_error'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['ccv_error'];?>
                </span>
                <?php
                }
                unset($_SESSION['ccv_error']);
                ?>
            </div> 

            <?php 
             if(isset($_GET['edit_payment'])):
            ?>
            <a href="payment.php" class="gradient-button-cancel">Cancel editing</a>
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
