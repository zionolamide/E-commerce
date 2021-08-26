<?php 
session_start(); 
 include ("layout/admin_header.php");
 //include ("process/payment_process.php");
 include ("process/refund_process.php");
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
<div class="content_one" >
      <h2  style = "font-size: 12px;text-align: center;">Total Refund</h2>
      <h2 class="number"  style="    text-align: center;font-size: 10px;">
      <?php  echo $refund_count; ?>
      </h2> 
  
  </div>
</div>

<div class="column">
  <div class="content_one" >
      <h2  style = "font-size: 12px;text-align: center;">Total </h2>
      <h2 class="number"  style="    text-align: center;font-size: 10px;">
      <?php 
        if ($refund_qty == 0){
            echo '&#8358;' . number_format(0, 2);
        }else{
            echo '&#8358;' . number_format($refund_qty, 2);
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
      <th>Quantity</th>
      <th>Customer Name</th>
      <th>Amount Paid</th>
      <th>Card Number</th>
      <th>Ccv</th>
      <th>Date Paid</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
    <?php  $result = mysqli_query($conn, "SELECT * FROM refund")or die($conn->error());?>
        <?php while($row = $result->fetch_assoc()):?>
          <tr>
              <td>
                <?php echo $row['refund_id'];?>
              </td>
              <!-- <td>
               <input type="hidden" name="size" value="1000000">
                <?php
                    //   echo "<div id='img_div'>";
                    //     echo "<img src='img/".$row['image']."' style='width: 50px; height: 50px; border-radius: 100%;'>";
                    //   echo "</div>";
                ?> 
              </td>  -->
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
                <a href="refund.php?edit_refund=<?php echo $row['refund_id'];?>" class="gradient-button-edit">Edit</a>
              </td>
              <td>
                <a href="refund.php?delete_refund=<?php echo $row['refund_id'];?>"  class="gradient-button gradient-button-delete">Delete</a>
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




<script type="text/javascript" src="js/display.js"></script>
<script type="text/javascript" src="js/filter_table.js"></script>
