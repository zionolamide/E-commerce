<?php 
 include ("layout/admin_header.php");
?>
<?php if(!isset($_SESSION['login'])){
    header("location:index.php");
    $_SESSION['error'] = "you need to login to access this page";
}

?>
<?php 
session_start(); 
include ("process/admin_process.php");
include ("process/brand_process.php");
include ("process/card_process.php");
include ("process/category_process.php");
include ("process/customer_process.php");
include ("process/delivery_process.php");
include ("process/discount_process.php");
include ("process/message_process.php");
include ("process/order_process.php");
include ("process/payment_process.php");
include ("process/product_option_process.php");
include ("process/product_variation_process.php");
include ("process/product_process.php");
include ("process/refund_process.php");
include ("process/store_process.php");
include ("process/transactions_process.php");
?>

<link href="styles/forms_table.css" rel="stylesheet" type="text/css"> 

<div style="overflow-x:auto;" >
  <table id="MyTable" style="margin-top:10%;">
    <tr>
      <th>SN</th>
      <th>Total Admin</th>
      <th>Total Brand</th>
      <th>Total Card</th>
      <th>Total category</th>
      <th>Total Customers</th>
      <th>Total Deliveries</th>
      <th>Total Discount</th>
      <th>Total Messages</th>
      <th>Total Orders</th>
      <th>Total Payment</th>
      <th>Total No Of Payment</th>
      <th>Total Product Option</th>
      <th>Total Number Of Product Option</th>
      <th>Total Variation </th>
      <th>Total Product</th>
      <th>Total Refund</th>
      <th>Total No Of Refund</th>
      <th>Total Store</th>
      <th>Total Transactions</th>
      <th>Total No Of Transactions</th>
    </tr>
    <tr>
        <td><?php echo  1;?></td>
        <td><?php echo  $admin_output ;?></td>
        <td><?php echo  $brand_output ;?></td>
        <td><?php echo  $card_output ;?></td>
        <td><?php echo  $category_output ;?></td>
        <td><?php echo  $customer_output ;?></td>
        <td><?php echo  $delivery_output ;?></td>
        <td><?php echo  $discount_output ;?></td>
        <td><?php echo  $message_output ;?></td>
        <td></td>
        <td>
        <?php 
            if ($payment_add_output == 0){
                echo '&#8358;' . number_format(0, 2);
            }else{
               // $amount_output = $amount_output * $quantity_output ;
                echo '&#8358;' . number_format ($payment_add_output, 2);
            }
            

        ?>
        </td>
        <td>
        <?php
            echo $payment_count;
        ?>
        </td>
        <td>
        <?php 
            if ($result_output == 0){
                echo '&#8358;' . number_format(0, 2);
            }else{
               // $amount_output = $amount_output * $quantity_output ;
                echo '&#8358;' . number_format ($result_output, 2);
            }
            

        ?>
        </td>
        <td><?php echo  $product_option_output ;?></td>
        <td><?php echo  $product_variation_output ;?></td>
        <td><?php echo  $product_output ;?></td>
        <td>
        <?php 
        if ($refund_qty == 0){
            echo '&#8358;' . number_format(0, 2);
        }else{
            echo '&#8358;' . number_format($refund_qty, 2);
        }
        

        ?>
        </td>
        <td><?php  echo $refund_count; ?></td>						   
        <td><?php echo $store_output;?></td>
        <td>
        <?php 
              if ($transaction_output == 0){
                  echo '&#8358;' . number_format(0, 2);
              }else{
                  echo '&#8358;' . number_format($transaction_output, 2);
              }
        ?>
        </td>
        <td><?php  echo $count_transaction_output; ?></td>
    </tr>
       

        <?php 
          function pre_r($array){
          echo '<pre>';
          print_r($array);
          echo '</pre>';
            }
        
        ?>
     

    
  </table>
</div>



<script type="text/javascript" src="js/filter_table.js"></script> 
<script type="text/javascript" src="js/display.js"></script> 
<!-- <script type="text/javascript" src="open&closenav.js"></script> -->
