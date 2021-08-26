<?php  
session_start();
 include ("layout/admin_header.php");
 include ("process/category_process.php");
?>
<?php if(!isset($_SESSION['login'])){
    header("location:index.php");
    $_SESSION['error'] = "you need to login to access this page";
}

?>
<link href="styles/forms_table.css" rel="stylesheet" type="text/css">
<div class="row">

  <div class="column">
      <input type="text" id="myInput" onkeyup="myFunctionCategory()" placeholder="Search for category" title="Type in a name">
  </div>


  <div class="column">
    
  </div>

  <div class="column">
    <div class="content_one" >
        <h2  style = "font-size: 12px;text-align: center;">Total Cards</h2>
        <h2 class="number"  style="    text-align: center;font-size: 10px;"><?php echo  $category_output ;?></h2>
    
    </div>
  </div>
</div>

<div style="overflow-x:auto;">
  <table id="MyTable">
    <tr>
      <th>ID</th>
      <th>Image</th>
      <th>Categories</th>
      <th>Description</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
    <?php  $result = mysqli_query($conn, "SELECT * FROM category")or die($conn->error());?>
        <?php while($row = $result->fetch_assoc()):?>
          <tr>
              <td>
                <?php echo $row['category_id'];?>
              </td>
              <td>
               <input type="hidden" name="size" value="1000000">
                <?php
                      echo "<div id='img_div'>";
                        echo "<img src='img/".$row['image']."' style='width: 50px; height: 50px; border-radius: 100%;'>";
                      echo "</div>";
                ?> 
              </td> 
              <td><?php echo $row['categories'];?></td>               
              <td><?php echo $row['description'];?></td>                
              <td>
                <a href="category.php?edit_category=<?php echo $row['category_id'];?>" class="gradient-button-edit">Edit</a>
              </td>
              <td>
                <a href="category.php?delete_category=<?php echo $row['category_id'];?>"  class="gradient-button gradient-button-delete">Delete</a>
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
    <form action="category.php" method="post" style="margin-top: 113px;" enctype="multipart/form-data">
    <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">	 
        <?php  
		   $res = mysqli_query($conn, "SELECT * FROM category WHERE category_id=$category_id")or die($conn->error());
           $row = $res->fetch_assoc();
	    ?>  
        <header class="headers">
            <h1>Add New Category</h1>
            <?php if(isset($_GET['edit_category'])):?>
            
             <button type="submit" name="update_category" id="update_category" class="gradient-button-add" style="padding: 5px 20px;">Update</button>
            <?php else:?>
             <button type="submit" name="category_login" id="add" class="gradient-button-add" style="padding: 5px 20px;">Add</button>
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
                    <?php  if(isset($_GET['edit_category'])):?>
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
  
            
            <div class="categories">
                <label for="categories" class="label_categories" style="    position: absolute;  margin-left: -153px;  margin-top: 18px; font-size: 15px;  color: #808080;">Categories</label>
                <input type="text" name="categories" id="categories" placeholder="enter categories" class="input" value="<?php echo $categories;?>">
                
            </div>
            <!--error msg-->
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
            <div class="description">
                <label for="description" class="label_description" style="position: absolute;margin-left: -156px;margin-top: 18px;font-size: 15px;color: #808080;">Description</label>
                <input type="text" name="description" id="description" class="input" placeholder="enter description" value="<?php echo $description;?>">
            
            </div>
            <!--error msg-->
            <div class="error_msg">
                <?php  if(isset($_SESSION['d_error'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['d_error'];?>
                </span>
                <?php
                }
                unset($_SESSION['d_error']);
                ?>
            </div> 
            <?php 
            if(isset($_GET['edit_category'])):?>
            <a href="category.php" class="gradient-button-cancel">Cancel editing</a>
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
<!-- <script type="text/javascript" src="open&closenav.js"></script> -->

