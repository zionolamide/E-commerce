<?php  
session_start();
 include ("layout/admin_header.php");
 include ("process/brand_process.php");
?>
<?php if(!isset($_SESSION['login'])){
    header("location:index.php");
    $_SESSION['error'] = "you need to login to access this page";
}

?>
<link href="styles/forms_table.css" rel="stylesheet" type="text/css">
<div class="row">
  <div class="column">
  <input type="text" id="myInput" onkeyup="myFunctionBrand()" placeholder="Search for brandnames.." title="Type in a name">
  </div>
  <div class="column">
  </div>
  <div class="column">
    <div class="content_one" >
        <h2  style = "font-size: 12px;text-align: center;">Total Brand</h2>
        <h2 class="number"  style="    text-align: center;font-size: 10px;"><?php echo  $brand_output ;?></h2>
    
    </div>
  </div>
</div>

<div style="overflow-x:auto;">
  <table id="MyTable">
    <tr>
      <th>SN</th>
      <th>Image</th>
      <th>Brand Name</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
    <?php  $result = mysqli_query($conn, "SELECT * FROM brand")or die($conn->error());?>
        <?php while($row = $result->fetch_assoc()):?>
          <tr>
              <td>
                <?php echo $row['brand_id'];?>
              </td>
              <td>
               <input type="hidden" name="size" value="1000000">
                <?php
                      echo "<div id='img_div'>";
                        echo "<img src='img/".$row['image']."' style='width: 50px; height: 50px; border-radius: 100%;'>";
                      echo "</div>";
                ?> 
              </td> 
              <td><?php echo $row['brand_name'];?></td>                                 
              <td>
                <a href="brand.php?edit_brand=<?php echo $row['brand_id'];?>" class="gradient-button-edit">Edit</a>
              </td>
              <td>
                <a href="brand.php?delete_brand=<?php echo $row['brand_id'];?>"  class="gradient-button gradient-button-delete">Delete</a>
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
    <form action="brand.php" method="post" style="margin-top: 113px;" enctype="multipart/form-data">
    <input type="hidden" name="brand_id" value="<?php echo $brand_id; ?>">	 
        <?php  
		   $res = mysqli_query($conn, "SELECT * FROM brand WHERE brand_id=$brand_id")or die($conn->error());
           $row = $res->fetch_assoc();
	    ?>  
        <header class="headers">
            <h1>Add New Brand</h1>
            <?php if(isset($_GET['edit_brand'])):?>
            <a href="brand.php" class="gradient-button-cancel">Cancel editing</a>
             <button type="submit" name="update_brand" id="update_brand" class="gradient-button-add" style="padding: 5px 20px;">Update</button>
            <?php else:?>
             <button type="submit" name="add_brand" id="add" class="gradient-button-add" style="padding: 5px 20px;">Add</button>
            <?php endif;?>
        </header>
        <div class="body">
            <!--img row-->
            <div class="image">
                <label for="image" class="label_image">Image</label>
                <input type="file" name="image" accept="image/*" id="file" style="display:none;" class="inputfile" />
                
                <label for="file" class="label" id="img-preview" name="image" >add img
                <span>
                    <?php  if(isset($_GET['edit_brand'])):?>
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
            <div class="brand_name">
                <label for="brand_name" class="label_brand_name" style="    position: absolute;  margin-left: -166px;  margin-top: 18px; font-size: 15px;  color: #808080;">Brand_name</label>
                <input type="text" name="brand_name" id="brand_name" placeholder="enter brand_name" class="input" value="<?php echo $brand_name;?>">
            </div>
                <!--error msg-->
                <div class="error_msg">
                <?php  if(isset($_SESSION['b_e'])) 
                { 
                ?> 
                <span class="error">
                    <?php  echo $_SESSION['b_e'];?>
                </span>
                <?php
                }
                unset($_SESSION['b_e']);
                ?>
            </div> 

            


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
<!-- <script type="text/javascript" src="open&closenav.js"></script>
 -->
