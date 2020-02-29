<?php include "header.php";
//include "session.php";
//session_start();
//echo 'ss';
include "left-navbar.php";
$name= $_SESSION['username'];                

 ?>
      <!-- End aside-->
      <!-- START aside-->
     
      <!-- END aside-->
      <!-- START Main section-->
      <section>
         <!-- START Page content-->
         <div class="content-wrapper">
            <h3>Classes
              <?php if($role_name == "Teacher")
                {
                 ?>
                <a href="class-add-update.php" ><button type="button"  class="btn btn-success  btn-sm float-right fa fa-plus" style="float: right;"> Add Class</button></a>
                <?php } ?>
            </h3>
            <!-- START DATATABLE 1 -->
            <div class="row">
               <div class="col-lg-12">
                  <div class="panel panel-default">
                     
                     <div class="panel-body">
                      <?php
                        if(isset($_SESSION['msg'])){
                        $error = $_SESSION['msg'];?>
                        <div class="alert alert-success alert-dismissable">
                           <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>  <?php  echo "<center> $error </center>"; 
                                ?>
                            </div>
                        <?php }
                         if(isset($_SESSION['error'])){
                        $error = $_SESSION['error'];?>
                        <div class="alert alert-success alert-dismissable">
                           <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>  <?php  echo "<center> $error </center>"; 
                                ?>
                            </div>
                        <?php }
                         unset($_SESSION["error"]);
                        ?>
                        <table id="datatable1" class="table table-striped table-hover">
                           <thead>
                              <tr>
                                 <td>Class Name</td>
                                <td>Teacher Name</td>
                                <td>Subject Name</td>
                                <?php 
                              if($role_name == "Teacher")
                                {
                               ?>
                                <td>Actions</td>
                                <?php }else{ ?>
                                  <td>Teacher email</td>
                               <?php } ?>
                              </tr>
                     </thead>
                   <tbody>
                  <?php 
                  if($role_name == "Teacher")
                    { 
                        $query="SELECT DISTINCT class_name,class_id,teacher_username,teacher_email,subject_name FROM class  
                        join subjects ON class.subject_id = subjects.subject_id 
                        join teachers ON  class.teacher_id = teachers.teacher_id 
                         order by class_name";
                     }
                     else
                     {

                       $my_query="SELECT class_name from class join students on class.class_id=students.class_id WHERE student_username='$name'";
                      $results = mysqli_query($connection,$my_query);
                      while($row = mysqli_fetch_assoc($results))
                       {
                         $class = $row['class_name'];
                       }
                        $query="SELECT class_name,class_id,teacher_username,teacher_email,subject_name FROM class  
                        join subjects ON class.subject_id = subjects.subject_id 
                        join teachers ON  class.teacher_id = teachers.teacher_id 
                         order by class_name";
                             }
                        // echo $query;
                        // exit();
                     $results = mysqli_query($connection,$query);
                      while($row = mysqli_fetch_assoc($results))
                       {
                        $class_id=$row['class_id'];
                        $class_name=$row['class_name'];
                        $teacher_username=$row['teacher_username'];
                        $teacher_email =$row['teacher_email'];
                        $subject_name=$row['subject_name'];
                         $_SESSION['my_class']= $class_id;
                         echo "<tr>";
                           //echo "<td> $post_id</td>";
                           echo "<td> $class_name</td>";
                           echo "<td> $teacher_username</td>";
                           echo "<td> $subject_name</td>";
                           if($role_name == "Teacher")
                            {?>
                          <td>
                            <a 
                            href="<?php echo 'class-datatable.php?delete='.$class_id.'' ?>" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash"></i></a>&nbsp; &nbsp;
                            <a href="<?php echo 'view-students.php?view='.$class_id.'' ?>"><i class="fa fa-eye"></i></a> &nbsp; &nbsp;
                            <a href="<?php echo 'class-add-update.php?edit='.
                            $class_id.'' ?>"><i class="fa fa-edit"></i></a></td>
                        
                        <?php
                           }
                           else
                           {
                              echo "<td> $teacher_email</td>";
                           }
                         echo "</tr>";  
                         }
                             if(isset($_GET['delete']))
                         {
                            $post_id=$_GET['delete'];
                            $query = "delete from class where class_id =  $class_id";
                            // echo $query;
                            // exit();
                            $delete_query = mysqli_query($connection,$query);
                            $_SESSION['error']='Deleted successfully';
                            header("Location: class-datatable.php");
                         }
                      if(isset($_GET['edit']))
                      {
                          $class_id = $_GET['edit'];
                          
                           }

                           if(isset($_GET['view']))
                      {
                          $class_id = $_GET['view'];
                          
                           }

                      ?>
                              
                           </tbody>
                        </table>

                     </div>
                  </div>
               </div>
            </div>
            
            <!-- END DATATABLE 3-->
         </div>
         <!-- END Page content-->
      </section>
      <!-- END Main section-->
 
   <!-- END Main wrapper-->
   <!-- START Scripts-->
   <!-- Main vendor Scripts-->
              <?php
             unset($_SESSION["msg"]);
             ?>
   <?php include  "footer.php"; ?>