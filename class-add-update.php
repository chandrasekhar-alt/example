<?php
include "header.php";
// $connection = mysqli_connect("localhost","root","","school");
//include "session.php";
include "left-navbar.php";

     $num=0;
        $Formname='Create ';
        if(isset($_GET['edit']))
        {
          $num =1;
          $Formname='Update ';
        $class_id =$_GET['edit'];
        $query = "SELECT distinct class_id,class_name,s.subject_id,subject_name,t.teacher_id,teacher_username FROM class  c
        join subjects s ON c.subject_id = s.subject_id 
        join teachers t ON  c.teacher_id = t.teacher_id where class_id = $class_id";
        // echo $query;

            $select_events = mysqli_query($connection,$query);  

            while($row = mysqli_fetch_assoc($select_events)) {
           $class_id = $row['class_id'];
         $class_name = $row['class_name'];
          $class_name = mysqli_real_escape_String($connection,$class_name);
          $subject_id = $row['subject_id'];
          $subject_name = $row['subject_name'];
          $teacher_id = $row['teacher_id'];
         $teacher_username = $row['teacher_username'];
        
      } 
     }
       if(isset($_POST['updat_post']))
          {
           $my_class_name=$_POST['class_name'];
           $my_teacher_username=$_POST['teacher_username'];
     
           $my_subject_name=$_POST['subject_name'];
    
          //  echo $my_post_title."<br>";
          // echo $my_post_user;
          //    exit();
          if($num == 1)
          {
            $query = "update class set class_name='$my_class_name',teacher_id= $my_teacher_username,subject_id= $my_subject_name where class_id = $class_id";
               // echo $query;
           // exit();
              $update_query = mysqli_query($connection,$query);
              if(!$update_query)
              {
                die("query faild..".mysqli_error($connection));
              }
               $_SESSION['msg']='updated successfully';
                header("Location: class-datatable.php");
          }
          else
          {
              if( $my_class_name==""|| empty($my_class_name) || $my_teacher_username==""|| empty($my_teacher_username) || $my_subject_name==""|| empty($my_subject_name) )
            {
            echo "this feild should not empty";
            }
          else
          {
            $query="insert into class (class_name,teacher_id,subject_id) ";
            $query .="values('$my_class_name',$my_teacher_username,$my_subject_name)";
            $result_query=mysqli_query($connection,$query);

            if(!$result_query)
            {
                die("query faild..".mysqli_error($connection));
            }
             $_SESSION['msg']='Added successfully';
            header("Location: class-datatable.php");
          }
            
       }
                    
    }?> 

      <!-- END aside-->
      <!-- START Main section-->
      <section>
         <!-- START Page content-->
         <div class="content-wrapper">
            <h3><?php echo $Formname.'Class'; ?>
            </h3>
            <!-- START row-->
            <div class="row">
               <div class="col-lg-8">
                  <div data-toggle="play-animation" data-play="fadeIn" data-offset="0" class="panel panel-dark panel-flat">
             <form method="post"  data-parsley-validate="" novalidate="">
                     <!-- START panel-->
                     <div class="panel-body">
                           <div class="form-group">
                              <label class="control-label">Class name *</label>
                              <input type="text" value="<?php if(isset($class_name)){ echo $class_name ;}?>"  name="class_name" required class="form-control">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Teacher name *</label>
                              <?php
                              $select_query = "Select teacher_id,teacher_username from teachers";
                              $select_query_run = mysqli_query($connection, $select_query);
                                                                            
                              echo "<select required name = 'teacher_username' class = 'form-control' >";
                               if($num == 1)                                                                         
                               {
                                echo "<option value='".$teacher_id."'>".$teacher_username."</option>";
                               }
                               else 
                               {
                                echo "<option value=''>Select teacher name</option>";
                               }
                                   
                              while   ($select_query_array=   mysqli_fetch_assoc($select_query_run) )
                              {
                              echo "<option value='".$select_query_array['teacher_id']."' >".$select_query_array['teacher_username']."</option>";                        
                              }
                              echo "</select>";
                              ?>
                             <!--  <input id="id-password" type="text" value="<?php //if(isset( $post_author)){ echo  $post_author ;}?>" name="purpose" required class="form-control"> -->
                           </div>
                           <div class="form-group">
                              <label class="control-label">Subject name *</label>
                              <?php
                              $select_sub_query = "Select subject_id,subject_name from subjects";
                              $select_subquery = mysqli_query($connection, $select_sub_query);

                              echo "<select required name ='subject_name' class = 'form-control' >";
                              if($num == 1)
                             {
                              echo "<option value='".$subject_id."'>".$subject_name."</option>";
                            }
                            else
                            {
                               echo "<option value=''>Select subject name</option>";
                            }
                              while   ($select_subquery_array=   mysqli_fetch_assoc($select_subquery) )
                              {
                              echo "<option value='".$select_subquery_array['subject_id']."' >".$select_subquery_array['subject_name']."</option>";                        
                              }
                              echo "</select>";
                              ?>
                              
                           </div>
                           
                     
                        </div>
                           <div class="panel-footer">
                           <div class="clearfix text-center ">
                           <!--  <div class="pull-right col-md-6"> -->
                                 <a href="class-datatable.php"><button type="button" class="btn btn-danger  btn-md">Cancel</button></a>
                              <!-- </div> -->
                             <!--  <div class="pull-right col-md-6"> -->
                                 <input type="submit" style="clear: center" name="updat_post" class="btn btn-primary  btn-md" value="Save">
                               </div>
                           </div>
                     <!-- END panel-->
                  </form>
         </div>
               </div>
                </div>
         <!-- END Page content-->
      </section>
      <!-- END Main section-->
  
   <script src="vendor/jquery/dist/jquery.min.js"></script>
 <!--   <script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script> -->
   <script src="vendor/parsleyjs/dist/parsley.min.js"></script>  
   <!-- END Main wrapper-->
   <!-- START Scripts-->
   <!-- Main vendor Scripts-->
  <?php include "footer.php" ?>