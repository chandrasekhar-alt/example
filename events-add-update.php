
<?php
include "header.php";
include "left-navbar.php";
// $connection = mysqli_connect("localhost","root","","school");
//include "session.php";

$num = '';
$post_status = '';
$formName= 'Create ';
if(isset($_GET['edit']))
{    
    $num = 1;
    $event_id =$_GET['edit'];
    $formName = 'Update ';
    $query = "SELECT * FROM events where event_id = $event_id";
    $select_events = mysqli_query($connection,$query);  

    while($row = mysqli_fetch_assoc($select_events))
    {
    $post_id = $row['event_id'];
    $post_title = $row['event_name'];
    $post_author = $row['event_purpus'];
    $post_user = $row['event_date'];
    $newDate_event = date("d-m-Y", strtotime($post_user));
    $post_content=$row['end_date'];
    $newDate_end=date("d-m-Y",strtotime($post_content));
    $post_status=$row['event_status']; 
  }
  }
  if(isset($_POST['submit']))
  {
    $my_post_title=$_POST['eventname'];
    $my_post_author=$_POST['purpose'];
     
    $my_post_title = mysqli_real_escape_String($connection,$my_post_title);
    $my_post_author = mysqli_real_escape_String($connection,$my_post_author);
    $edate=$_POST['startdate']; 
   //  echo $edate;
     $edate=date("Y-m-d",strtotime($edate));
    // exit();
    $my_edate=strtotime($_POST['enddate']); 
    $my_edate=date("Y-m-d",$my_edate);
    $my_post_status=isset($_POST['post_status'])?$_POST['post_status']:0;
   
   if($num == 1)
   {
    
    $query = "update events set event_name='$my_post_title',event_purpus='$my_post_author',event_date='$edate',end_date='$my_edate',event_status='$my_post_status' where event_id = $post_id";
    //echo $query;
          //exit();
      $update_query = mysqli_query($connection,$query);
      if(!$update_query)
        {
          die("query faild..".mysqli_error($connection));
        }
        $_SESSION['msg']='updated successfully';
        header("Location: events-datatable.php");
   }
   else
   {
     
         
          $query="insert into events(event_name,event_purpus,event_date,end_date,event_status) ";
          $query .="values('$my_post_title','{$my_post_author}','{$edate}','{$my_edate}','{$my_post_status}')";
          // echo $query;
          // exit();
          $result_query=mysqli_query($connection,$query);

          if(!$result_query)
          {
              die("query faild..".mysqli_error($connection));
          }
           $_SESSION['msg']='Added successfully';
          header("Location: events-datatable.php");
     
}
    

  }
?>

      <!-- END aside-->
      <!-- START Main section-->
      <section>
         <!-- START Page content-->
         <div class="content-wrapper">
            <h3><?php echo $formName.'Event'; ?>
            </h3>
            <!-- START row-->
            <div class="row">
               <div class="col-lg-8">
                  
                     <!-- START panel-->
            <div data-toggle="play-animation" data-play="fadeIn" data-offset="0" class="panel panel-dark panel-flat">
              <form method="post"  data-parsley-validate="" novalidate="">
                     <!-- START panel-->
                    <div class="panel panel-default">
                        <div class="panel-body">
                           <div class="form-group">
                              <label class="control-label">Event Name *</label>
                              <input type="text" value="<?php if(isset($post_title)){ echo $post_title ;}?>"  name="eventname" required class="form-control">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Purpose *</label>
                              <input id="id-password" type="text" value="<?php if(isset( $post_author)){ echo  $post_author ;}?>" name="purpose" required class="form-control">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Start Date *</label>
                              <div data-format="DD-MM-YYYY" class="datetimepicker input-group date mb-lg">
                              <input type='text' value="<?php if(isset( $newDate_event)){ echo  $newDate_event;}?>" name="startdate" required  class="form-control">
                              <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                 </span>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="control-label">End Date *</label>
                              <div data-format="DD-MM-YYYY" class="datetimepicker input-group date mb-lg">
                              <input type='text' value="<?php if(isset( $newDate_end)){ echo  $newDate_end;}?>" name="enddate" required  class="form-control">
                              <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                 </span>
                              </div>
                           </div>
                          
                        <div class="form-group">
                           <label class="col-sm-2 control-label">Activation</label>
                           <div class="col-sm-10">
                              <label class="switch">
                                  <input type="checkbox" data-toggle="toggle" data-style="ios" id="status"
                                     name="post_status" <?php if($post_status){echo 'checked'; }?> value=1 >
                                 <span></span>
                              </label>
                           </div>
                        </div>
                     
                        </div>
                           <div class="panel-footer">
                           <div class="clearfix text-center">
                              <!-- <div class="pull-right"> -->
                                 
                             <!--  </div>
                               <div class="pull-left"> -->
                                 <a href="events-datatable.php"><button type="button"  class="btn btn-danger">Cancel</button></a>
                             <!--  </div> -->
                             <input type="submit" name="submit" class="btn btn-primary" value="Save">
                           </div>
                        </div>
                        </div>
                        
                     <!-- END panel-->
                  </form>
         </div>
                     </div>
                     <!-- END panel-->
               </div>
               
         <!-- END Page content-->
      </section>
      <!-- END Main section-->
  <script src="vendor/jquery/dist/jquery.min.js"></script>
 <!--   <script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script> -->
   <script src="vendor/parsleyjs/dist/parsley.min.js"></script>  
   <!-- <style>
.toggle.ios, .toggle-Yes.ios, .toggle-No.ios { border-radius: 20px; }
.toggle.ios .toggle-handle { border-radius: 20px; }
</style> -->
   
   <!-- END Main wrapper-->
   <!-- START Scripts-->
   <!-- Main vendor Scripts-->
  <?php include "footer.php" ?>