<?php
include "header.php";
include "left-navbar.php";
//include "session.php";

$r_id = $_SESSION['role_id']; 
$query ="select role_name from roles where role_id =  $r_id";
$results = mysqli_query($connection,$query);
while ($row = mysqli_fetch_assoc($results))
{
 $role_name = $row['role_name'];
}

$msg = "";   
$msg_class = "";
$error="";
if($role_name == "Teacher")
{
  $query="SELECT * FROM `teachers` WHERE teacher_id = $i_id";
  $select_teacher = mysqli_query($connection, $query);  

  while($row = mysqli_fetch_assoc($select_teacher)) 
  {
    $post_id = $row['teacher_id'];
    $post_title = $row['teacher_firstname'];
    $post_author = $row['teacher_lastname'];
    $post_user = $row['teacher_username'];
    $post_content = $row['teacher_email'];
    $post_status = $row['teacher_password']; 
    $new_mobile = $row['teacher_phone'];
    $image = $row['teacher_image'];
  } 
}else
{
  $query="SELECT * FROM `students` WHERE student_id=$i_id";
      $select_teacher = mysqli_query($connection, $query);  

      while($row = mysqli_fetch_assoc($select_teacher)) 
      {
      $post_id = $row['student_id'];
      $post_title = $row['student_firstname'];
      $post_author = $row['student_lastname'];
      $post_user = $row['student_username'];
      $post_status = $row['student_password'];
      $post_content = $row['student_email'];
      $image = $row['student_image'];
  } 
}

if(isset($_POST['update_post']))
  {
    $my_post_title=$_POST['user_firstname'];
    $my_post_author=$_POST['user_lastname'];
    $my_post_user = $_POST['username'];
    $my_post_title = mysqli_real_escape_String($connection,$my_post_title);
    $my_post_author = mysqli_real_escape_String($connection,$my_post_author);
    $my_post_user = mysqli_real_escape_String($connection,$my_post_user);
    $my_post_content = $_POST['user_email'];
    $my_post_status=$_POST['user_password'];
    if($role_name == "Teacher")
    {  
      $new_mobile = $_POST['phone'];
    }   

    $status = $_POST['toggle'];
    $date = date('Y-m-d');

    if($_FILES['profileImage']['name'])
    {
      $path=$_FILES['profileImage']['name']; 
      $ext = pathinfo($path, PATHINFO_EXTENSION);
      $profileImageName =  time().$post_title.'.'.$ext;
      $target_dir = "app/img/user/";
      $target_file = $target_dir . basename($profileImageName);
      // echo $target_file;
      // exit();
      
      if($_FILES['profileImage']['size'] > 500000)
      {
        $error = "Image size should not be greated than 500Kb";
        $msg_class = "alert-danger";
      }
      else
      {
        if(move_uploaded_file($_FILES["profileImage"]["tmp_name"],$target_file))
        {
          if($role_name == "Teacher")
          {   
            $query="update teachers set teacher_image= '$profileImageName',teacher_firstname='$my_post_title', teacher_lastname='$my_post_author',teacher_username='$my_post_user',teacher_email='$my_post_content', teacher_password='$my_post_status',teacher_phone= '$new_mobile',
            status = $status, updated_date='$date' 
            where teacher_username='$post_user'";
          }
          else
          {
            $role_id=2;
            $query="update students set student_image= '$profileImageName',student_firstname='$my_post_title', student_lastname='$my_post_author',student_username='$my_post_user',student_email='$my_post_content', student_password='$my_post_status',
            status = $status, updated_date='$date',role_id=$role_id 
            where student_username='$post_user'";
          }
          if(mysqli_query($connection, $query))
          {
            $msg = "Updated successfully with file";
            $msg_class = "alert-success";
              header("Refresh:1");
          }
          else 
          {
            $error= "There was an error in the database";
            $msg_class = "alert-danger";
          }
        }
      }
    }
    else
    {
      if($role_name == "Teacher")
      { 
        $query="update teachers set teacher_firstname='$my_post_title', teacher_lastname='$my_post_author',teacher_username='$my_post_user',teacher_email='$my_post_content', teacher_password='$my_post_status',teacher_phone= '$new_mobile',
        status = $status, updated_date='$date' 
        where teacher_username='$post_user'";
      }
      else
      {
        
        $query="update students set student_firstname='$my_post_title', student_lastname='$my_post_author',student_username='$my_post_user',student_email='$my_post_content', student_password='$my_post_status',
        status = $status, updated_date='$date'
        where student_username='$post_user'";
      }
      if(mysqli_query($connection, $query))
      {
        $msg = "Updated successfully  asds";
        $msg_class = "alert-success";
        header("Refresh:1");
      }
      else
      {
        $error= "There was an error in the database";
        $msg_class = "alert-danger";
      }
    }
  }
