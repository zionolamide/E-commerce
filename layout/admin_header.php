<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-commerce</title>
  <!--css-->
  <link href="styles/admin_header.css" rel="stylesheet" type="text/css">
</head>
<body>


<div class="header">
  <a href="#default" class="logo">Admin Control Panel</a>
  <div class="header-right">

    <a href="#about"><span onclick="openNav()">&#9776;</span></a>
  </div>
</div>
<!--sidenav-->
<div id="mySidenav" class="sidenav" onclick="closeNav()">
  <a href="customers.php">Customers</a>
  <a href="product.php">Product</a>
  <a href="order.php">Orders</a>
  <a href="category.php">category</a>
  <a href="payment.php">Payment</a>
  <a href="delivery.php">Delivery</a>
  <a href="refund.php">Refund</a>
  <a href="card.php">Card</a>
  <a href="total.php">Total</a>
  <a href="brand.php">Brand</a>
  <a href="admin_details.php">Admin Details</a>
  <a href="transaction.php">Transaction</a>
  <a href="discount.php">discount</a>
  <a href="message.php">Message</a>
  <a href="store.php">Store</a>
  <a href="product_option.php">Product_option</a>
  <a href="product_variation.php">Product_variation</a>
  <a href="#">Status</a>
  <a href="#">Order_status</a>
  <a href="logout.php">Logout</a>
</div>



<script src="js/open_closenav.js" type="text/javascript"></script>