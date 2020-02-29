<?php include "header.php";
include "left-navbar.php";
//include "session.php";
//session_start();
 ?>
      <!-- End aside-->
      <!-- START aside-->
           <?php 
               $class_id=$_GET['view'];
               $sql="SELECT class_name from class where class_id=$class_id";
               $result=mysqli_query($connection,$sql);
               while ($row = mysqli_fetch_assoc($result)) {
                    
                    $class_name = $row['class_name'];
              }
              ?>
      <!-- END aside-->
      <!-- START Main section-->
      <section>
         <!-- START Page content-->
         <div class="content-wrapper">
            <h3><?php echo  $class_name ;?> Students List
               <a href="class-datatable.php"><button type="button"  class="btn btn-danger fa fa-arrow-left btn-md float-right" style="float: right;">  Go back</button></a>
            </h3>
             <?php
                  if(isset($_SESSION['msg'])){
                  $error = $_SESSION['msg'];?>
              <div class="alert alert-success" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <?php  echo "<center> $error </center>"; 
                  }?>
              </div>
          
            <!-- START DATATABLE 1 -->
            <div class="row">
               <div class="col-lg-12">
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        
                     </div>
                     <div class="panel-body">
                        <table id="datatable1" class="table table-striped table-hover">
                           <thead>
                              <tr>
                                <td>Student Id</td>
                                <td>Student Firstname</td>
                                <td>Student Lastname</td>
                                <td>Student Username</td>
                                <td>Student Email</td>
                                <td>Status</td>
                              </tr>
                           </thead>
                           <tbody>
                              <?php  
                       if(isset($_GET['view']))
                      {
                        $class_id =$_GET['view'];
                       $query = "SELECT * FROM students where class_id = $class_id";
                    $select_events = mysqli_query($connection,$query);  

                    while($row = mysqli_fetch_assoc($select_events)) {
                   $student_id = $row['student_id'];
                   $student_firstname = $row['student_firstname'];
                   $student_lastname = $row['student_lastname'];
                   $student_username = $row['student_username'];
                   $student_email=$row['student_email'];
                   $status=$row['status'];
                   
                     if($status == 0)
                             {
                              $status ='Inactive';
                             }
                             else
                             {
                              $status ='Active';
                             }
                             
                             echo "<tr>";
                               echo "<td> $student_id</td>";
                               echo "<td> $student_firstname</td>";
                               echo "<td> $student_lastname</td>";
                               echo "<td> $student_username</td>";
                               echo "<td>$student_email</td>";
                                echo "<td>$status</td>";
                                echo "</tr>";
                              }
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
   </div>
   <!-- END Main wrapper-->
   <!-- START Scripts-->
   <!-- Main vendor Scripts-->
   <?php
            unset($_SESSION["msg"]);
             ?>
   <?php include  "footer.php" ?>