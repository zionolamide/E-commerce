<?php  
session_start();
 include ("layout/admin_header.php");
 include ("process/store_process.php");
?>
<?php if(!isset($_SESSION['login'])){
    header("location:index.php");
    $_SESSION['error'] = "you need to login to access this page";
}

?>
<link href="styles/forms_table.css" rel="stylesheet" type="text/css">

<div class="row">
    <div class="column">
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for store name" title="Type in a name">
    </div>

    <div class="column">
        <div class="content_one" >
            <h2  style = "font-size: 12px;text-align: center;">Total Store</h2>
            <h2 class="number"  style="    text-align: center;font-size: 10px;">
            <?php echo $store_output;?>
            </h2> 
        
        </div>
    </div>
    <div class="column">

    </div>
</div>
<div style="overflow-x:auto;">
  <table id="MyTable">
    <tr>
      <th>SN</th>
      <th>Store Name</th>
      <th>phone</th>
      <th>Email</th>
      <th>Street</th>
      <th>city</th>
      <th>State</th>
      <th>Zip Code</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
    <?php  $result = mysqli_query($conn, "SELECT * FROM store")or die($conn->error());?>
        <?php while($row = $result->fetch_assoc()):?>
          <tr>
              <td>
                <?php echo $row['store_id'];?>
              </td>
              <td>
                <?php echo $row['store_name'];?>
              </td>
              <td>
                <?php echo $row['phone'];?>
              </td>
              <td>
                 <?php echo $row['email']; ?></h2>
              </td>               
              <td><?php echo $row['street'];?></td>  
              <td><?php echo $row['city'];?></td>   
              <td><?php echo $row['state'];?></td>       
              <td><?php echo $row['zip_code'];?></td>            
              <td>
                <a href="store.php?edit_store=<?php echo $row['store_id'];?>" class="gradient-button-edit">Edit</a>
              </td>
              <td>
                <a href="store.php?delete_store=<?php echo $row['store_id'];?>"  class="gradient-button gradient-button-delete">Delete</a>
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
    <form action="store.php" method="post" style="margin-top: 113px;" enctype="multipart/form-data">
    <input type="hidden" name="store_id" value="<?php echo $store_id; ?>">	 
        <?php  
		   $res = mysqli_query($conn, "SELECT * FROM store WHERE store_id=$store_id")or die($conn->error());
           $row = $res->fetch_assoc();
	    ?>  
        <header class="headers">
            <h1>Add New store</h1>
            <?php if(isset($_GET['edit_store'])):?>
                        <button type="submit" name="update_store" id="update_store" class="gradient-button-add" style="padding: 5px 20px;">Update</button>
            <?php else:?>
             <button type="submit" name="add_store" id="add" class="gradient-button-add" style="padding: 5px 20px;">Add</button>
            <?php endif;?>
        </header>
        <div class="body">        
            <div class="store_name">
                <label for="store_name" class="store_name" style="position: absolute;margin-left: -140px;margin-top: 18px;font-size: 15px;color: #808080;">Store Name </label>
                <input type="text" name="store_name" id="store_name" placeholder="enter store name" class="input" value="<?php echo $store_name;?>">
                
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

            <div class="phone">
                <label for="phone" class="phone" style="position: absolute;margin-left: -104px;margin-top: 18px;font-size: 15px;color: #808080;">phone</label>
                <input type="text" name="phone" id="phone" placeholder="enter phone number" class="input" value="<?php echo $phone;?>">
                
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
         

            
            <div class="email">
                <label for="email" class="email" style="    position: absolute;  margin-left: -100px;  margin-top: 18px; font-size: 15px;  color: #808080;">Email</label>
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
            <div class="street">
                <label for="street" class="label_street" style="position: absolute;margin-left: -103px;margin-top: 18px;font-size: 15px;color: #808080;">Street</label>
                <input type="text" name="street" id="street" class="input" placeholder="enter street" value="<?php echo $street;?>">
            
            </div>
            <!--error msg-->
            <div class="error_msg">
                <?php  if(isset($_SESSION['street_e'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['street_e'];?>
                </span>
                <?php
                }
                unset($_SESSION['street_e']);
                ?>
            </div> 

            <div class="city">
                <label for="city" class="label_city" style="position: absolute;margin-left: -87px;margin-top: 18px;font-size: 15px;color: #808080;">city</label>
                <input type="text" name="city" id="city" class="input" placeholder="enter city" value="<?php echo $city;?>">
            
            </div>
            <!--error msg-->
            <div class="error_msg">
                <?php  if(isset($_SESSION['city_e'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['city_e'];?>
                </span>
                <?php
                }
                unset($_SESSION['city_e']);
                ?>
            </div> 

            <div class="state">
                <label for="state" class="label_state" style="position: absolute;margin-left: -100px;margin-top: 18px;font-size: 15px;color: #808080;">State</label>
                <input type="text" name="state" id="state" class="input" placeholder="enter state" value="<?php echo $state;?>">
            
            </div>
            <!--error msg-->
            <div class="error_msg">
                <?php  if(isset($_SESSION['state_e'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['state_e'];?>
                </span>
                <?php
                }
                unset($_SESSION['state_e']);
                ?>
            </div> 

            
            <div class="zip_code">
                <label for="zip_code" class="zip_code" style="position: absolute;margin-left: -126px;margin-top: 18px;font-size: 15px;color: #808080;">Zip Code</label>
                <input type="text" name="zip_code" id="zip_code" class="input" placeholder="enter zip_code" value="<?php echo $zip_code;?>">
            
            </div>
            <!--error msg-->
            <div class="error_msg">
                <?php  if(isset($_SESSION['zip_e'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['zip_e'];?>
                </span>
                <?php
                }
                unset($_SESSION['zip_e']);
                ?>
            </div>

            

            <?php 
             if(isset($_GET['edit_store'])):
            ?>
            <a href="store.php" class="gradient-button-cancel">Cancel editing</a>
            <?php else: ?>
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





<script type="text/javascript" src="js/filter_table.js"></script>
