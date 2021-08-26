<?php 
session_start(); 
 include ("layout/admin_header.php");
 include ("process/admin_process.php");
?>
<?php if(!isset($_SESSION['login'])){
    header("location:index.php");
    $_SESSION['error'] = "you need to login to access this page";
}

?>
<link href="styles/forms_table.css" rel="stylesheet" type="text/css"> 
<!--error msg-->
<div class="error_msg">
    <?php  if(isset($_SESSION['error'])) 
    { 
    ?> 
    <span class="error" style="margin-top: -133px;;">
        <?php  echo $_SESSION['error'];?>
    </span>
    <?php
    }
    unset($_SESSION['error']);
    ?>
</div>
<div class="row">
  <div class="column">
  <input type="text" id="myInput" onkeyup="myFunctionAdmin()" placeholder="Search for usernames.." title="Type in a name">
  </div>
  <div class="column">
  </div>
  <div class="column">
    <div class="content_one" >
        <h2 style = "font-size: 12px;text-align: center;">Total admin </h2>
        <h2 class="number"  style="    text-align: center;font-size: 10px;"><?php echo  $admin_output ;?></h2>
    
    </div>
  </div>
</div>

<div style="overflow-x:auto;">
  <table id="MyTable">
    <tr>
      <th>SN</th>
      <th>Image</th>
      <th>Password</th>
      <th>Username</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
    <?php  $result = mysqli_query($conn, "SELECT * FROM admins")or die($conn->error());?>
        <?php while($row = $result->fetch_assoc()):?>
            <tr>
                <td>
                    <?php echo $row['admin_id'];?>
                </td>  
                <td>
                    <input type="hidden" name="size" value="1000000">
                    <?php
                        echo "<div id='img_div'>";
                            echo "<img src='img/".$row['image']."' style='width: 50px; height: 50px; border-radius: 100%;'>";
                        echo "</div>";
                    ?> 
               </td> 
                </td>              
                <td><?php echo $row['pwd'];?></td> 
                <td><?php echo $row['username'];?></td> 

                <td>
                    <a href="admin_details.php?edit_admin=<?php echo $row['admin_id'];?>" class="gradient-button-edit">Edit</a>
                </td>
                <td>
                    <a href="admin_details.php?delete_admin=<?php echo $row['admin_id'];?>"  class="gradient-button gradient-button-delete">Delete</a>
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
    <form action="admin_details.php" method="post" style="margin-top: 113px;" enctype="multipart/form-data">
    <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">	 
        <?php  
		   $res = mysqli_query($conn, "SELECT * FROM admins WHERE admin_id=$admin_id")or die($conn->error());
           $row = $res->fetch_assoc();
	    ?>  
        <header class="headers">
            <h1>Add New Admin</h1>
            <?php if(isset($_GET['edit_admin'])):?>
            
             <button type="submit" name="update_admin" id="update_admin" class="gradient-button-add" style="padding: 5px 20px;">Update</button>
            <?php else:?>
             <button type="submit" name="add_admin" id="add" class="gradient-button-add" style="padding: 5px 20px;">Add</button>
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
                    <?php  if(isset($_GET['edit_admin'])):?>
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

           

            <div class="pwd">
                <label for="pwd" class="label_pwd" style="    position: absolute; margin-left: -128px; margin-top: 18px; font-size: 15px; color: #808080;">Password</label>
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
                <label for="username" class="label_username" style="    position: absolute; margin-left: -131px; margin-top: 18px; font-size: 15px; color: #808080;">Username</label>
                <input type="text" name="username" id="username" placeholder="enter username" class="input" value="<?php echo $username;?>">
            </div>
            <!--error msg-->
            <div class="error_msg">
                <?php  if(isset($_SESSION['user_e'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['user_e'];?>
                </span>
                <?php
                }
                unset($_SESSION['user_e']);
                ?>
            </div> 

            
            <?php 
              if(isset($_GET['edit_admin'])):
            ?>
            <a href="admin_details.php" class="gradient-button-cancel">Cancel editing</a>
            <?php else: ?>
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
<script type="text/javascript" src="js/display.js"></script> 
<!-- <script type="text/javascript" src="open&closenav.js"></script> -->
