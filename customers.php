<?php
session_start();  
 include ("layout/admin_header.php");
 include ("process/customer_process.php");
?>
<?php if(!isset($_SESSION['login'])){
    header("location:index.php");
    $_SESSION['error'] = "you need to login to access this page";
}

?>

<link href="styles/forms_table.css" rel="stylesheet" type="text/css">
<div class="row">

  <div class="column">
  <input type="text" id="myInput" onkeyup="myFunctionCustomer()" placeholder="Search for fullname" title="Type in a name">
  </div>


  <div class="column">
    
  </div>

  <div class="column">
    <div class="content_one" >
        <h2  style = "font-size: 12px;text-align: center;">Total Customer</h2>
        <h2 class="number"  style="    text-align: center;font-size: 10px;"><?php echo  $customer_output ;?></h2>
    
    </div>
  </div>
</div>

<div style="overflow-x:auto;">
  <table id="MyTable">
    <tr>
      <th>SN</th>
      <th>Image</th>
      <th>Fullname</th>
      <th>Email</th>
      <th>Phone Number</th>
      <th>Address</th>
      <th>State</th>
      <th>Country</th>
      <th>City</th>
      <th>Password</th>
      <th>Username</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
    <?php  $result = mysqli_query($conn, "SELECT * FROM customer")or die($conn->error());?>
        <?php while($row = $result->fetch_assoc()):?>
          <tr>
              <td>
                <?php echo $row['customer_id'];?>
              </td>
              <td>
               <input type="hidden" name="size" value="1000000">
                <?php
                      echo "<div id='img_div'>";
                        echo "<img src='img/".$row['image']."' style='width: 50px; height: 50px; border-radius: 100%;'>";
                      echo "</div>";
                ?> 
              </td> 
              <td><?php echo $row['fullname'];?></td>               
              <td><?php echo $row['email'];?></td>
              <td><?php echo $row['phone'];?></td> 
              <td><?php echo $row['address'];?></td>               
              <td><?php echo $row['state'];?></td>
              <td><?php echo $row['country'];?></td>
              <td><?php echo $row['city'];?></td>               
              <td><?php echo $row['pwd'];?></td>
              <td><?php echo $row['username'];?></td>                   
              <td>
                <a href="customers.php?edit_customer=<?php echo $row['customer_id'];?>" class="gradient-button-edit">Edit</a>
              </td>
              <td>
                <a href="customers.php?delete_customer=<?php echo $row['customer_id'];?>"  class="gradient-button gradient-button-delete">Delete</a>
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
    <form action="customers.php" method="post" style="margin-top: 113px;" enctype="multipart/form-data">
    <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">	 
        <?php  
		   $res = mysqli_query($conn, "SELECT * FROM customer WHERE customer_id=$customer_id")or die($conn->error());
           $row = $res->fetch_assoc();
	    ?>  
        <header class="headers">
            <h1>Add New Customer</h1>
            <?php if(isset($_GET['edit_customer'])):?>
            
             <button type="submit" name="update_customer" id="update_customer" class="gradient-button-add" style="padding: 5px 20px;">Update</button>
            <?php else:?>
             <button type="submit" name="customer_login" id="add" class="gradient-button-add" style="padding: 5px 20px;">Add</button>
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
                    <?php  if(isset($_GET['edit_customer'])):?>
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
            <div class="fullname">
                <label for="fullname" class="label_fullname">Fullname</label>
                <input type="text" name="fullname" id="fullname" placeholder="enter fullname" class="input" value="<?php echo $fullname;?>">
            </div>
                <!--error msg-->
                <div class="error_msg">
                <?php  if(isset($_SESSION['f_error'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['f_error'];?>
                </span>
                <?php
                }
                unset($_SESSION['f_error']);
                ?>
            </div> 
            
            <div class="email">
                <label for="email" class="label_email" style="    position: absolute;  margin-left: -114px;  margin-top: 18px; font-size: 15px;  color: #808080;"> Email</label>
                <input type="text" name="email" id="email" placeholder="enter email" class="input" value="<?php echo $email;?>">
                
            </div>
            <!--error msg-->
            <div class="error_msg">
                <?php  if(isset($_SESSION['e_error'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['e_error'];?>
                </span>
                <?php
                }
                unset($_SESSION['e_error']);
                ?>
            </div> 
            <div class="phone">
                <label for="phone" class="label_phone" style="position: absolute;margin-left: -122px;margin-top: 18px;font-size: 15px;color: #808080;"> Phone</label>
                <input type="text" name="phone" id="phone" class="input" placeholder="enter Phone" value="<?php echo $phone;?>">
            
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

            <div class="address">
                <label for="address" class="label_address" style="position: absolute;margin-left: -115px;margin-top: 18px;font-size: 15px;color: #808080;">Address</label>
                <input type="text" name="address" id="address" class="input" placeholder="enter adress" value="<?php echo $address;?>">
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

            <div class="state">
                <label for="state" class="label_state" style="position: absolute;margin-left: -115px;margin-top: 18px;font-size: 15px;color: #808080;">State</label>
                <input type="text" name="state" id="state" class="input" placeholder="enter state" value="<?php echo $state;?>">
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
      
            <div class="country">
                <label for="state" class="label_country" style="position: absolute;margin-left: -134px;margin-top: 18px;font-size: 15px;color: #808080;">Country</label>
                <input type="text" name="country" id="country" class="input" placeholder="enter country" value="<?php echo $country;?>" >
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

            <div class="city">
                <label for="city" class="label_city" style="position: absolute;margin-left: -111px;margin-top: 18px;font-size: 15px;color: #808080;">City</label>
                <input type="text" name="city" id="city" class="input" placeholder="enter city" value="<?php echo $city;?>">
            </div>
            <!--error msg-->
            <div class="error_msg">
                <?php  if(isset($_SESSION['ci_e'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['ci_e'];?>
                </span>
                <?php
                }
                unset($_SESSION['ci_e']);
                ?>
            </div> 

            <div class="pwd">
                <label for="pwd" class="label_pwd" style="    position: absolute; margin-left: -152px; margin-top: 18px; font-size: 15px; color: #808080;">Password</label>
                <input type="text" name="pwd" id="pwd" placeholder="enter password" class="input" value="<?php echo $pwd;?>">
            </div>
            <!--error msg-->
            <div class="error_msg">
                <?php  if(isset($_SESSION['pwd_e'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['pwd_e'];?>
                </span>
                <?php
                }
                unset($_SESSION['pwd_e']);
                ?>
            </div> 

            <div class="username">
                <label for="username" class="label_username" style="    position: absolute; margin-left: -155px; margin-top: 18px; font-size: 15px; color: #808080;">Username</label>
                <input type="text" name="username" id="username" placeholder="enter username" class="input" value="<?php echo $username;?>">
            </div>
            <!--error msg-->
            <div class="error_msg">
                <?php  if(isset($_SESSION['u_error'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['u_error'];?>
                </span>
                <?php
                }
                unset($_SESSION['u_error']);
                ?>
            </div> 
      
            
            <?php 
            if(isset($_GET['edit_customer'])):
            ?>
            <a href="customers.php" class="gradient-button-cancel">Cancel editing</a>
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



<script type="text/javascript" src="js/display.js"></script>
<script type="text/javascript" src="js/filter_table.js"></script>
