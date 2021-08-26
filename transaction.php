<?php  
session_start();
 include ("layout/admin_header.php");
 include ("process/transactions_process.php");
?>
<?php if(!isset($_SESSION['login'])){
    header("location:index.php");
    $_SESSION['error'] = "you need to login to access this page";
}

?>
<div class="css">]
  <link href="styles/forms_table.css" rel="stylesheet" type="text/css">
</div>

<div class="row">
   <!--first column-->
    <div class="column">
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for store name" title="Type in a name">
    </div>

    <!--second column-->
    <div class="column">
      <div class="content_one" >
          <h2  style = "font-size: 12px;text-align: center;">Total No</h2>
          <h2 class="number"  style="    text-align: center;font-size: 10px;">
          <?php 
              if ($transaction_output == 0){
                  echo '&#8358;' . number_format(0, 2);
              }else{
                  echo '&#8358;' . number_format($transaction_output, 2);
              } ?>
          </h2> 
      </div>
    </div>

    <!--Thired column-->
    <div class="column">
    <div class="content_one" >
            <h2  style = "font-size: 12px;text-align: center;">Total No</h2>
            <h2 class="number"  style="    text-align: center;font-size: 10px;">
            <?php  echo $count_transaction_output; ?>
            </h2> 
        
        </div>
    
    </div>
</div>
<div style="overflow-x:auto;">
  <table id="MyTable">
    <tr>
      <th>SN</th>
      <th>Amount</th>
      <th>Description</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
    <?php  $result = mysqli_query($conn, "SELECT * FROM transactions")or die($conn->error());?>
        <?php while($row = $result->fetch_assoc()):?>
          <tr>
              <td>
                <?php echo $row['transaction_id'];?>
              </td>
              <td>
                <?php echo $row['amount'];?>
              </td>
              <td>
                <?php echo $row['description'];?>
              </td>                
              <td>
                <a href="transaction.php?edit_transaction=<?php echo $row['transaction_id'];?>" class="gradient-button-edit">Edit</a>
              </td>
              <td>
                <a href="transaction.php?delete_transaction=<?php echo $row['transaction_id'];?>"  class="gradient-button gradient-button-delete">Delete</a>
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
    <form action="transaction.php" method="post" style="margin-top: 113px;" enctype="multipart/form-data">
    <input type="hidden" name="transaction_id" value="<?php echo $transaction_id; ?>">	 
        <?php  
		   $res = mysqli_query($conn, "SELECT * FROM transactions WHERE transaction_id=$transaction_id")or die($conn->error());
           $row = $res->fetch_assoc();
	    ?>  
        <header class="headers">
            <h1>Add New Transaction</h1>
            <?php if(isset($_GET['edit_transaction'])):?>
                         <button type="submit" name="update_transaction" id="update_transaction" class="gradient-button-add" style="padding: 5px 20px;">Update</button>
            <?php else:?>
             <button type="submit" name="add_transaction" id="add" class="gradient-button-add" style="padding: 5px 20px;">Add</button>
            <?php endif;?>
        </header>
        <div class="body">        
            <div class="amount">
                <label for="amount" class="amount" style="position: absolute;margin-left: -140px;margin-top: 18px;font-size: 15px;color: #808080;">Amount</label>
                <input type="text" name="amount" id="amount" placeholder="enter amount" class="input" value="<?php echo $amount;?>">
               
            </div>
            <!--error msg-->
            <div class="error_msg">
                <?php  if(isset($_SESSION['a_e'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['a_e'];?>
                </span>
                <?php
                }
                unset($_SESSION['a_e']);
                ?>
            </div> 

            <div class="description">
                <label for="description" class="description" style="position: absolute;margin-left: -140px;margin-top: 18px;font-size: 15px;color: #808080;">Description</label>
                <input type="text" name="description" id="description" placeholder="enter description" class="input" value="<?php echo $description;?>">
                
            </div>
            <!--error msg-->
            <div class="error_msg">
                <?php  if(isset($_SESSION['d_e'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['d_e'];?>
                </span>
                <?php
                }
                unset($_SESSION['d_e']);
                ?>
            </div> 
            

            <?php if(isset($_GET['edit_transaction'])):?>
              <a href="transaction.php" class="gradient-button-cancel">Cancel editing</a>

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
<!-- <script type="text/javascript" src="open&closenav.js"></script> -->
