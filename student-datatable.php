<?php include "header.php";
include "left-navbar.php";
//include "session.php";
//session_start();

 $r_id = $_SESSION['role_id'];
                                  
    $query ="select role_name from roles where role_id =  $r_id";
    $results = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($results))
    {
     $role_name = $row['role_name'];
    }
 ?>
      <!-- End aside-->
      <!-- START aside-->
     
      <!-- END aside-->
      <!-- START Main section-->
      <section>
         <!-- START Page content-->
         <div class="content-wrapper">
            <h3>Students
                  <?php if($role_name == "Teacher")
                      {
                     ?>
                <a href="student-add-update.php" ><button type="button"  class="btn btn-success  btn-sm float-right fa fa-plus" style="float: right;">  Add Student</button></a>
                <?php } ?>
            </h3>
            <!-- START DATATABLE 1 -->
            <div class="row">
               <div class="col-lg-12">
                  <div class="panel panel-default">
                     <div class="panel-body">
                       <?php
                        if(isset($_SESSION['error'])){
                        $error = $_SESSION['error'];?>
                        <div class="alert alert-success alert-dismissable">
                           <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button> 
                            <?php  echo "<center> $error </center>"; 
                           ?> 
                        </div>
                       <?php }
                        if(isset($_SESSION['msg'])){
                        $error = $_SESSION['msg'];?>
                        <div class="alert alert-success alert-dismissable">
                           <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>  <?php  echo "<center> $error </center>"; 
                                ?>
                            </div>
                        <?php }
                        unset($_SESSION["error"]);?>
                        <table id="datatable1" class="table table-striped table-hover">
                           <thead>
                              <tr>
                                 <td>Student Firstname</td>
                                  <td>Student Lastname</td>
                                  <td>Student Email</td>
                                  <td>Student Status</td>
                                  <?php 
                                  if($role_name == "Teacher")
                                    {
                                    ?>
                                  <td>Actions</td>
                                  <?php } ?>
                             </tr>
                           </thead>
                           <tbody>
                              <?php  
  
                        $query="select * from students ";
                       $results = mysqli_query($connection,$query);
                     
                        while($row = mysqli_fetch_assoc($results))
                       {
                        $student_id=$row['student_id'];
                        $student_firstname=$row['student_firstname'];
                        $student_lastname=$row['student_lastname'];
                        $student_email=$row['student_email'];
                         $status=$row['status'];
                         $created_date=$row['created_date'];
                         $edate=strtotime($created_date); 
                            $edate=date("d-m-Y",$edate); 
                         if( $status == 0)
                         {
                          $status ='Inactive';
                         }
                         else
                         {
                          $status ='Active';
                         }
                         ?>
                         <tr>
                         <!-- <td><?php //echo  $post_id;?></td> -->
                          <td><?php echo  $student_firstname;?></td>
                          <td><?php echo  $student_lastname;?></td>
                          <td><?php echo $student_email;?></td>
                          <!-- <td><?php// echo $status;?></td> -->
                          <td><?php 
                            if($status =='Active')
                            {
                             
                          echo '<span class="label label-success">'.$status.'</span>';
                          }
                          else
                          {
                            echo '<span class="label label-danger">'.$status.'</span>';
                          }

                             ?>
                                <?php 
                                  if($role_name == "Teacher")
                                    {
                                    ?>
                             </td>
                           <!-- <td><?php// echo $edate;?></td> -->
                         <td><a 
                            href="<?php echo 'student-datatable.php?delete='.$student_id.'' ?>" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash"></i></a> &nbsp; &nbsp;
                            <a href="<?php echo 'student-add-update.php?edit='.
                            $student_id.'' ?>"><i class="fa fa-edit"></i></a></td>
                        </tr> 
              
                      <?php 
                    }
                      } 
                     if(isset($_GET['delete']))
                     {
                        $my_student_id=$_GET['delete'];
                        $query = "delete from students where student_id =  $my_student_id";
                        $delete_query = mysqli_query($connection,$query);
                        $_SESSION['error']='Deleted successfully';
                        header("Location: student-datatable.php");
                     }


                    ?>
                    <?php
                    if(isset($_GET['edit']))
                    {
                        $post_id = $_GET['edit'];
                        
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
 include "footer.php"; ?>