?>
      <section>
         <!-- START Page content-->
         <div class="content-wrapper">
            <h3>
               <div class="pull-right text-center">  
                 <a href="profile.php" ><button type="button"  class="btn btn-danger fa fa-arrow-left  btn-sm float-right" style="float: right;">  Go Back</button></a>
               </div>Update Profile
            </h3>
      <div class="row">
               <!-- START dashboard main content-->
         <section class="col-md-12">
           <form action="" method="post" enctype="multipart/form-data">
            <div class="panel panel-default">
               <div class="panel-body">
                  <div class="row">
                     <div class="col-md-4">
                        <!-- START widget-->
                        <br><br>
                        <div class="form-group">
                  <?php if (!empty($msg)): ?>
                  <div class="alert <?php echo $msg_class ?>" role="alert">
                       <?php echo $msg; ?>
                  </div>
                        <?php endif; ?>
                        <?php if (!empty($error)): ?>
                  <div class="alert <?php echo $msg_class ?>" role="alert">
                        <?php echo $error; ?>
                  </div>
                        <?php endif; ?>
                  <div class="form-group text-center" style="position: relative;" >
                  <span class="img-div">
                     <div class="text-center img-placeholder"  onClick="triggerClick()">
                      </div>

                           <?php 
                           if($role_name == "Teacher")
                           {
                           $results = mysqli_query($connection, "SELECT teacher_image FROM teachers where teacher_id = $i_id");
                           // echo "SELECT teacher_image FROM teachers where teacher_id = $i_id";
                           // exit();
                            $users = mysqli_fetch_all($results, MYSQLI_ASSOC);
                              foreach ($users as $user):
                              ?>
                             <img src="<?php if($user['teacher_image']){ echo 'app/img/user/' . $user['teacher_image'];}else { echo 'app/img/user/' .'avatar.jpg';}?>" width="200" height="200" alt="" onClick="triggerClick()" id="profileDisplay">
                              <?php endforeach; 
                            }
                            else
                            {
                              $results = mysqli_query($connection, "SELECT student_image FROM students where student_id = $i_id");
                            $users = mysqli_fetch_all($results, MYSQLI_ASSOC);
                              foreach ($users as $user):
                              ?>
                             <img src="<?php if($user['student_image']){ echo 'app/img/user/' . $user['student_image'];}else { echo 'app/img/user/' .'avatar.jpg';} ?>" width="190" height="190" alt="" onClick="triggerClick()"  id="profileDisplay">
                              <?php endforeach; 
                            }?>
                    </span>       
                     <input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" value="<?php echo $user['teacher_image']; ?>" class="form-control" style="display: none;">   
                  </div>
                 <!--  <div class="form-group">
                    <input type="file" name="profileImage">
                  </div> -->
              </div>
                     </div>
                     <div class="col-md-8">
                        <br><br>
                        <!-- START widget-->
                           
            
                                <div class="form-group">
                                     <label for="fname">Firstname <strong style="font-size: 18px;color: red;">*</strong> :</label>
                                      <input type="text" name="user_firstname" id="" class="form-control" value="<?php if(isset($post_title)){ echo $post_title ;}?>" aria-describedby="helpId">
                                </div>
                                <div class="form-group">
                                    <label for="lname">Lastname <strong style="font-size: 18px;color: red;">*</strong> :</label>
                                    <input type="text" name="user_lastname" id="" class="form-control" value="<?php if(isset( $post_author)){ echo  $post_author ;}?>" aria-describedby="helpId">
                                </div>
                                <div class="form-group">
                                    <label for="lname">Username <strong style="font-size: 18px;color: red;">*</strong> :</label>
                                    <input type="text" name="username" id="" class="form-control" value="<?php if(isset( $post_user)){ echo  $post_user ;}?>" aria-describedby="helpId">
                                </div>
                                <div class="form-group">
                                    <label for="fname">Email <strong style="font-size: 18px;color: red;">*</strong> :</label>
                                    <input type="email" name="user_email" id="" class="form-control" value="<?php if(isset( $post_content)){ echo  $post_content ;}?>" aria-describedby="helpId">
                                </div>
                                <div class="form-group">
                                    <label for="fname">Password <strong style="font-size: 18px;color: red;">*</strong> :</label>
                                    <input type="password" name="user_password" id="txtPassword" class="form-control" value="<?php if(isset( $post_status)){ echo  $post_status ;}?>" aria-describedby="helpId" required="password">
                                </div>
                               
                              <div class="form-group">
                                <?php if($role_name == "Teacher")
                              { ?>
                                   <label for="lname">Moblie number :</label>
                                    <input type="number" name="phone" id="" class="form-control" value="<?php if(isset( $new_mobile)){ echo  $new_mobile ;}?>" aria-describedby="helpId">
                                    <?php
                                      }?>
                                    <input type="hidden" checked data-toggle="toggle" data-style="ios" name="toggle" value=1>
                              </div>
                               
                        <div class="form-group">
                          <div class="row">
                            <div class="clearfix text-center">
                              <a href="profile.php"><button type="button"  class="btn btn-danger">Cancel</button></a>
                              <input type="submit" name="update_post" class="btn btn-primary"  value="Save" >
                            </div>
                          </div> 
                        </div>
                     
                    </div>
                  </div>
               </div>
            </div>
             </form>
          </section>
               
              
               <!-- END dashboard sidebar-->
            </div>
         </div>
         <!-- END Page content-->
      </section>
      <!-- END Main section-->
 <script type="text/javascript">
    function triggerClick(e) {
  document.querySelector('#profileImage').click();
}
function displayImage(e) {
   console.log('asdsad');
  if (e.files[0]) {
   console.log(e.files[0]);
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}
 </script>
   <!-- END Main wrapper-->
   <!-- START Scripts-->
   <!-- Main vendor Scripts-->
   <?php include "footer.php";?>