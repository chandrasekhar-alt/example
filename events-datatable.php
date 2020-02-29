<?php
//include "session.php";
 include "header.php";
 include "left-navbar.php";
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
            <h3>Events
              <?php if($role_name == "Teacher")
                        {
                        ?>
                <a href="events-add-update.php" ><button type="button"  class="btn btn-success  btn-sm fa fa-plus float-right" style="float: right;">  Add Event</button></a>
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
                                 <th>Event Name</th>
                                 <th>Purpose</th>
                                 <th>Start Date</th>
                                 <th>End Date</th>
                                 <th>Status</th>
                                <?php if($role_name == "Teacher")
                                {
                               ?>
                                 <th>Actions</th>
                                <?php } ?>
                              </tr>
                           </thead>
                           <tbody>
                              <?php  
                        $query="select * from events";
                        $results = mysqli_query($connection,$query);
                       
                      while($row = mysqli_fetch_assoc($results))
                       {
                        $post_id=$row['event_id'];
                        $post_title=$row['event_name'];
                        $post_author=$row['event_purpus'];
                        $post_date=$row['event_date'];
                         $new = date("d/m/Y",strtotime($post_date));
                         $post_image=$row['end_date'];
                         $new_date=date("d/m/Y",strtotime($post_image));
                         $post_status=$row['event_status'];
                         if($post_status == 0)
                         {
                          $post_status ='Inactive';
                         }
                         else
                         {
                           $post_status ='Active';
                         }
                         
                        ?>
                        <tr>
                          <!-- <td><?php// echo $post_id       ?></td> -->
                          <td><?php echo $post_title    ?></td>
                          <td><?php echo $post_author   ?></td>
                          <td><?php echo $new           ?></td>
                          <td><?php echo $new_date      ?></td>
                          <td><?php 
                            if($post_status =='Active')
                            {
                             
                          echo '<span class="label label-success">'.$post_status.'</span>';
                          }
                          else
                          {
                            echo '<span class="label label-danger">'.$post_status.'</span>';
                          }

                             ?></td>
                             <?php if($role_name == "Teacher")
                               {
                               ?>
                          <td><a 
                            href="<?php echo 'events-datatable.php?delete='.$post_id.'' ?>" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash"></i></a> &nbsp; &nbsp;
                            <a href="<?php echo 'events-add-update.php?edit='.
                            $post_id.'' ?>"><i class="fa fa-edit"></i></a></td>
                        </tr>
                        
                         <?php 
                           } 
                         }
                         if(isset($_GET['delete']))
                         {
                            $post_id=$_GET['delete'];
                            $query = "delete from events where event_id =  $post_id";
                            $delete_query = mysqli_query($connection,$query);
                            $_SESSION['error']='Deleted successfully';
                            header("Location: events-datatable.php");
                         }
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
         
          <?php unset($_SESSION["msg"]);?>
      </section>
      <!-- END Main section-->

   <!-- END Main wrapper-->
   <!-- START Scripts-->
   <!-- Main vendor Scripts-->
   <?php
      
      include "footer.php"; ?>