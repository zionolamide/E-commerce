<?php  
session_start();
 include ("layout/admin_header.php");
 include ("process/message_process.php");
?>
<?php if(!isset($_SESSION['login'])){
    header("location:index.php");
    $_SESSION['error'] = "you need to login to access this page";
}

?>

<link href="styles/forms_table.css" rel="stylesheet" type="text/css">
<div class="row">

  <div class="column">
  <input type="text" id="myInput" onkeyup="myFunctionMsg()" placeholder="Search for customer" title="Type in a name">
  </div>


  <div class="column">
    
  </div>

  <div class="column">
    <div class="content_one" >
        <h2  style = "font-size: 12px;text-align: center;">Total Message</h2>
        <h2 class="number"  style="    text-align: center;font-size: 10px;"><?php echo  $message_output ;?></h2>
    
    </div>
  </div>
</div>
<div style="overflow-x:auto;">
  <table id="MyTable">
    <tr>
      <th>SN</th>
      <th>Customer Name</th>
      <th>Message</th>
      <th>Date</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
    <?php  $result = mysqli_query($conn, "SELECT * FROM messages")or die($conn->error());?>
        <?php while($row = $result->fetch_assoc()):?>
          <tr>
              <td>
                <?php echo $row['message_id'];?>
              </td>
              <td><?php echo $row['customer_name'];?></td>
              <td><?php echo $row['message'];?></td>
              <td><?php echo $row['date'];?></td>
              <td>
                <a href="message.php?edit_message=<?php echo $row['message_id'];?>" class="gradient-button-edit">Edit</a>
              </td>
              <td>
                <a href="message.php?delete_message=<?php echo $row['message_id'];?>"  class="gradient-button gradient-button-delete">Delete</a>
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
    <?php  if(isset($_SESSION['m_error'])) 
    { 
    ?> 
    <span class="del_msg">
        <?php  echo $_SESSION['e_error'];?>
    </span>
    <?php
    }
    unset($_SESSION['e_error']);
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
    <form action="message.php" method="post" style="margin-top: 113px;">
    <input type="hidden" name="message_id" value="<?php echo $message_id; ?>">	 
        <?php  
		   $result = mysqli_query($conn, "SELECT * FROM messages WHERE message_id=$message_id")or die($conn->error());
		   $row = $result->fetch_assoc();
	    ?> 
        <header class="headers">
            <h1>Add New Message</h1>
            <?php if(isset($_GET['edit_message'])):?>
            
             <button type="submit" name="update_message" id="update_message" class="gradient-button-add" style="padding: 5px 20px;">Update</button>
            <?php else:?>
             <button type="submit" name="add_message" id="add_message" class="gradient-button-add" style="padding: 5px 20px;">Add</button>
            <?php endif;?>
        </header>
        <div class="body">
            <div class="customer_name">
                <label for="customer_name" class="customer_name" style="position: absolute;margin-left: -140px;margin-top: 18px;font-size: 15px;color: #808080;">Customer Name</label>
                <input type="text" name="customer_name" id="value" placeholder="enter customer name" class="input" value="<?php echo $customer_name;?>">
                <select  id="names" class="select" onChange="update()">
                   <?php 
                      $result = mysqli_query($conn, "SELECT * FROM customer")or die($conn->error());
                      while($row = $result->fetch_assoc()):
                   ?>
                   <option value="<?php echo $row['fullname']?>" name="customer_name"><?php echo $row['fullname']?></option>
                   <?php endwhile; ?>
                </select>
            </div>
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

            <div class="message">
                <label for="message" class="message" style="position: absolute;margin-left: -140px;margin-top: 18px;font-size: 15px;color: #808080;">Message</label>
                <!--<input type="text" name="message" id="message" placeholder="enter message" class="input" value="<?php// echo $message;?>" >-->
                <textarea name="message" id="message" cols="30" rows="10" class="input" value=""><?php echo $message; ?></textarea>
            
            </div>
            <div class="error_msg">
                <?php  if(isset($_SESSION['m_e'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['m_e'];?>
                </span>
                <?php
                }
                unset($_SESSION['m_e']);
                ?>
            </div>
             
           
        
            <?php 
             if(isset($_GET['edit_message'])):

            ?>
            <a href="message.php" class="gradient-button-cancel">Cancel editing</a>
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
