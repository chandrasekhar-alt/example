<?php
include "header.php";
include "left-navbar.php";
//include "session.php";
$r_id = $_SESSION['role_id'];                             
    $query ="select role_name from roles where role_id =  $r_id";
    $results = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($results))
    {
     $role_name = $row['role_name'];
    }             
              if($role_name == "Teacher")
               {
               $query="SELECT * FROM `teachers` WHERE teacher_id=$i_id";
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
            }
              else
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
?>


      <!-- End aside-->
      <!-- START aside-->
   
      <!-- END aside-->
      <!-- START Main section-->
      <section>
         <!-- START Page content-->
         <div class="content-wrapper">
            <h3>
               <div class="pull-right text-center">
               <a href="profile-update.php" ><button type="button"  class="btn btn-success fa fa-edit  btn-sm float-right" style="float: right;">   Update</button></a>
               </div>Profile
            </h3>
            <!-- <div data-toggle="notify" data-onload data-message="&lt;b&gt;Login successful!&lt;/b&gt;Hi user, Welcome to School Managment." data-options="{&quot;status&quot;:&quot;success&quot;, &quot;pos&quot;:&quot;top-right&quot;}" class="hidden-xs"></div> -->
      <div class="row">
               <!-- START dashboard main content-->
         <section class="col-md-12">
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
                             <img src="<?php if($user['teacher_image']){ echo 'app/img/user/' . $user['teacher_image'];}else { echo 'app/img/user/' .'avatar.jpg';}?>" width="200" height="200" alt=""  id="profileDisplay">
                              <?php endforeach; 
                            }
                            else
                            {
                              $results = mysqli_query($connection, "SELECT student_image FROM students where student_id = $i_id");
                            $users = mysqli_fetch_all($results, MYSQLI_ASSOC);
                              foreach ($users as $user):
                              ?>
                             <img src="<?php if($user['student_image']){ echo 'app/img/user/' . $user['student_image'];}else { echo 'app/img/user/' .'avatar.jpg';}?>" width="190" height="190" alt=""  >
                              <?php endforeach; 
                             
                            }?>
                    </span>
                            
                           
                  </div>
              </div>
                     </div>
                     <div class="col-md-8">
                        <br><br>
                        <!-- START widget-->
                            <div class="form-group">
                                  <label for="fname">Fullname  :</label>
                                   <strong><?php if(isset($post_title)){ echo $post_title.$post_author ;}?></strong>
                             </div>
                             <div class="form-group">
                                 <label for="lname">Username  :</label>
                                <strong><?php if(isset( $post_user)){ echo  $post_user ;}?></strong>
                             </div>
                             <div class="form-group">
                                 <label for="fname">Email  :</label>
                                 <strong><?php if(isset( $post_content)){ echo  $post_content ;}?></strong>
                             </div>
                             <div class="form-group">
                                 <label for="fname">Password  :</label>
                                 <strong><?php if(isset( $post_status)){ echo  $post_status ;}?></strong>
                             </div>
                            
                           <div class="form-group">
                                   <?php if($role_name == "Teacher")
                                 { ?>
                                <label for="lname">Moblie number :</label>
                                 <strong><?php if(isset( $new_mobile)){ echo  $new_mobile ;}
                                   }?></strong>
                                 <input type="hidden" checked data-toggle="toggle" data-style="ios" name="toggle" value=1>
                           </div>
                            
       
                     </div>
                  </div>
               </div>
            </div>
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