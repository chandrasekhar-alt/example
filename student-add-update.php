<?php
include "header.php";
include "left-navbar.php";
// $connection = mysqli_connect("localhost","root","","school");
//include "session.php";

$num=0;
 $Formname ='Add ';
$status='';
    if(isset($_GET['edit']))
    {
      $num=1;
      $Formname ='Update ';
      $event_id =$_GET['edit'];
     $query = "SELECT * FROM students where student_id = $event_id";
  $select_events = mysqli_query($connection,$query);  

  while($row = mysqli_fetch_assoc($select_events)) {
 $student_id = $row['student_id'];
 $student_firstname = $row['student_firstname'];
 $student_lastname = $row['student_lastname'];
 $student_username = $row['student_username'];
 $student_email=$row['student_email'];
 $status=$row['status'];
 $class_id = $row['class_id'];
 $query="SELECT class_name FROM class where class_id=$class_id";
  $class_results = mysqli_query($connection,$query);  

  while($row = mysqli_fetch_assoc($class_results))
   {
         $class_name=$row['class_name'];
  }
 
  } }?>
              <?php
                 if(isset($_POST['updat_post']))
                    {
                     
                     $my_class = $_POST['class_name'];
                     $student_firstname = mysqli_real_escape_String($connection,$_POST['student_firstname']);
                    $student_lastname = mysqli_real_escape_String($connection,$_POST['student_lastname']);
                   $student_username = mysqli_real_escape_String($connection,$_POST['student_username']);
                      $student_email = mysqli_real_escape_String($connection,$_POST['student_email']);
                   $status=isset($_POST['status'])?$_POST['status']:0;
                  
                       
                   
                 if($num == 1)
                 {
                      $query = "update students set student_firstname='$student_firstname',student_lastname='$student_lastname',student_username='$student_username',student_email='$student_email',status='$status',class_id=$my_class where student_id = $student_id";
                    // echo  $query;
                    // exit();
                        $update_query = mysqli_query($connection,$query);
                        if(!$update_query)
                        {
                          die("query faild..".mysqli_error($connection));
                        }
                         $_SESSION['msg']='updated successfully';
                          header("Location: student-datatable.php");
                 }
                 else
                  {
                        $date = date('Y-m-d');
                        $role_id=2;
                            
                              $query="insert into students(student_firstname,student_lastname,student_username,student_email,status,class_id,created_date,role_id) ";
                              $query .="values('$student_firstname','{$student_lastname}','{$student_username}','{$student_email}',{$status},$my_class,'$date',$role_id)";
                              $result_query=mysqli_query($connection,$query);
                              
                              if(!$result_query)
                              {
                                $_SESSION['msg']='select valid username';
                              header("Location: student-datatable.php");
                                  // die("query faild..".mysqli_error($connection));
                              }
                              $_SESSION['msg']='Added successfully';
                              header("Location: student-datatable.php");
                          
                      }     
                  
              }   
?>

      <!-- END aside-->
      <!-- START Main section-->
      <section>
         <!-- START Page content-->
         <div class="content-wrapper">
            <h3><?php echo $Formname.'Student Details'; ?>
            </h3>
            <!-- START row-->
            <div class="row">
               <div class="col-lg-8">
                  <div data-toggle="play-animation" data-play="fadeIn" data-offset="0" class="panel panel-dark panel-flat">
                <form method="post"  data-parsley-validate="" novalidate="">
                     <!-- START panel-->
                     <div class="panel panel-default">
                        <div class="panel-body">
                           <div class="form-group">
                              <label class="control-label">Student firstname *</label>
                              <input type="text" value="<?php if(isset($student_firstname)){ echo $student_firstname ;}?>" name="student_firstname" required class="form-control">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Student lastname *</label>
                              <input id="id-password" type="text" value="<?php if(isset( $student_lastname)){ echo  $student_lastname ;}?>" name="student_lastname" required class="form-control">
                           </div>
                          <div class="form-group">
                              <label class="control-label"> Student username *</label>
                              <input id="id-password" type="text" value="<?php if(isset($student_username)){ echo $student_username ;}?>" name="student_username" required class="form-control">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Student email *</label>
                              <input id="id-password" type="email" value="<?php if(isset( $student_email)){ echo  $student_email ;}?>" name="student_email" required class="form-control">
                           </div>
                           <div class="form-group">
                             <label class="control-label">Class *</label>
                           <?php
                            $select_query = "Select DISTINCT class_name,class_id from class order by class_name";
                            $select_query_run = mysqli_query($connection, $select_query);

                            echo "<select required name = 'class_name' class = 'form-control' >";
                             if($num == 1)
                             {
                              echo "<option value='".$class_id."'>".$class_name."</option>";
                             }
                             else 
                             {
                              echo "<option value=''>Select class name</option>";
                             }
                                 
                            while   ($select_query_array=   mysqli_fetch_assoc($select_query_run) )
                            {
                            echo "<option value='".$select_query_array['class_id']."' >".$select_query_array['class_name']."</option>";                        
                            }
                            echo "</select>";
                            ?>
                          </div>
                        <div class="form-group">
                           <label class="col-sm-2 control-label">Activation</label>
                           <div class="col-sm-10">
                              <label class="switch">
                                  <input type="checkbox" data-toggle="toggle" data-style="ios" id="status"
                                     name="status" <?php if($status){echo 'checked'; }?> value=1 >
                                 <span></span>
                              </label>
                           </div>
                        </div>
                     
                        </div>
                           <div class="panel-footer">
                           <div class="clearfix text-center">
                             <!--  <div class="pull-right col-md-6"> -->
                                
                             <!--  </div>
                               <div class="pull-left col-md-6"> -->
                                 <a href="student-datatable.php"><button type="button"  class="btn btn-danger">Cancel</button></a>
                              <!-- </div> -->
                               <input type="submit" name="updat_post" class="btn btn-primary" value="Save">
                           </div>
                        </div>
                     </div>
                     <!-- END panel-->
                  </form>
                 </div>
               </div>
               </div>
             </div>
         <!-- END Page content-->
      </section>
      <!-- END Main section-->
  
   <!--  <script src="vendor/screenfull/dist/screenfull.min.js"></script> -->
   <script src="vendor/jquery/dist/jquery.min.js"></script>
 <!--   <script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script> -->
   <script src="vendor/parsleyjs/dist/parsley.min.js"></script>   
  <!--  <script src="vendor/jquery/dist/jquery.min.js"></script> -->
   <!-- <script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script> -->
   <!-- END Main wrapper-->
   <!-- START Scripts-->
   <!-- Main vendor Scripts-->
  <?php include "footer.php" ?>