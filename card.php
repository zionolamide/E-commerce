<?php  
session_start();
 include ("layout/admin_header.php");
 include ("process/card_process.php");
?>
<?php if(!isset($_SESSION['login'])){
    header("location:index.php");
    $_SESSION['error'] = "you need to login to access this page";
}

?>
<link href="styles/forms_table.css" rel="stylesheet" type="text/css">
<div class="row">

  <div class="column">
      <input type="text" id="myInput" onkeyup="myFunctionCard()" placeholder="Search for brandnames.." title="Type in a name">
  </div>


  <div class="column">
    
  </div>

  <div class="column">
    <div class="content_one" >
        <h2  style = "font-size: 12px;text-align: center;">Total Cards</h2>
        <h2 class="number"  style="    text-align: center;font-size: 10px;"><?php echo  $card_output ;?></h2>
    
    </div>
  </div>
</div>

<div style="overflow-x:auto;">
  <table id="MyTable">
    <tr>
      <th>ID</th>
      <th>Customer Name</th>
      <th>Card Number</th>
      <th>Ccv</th>
      <th>Date</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
    <?php  $result = mysqli_query($conn, "SELECT * FROM card")or die($conn->error());?>
        <?php while($row = $result->fetch_assoc()):?>
          <tr>
              <td>
                <?php echo $row['card_id'];?>
              </td>
              <td><?php echo $row['customer_name'];?></td>               
              <td><?php echo $row['card_number'];?></td>
              <td><?php echo $row['ccv'];?></td>    
              <td><?php echo $row['date']; ?></td>            
              <td>
                <a href="card.php?edit_card=<?php echo $row['card_id'];?>" class="gradient-button-edit">Edit</a>
              </td>
              <td>
                <a href="card.php?delete_card=<?php echo $row['card_id'];?>"  class="gradient-button gradient-button-delete">Delete</a>
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
    <form action="card.php" method="post" style="margin-top: 113px;" enctype="multipart/form-data">
    <input type="hidden" name="card_id" value="<?php echo $card_id; ?>">	 
        <?php  
		   $res = mysqli_query($conn, "SELECT * FROM card WHERE card_id=$card_id")or die($conn->error());
           $row = $res->fetch_assoc();
	    ?>  
        <header class="headers">
            <h1>Add New Card</h1>
            <?php if(isset($_GET['edit_card'])):?>
            
             <button type="submit" name="update_card" id="update_card" class="gradient-button-add" style="padding: 5px 20px;">Update</button>
            <?php else:?>
             <button type="submit" name="card_login" id="card_login" class="gradient-button-add" style="padding: 5px 20px;">Add</button>
            <?php endif;?>
        </header>
        <div class="body">
            <div class="customer_name">
                <label for="customer_name" class="label_customer_name" style="    position: absolute;  margin-left: -153px;  margin-top: 18px; font-size: 15px;  color: #808080;">Customer Name</label>
                <input type="text" name="customer_name" id="value" placeholder="enter customer name" class="input" value="<?php echo $customer_name;?>">
                <!-- <input type="text" id="text"> -->
                <select   id="names" class="select" onChange="update()">
                   <option value=""></option>
                   <?php 
                     $result = mysqli_query($conn, "SELECT * FROM customer")or die($conn->error());
                      while($row = $result->fetch_assoc()):
                   ?>
                   
                   <option value="<?php echo $row['fullname']?>" name="customer_name"id="customer_name" ><?php echo $row['fullname']?></option> 
                   <?php endwhile; ?>
                   

                </select>
            </div>
            
               
            <!--error msg-->
            <div class="error_msg">
                <?php  if(isset($_SESSION['c_e'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['c_e'];?>
                </span>
                <?php
                }
                unset($_SESSION['c_e']);
                ?>
            </div> 
            <div class="card_number">
                <label for="card_number" class="label_card_number" style="position: absolute;margin-left: -133px;margin-top: 18px;font-size: 15px;color: #808080;">Card number</label>
                <input type="text" name="card_number" id="card_number" class="input" placeholder="enter card number" value="<?php echo $card_number;?>">
            
            </div>
            <!--error msg-->
            <div class="error_msg">
                <?php  if(isset($_SESSION['card_e'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['card_e'];?>
                </span>
                <?php
                }
                unset($_SESSION['card_e']);
                ?>
            </div>
            
            <div class="ccv">
                <label for="ccv" class="label_ccv" style="position: absolute;margin-left: -74px;margin-top: 18px;font-size: 15px;color: #808080;">Ccv</label>
                <input type="text" name="ccv" id="ccv" class="input" placeholder="enter ccv" value="<?php echo $ccv;?>">
            
            </div>
            <!--error msg-->
            <div class="error_msg">
                <?php  if(isset($_SESSION['ccv_e'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['ccv_e'];?>
                </span>
                <?php
                }
                unset($_SESSION['ccv_e']);
                ?>
            </div>
            <?php if(isset($_GET['edit_card'])):?>
                <a href="card.php" class="gradient-button-cancel">Cancel editing</a>
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

