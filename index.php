<?php
session_start();
include ("layout/header.php");
?>
<?php 

 include ("process/admin_process.php");
?>
 <?php if(!isset($_SESSION['login'])){
    header("location:index.php");
    $_SESSION['error'] = "you need to login to access this page";
}

?>
 <link rel="stylesheet" text="text/css" href="styles/index.css">
  <!--error msg-->
 

    <div class="slideshow">
        <!--Form Row-->
        <div class="row">
            <!--column one-->
            <div class="column" >

            </div>

            <!--column two-->
            <div class="column" >
                 <!--form fields-->
                 <div class="error_msg">
                    <?php  if(isset($_SESSION['error'])) 
                    { 
                    ?> 
                    <span class="errors" >
                        <?php  echo $_SESSION['error'];?>
                    </span>
                    <?php
                    }
                    unset($_SESSION['error']);
                    ?>
                </div> 
                <div class="login_form">
                        <div class="header-section">
                           <img src="img/user.png" alt="user" class="admin_img">
                       </div>
                    <form action="index.php" method="post" class="login">
                       
                       <!--password row-->
                       <div class="form-group">
                           <input type="password" name="pwd"  id="pwd" class="form-control">
                            <div class="error_msg">
                                <?php  if(isset($_SESSION['pwd_error'])) 
                                { 
                                ?> 
                                <span class="error">
                                    <?php  echo $_SESSION['pwd_error'];?>
                                </span>
                                <?php
                                }
                                unset($_SESSION['pwd_error']);
                                ?>
                            </div> 
                        
                           <label for="pwd" class="n_pwd">Password</label>
                       </div>

                       <div class="btn-group" style="margin-top: 34px;">
                           <button type="submit" class="btn-login" name="admin_login">Login</button>
                          
                           <div class="clear"></div>
                       </div>
                       
                         
                   </form>
               </div>

               <!-- <select id="language" onChange="update()">
                   <option value="">Select</option>
                    <option  value="en">english</option>
                    <option  value="es">espanol</option>
                    <option  value="pt">portugeus</option>
               </select>

                   <input type="text" id="value">
                  -->

            </div>

            <!--column three-->
            <div class="column" >
                
            </div>
        </div>

        
    </div> 

    
  




