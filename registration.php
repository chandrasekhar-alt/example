<?php 
$connection = mysqli_connect("localhost","root","","school");
session_start();      

if(isset($_POST['Register']))
{
  $username=$_POST['username'];
  $username = trim($username);
  $user_firstname=$_POST['user_firstname'];
  $user_lastname=$_POST['user_lastname'];
   $user_email=$_POST['user_email'];
  $user_password=$_POST['user_password'];
  $user_phone=$_POST['phone'];
  $user_toggle=$_POST['post_status'];
  $date = date('Y-m-d');


     //mail sending//
     $to = $_POST['user_email'];
   include "mail.php";
     //mail sending//

                  if(isset($_GET['Teacher']))
                  { 
                    $role_id = 1;

                    $query="insert into teachers(teacher_username,teacher_firstname,teacher_lastname,teacher_password,teacher_email,teacher_phone,status,role_id,created_date)";

                    $query .="values('{$username}','{$user_firstname}','{$user_lastname}','{$user_password}','{$user_email}','{$user_phone}',{$user_toggle},{$role_id},'$date')";
                        // echo $query;
                        // exit(); 

                    $result_query=mysqli_query($connection,$query);
                    
                   $error='select valid username in registration form.';
                    if(!$result_query)
                    {
                        $_SESSION['error']=$error;
                        // die("query faild..".mysqli_error($connection));

                        header("Location: login-form.php");
                    }
                    else
                    {
                       $_SESSION['error1']='registration successful..';
                       header("Location: login-form.php");
                    }
                    
                }
                elseif (isset($_GET['Student']))
                 {
                  
            $role ="Student"; 
            $role_id = 2;
           
            $query="insert into students(student_username,student_firstname,student_lastname,student_password,student_email,status,role_id,created_date)";
            $query .="values('{$username}','{$user_firstname}','{$user_lastname}','{$user_password}','{$user_email}',{$user_toggle},{$role_id},'$date')";
             //   echo $query;
             // exit();
             $result_query=mysqli_query($connection,$query);
            $error1='select valid username in registration form.';
            if(!$result_query)
            {
                $_SESSION['error']=$error1;
                // die("query faild..".mysqli_error($connection));

                header("Location: login-form.php");
            }
            else
            {
              $_SESSION['error1']='registration successful..';
              header("Location: login-form.php");
            }
            
                }

             }
              ?>

<!DOCTYPE html>
<html lang="en" class="no-ie">
<!--<![endif]-->

<head>
   <!-- Meta-->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
   <meta name="description" content="">
   <meta name="keywords" content="">
   <meta name="author" content="">
   <title>BeAdmin - Bootstrap Admin Theme</title>
   <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries-->
   <!--[if lt IE 9]><script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script><script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->
   <!-- Bootstrap CSS-->
   <link rel="stylesheet" href="app/css/bootstrap.css">
   <!-- Vendor CSS-->
   <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
   <link rel="stylesheet" href="vendor/animo.js/animate-animo.css">
   <!-- App CSS-->
   <link rel="stylesheet" href="app/css/app.css">
   <link rel="stylesheet" href="app/css/common.css">
   <!-- Modernizr JS Script-->
   <script src="vendor/modernizr/modernizr.custom.js" type="application/javascript"></script>
   <!-- FastClick for mobiles-->
   <script src="vendor/fastclick/lib/fastclick.js" type="application/javascript"></script>
</head>

<body>
   <!-- START wrapper-->
   
         
         <!-- START panel-->
         <div class="row row-table page-wrapper">
      <div class="col-lg-3 col-md-6 col-sm-8 col-xs-12 align-middle">
         <?php if(isset($_SESSION['error'])){
                $error = $_SESSION['error'];?>
                <div class="alert alert-danger" role="alert">
                <?php  echo "<center> $error </center>"; 
               ?>
              </div>
                   <?php  }?>
         <div data-toggle="play-animation" data-play="fadeIn" data-offset="0" class="panel panel-dark panel-flat">
            <div class="panel-heading text-center mb-lg">
               <a href="#">
                   <img src="app/img/sixthblock2.png" width="210" alt="Image" class="block-center img-rounded">
               </a>
               <p class="text-center mt-lg">
                  <strong>SIGNUP TO GET INSTANT ACCESS.</strong>
               </p>
            </div>
            <!-- <div class="panel panel-default"> -->
             <form method="post"  data-parsley-validate="" novalidate="">
                     <!-- START panel-->
                          <!--  <div class="panel-title text-center"><h3>Form Register</h3></div> -->
                        <div class="panel-body">
                           <div class="form-group">
                              <label class="control-label">Firstname *</label>
                              <input type="text" name="user_firstname" required class="form-control">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Lastname *</label>
                              <input type="text" name="user_lastname" required class="form-control">
                           </div>
                            <div class="form-group">
                              <label class="control-label">Username *</label>
                              <input type="text" name="username" required class="form-control">
                           </div>
                            <div class="form-group">
                              <label class="control-label">Email Address *</label>
                              <input type="text"  name="user_email" required class="form-control">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Password *</label>
                              <input id="id-password" type="password" name="user_password" required class="form-control">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Confirm Password *</label>
                              <input type="password" name="confirmPassword" required data-parsley-equalto="#id-password" class="form-control">
                           </div>
                            <div class="form-group">
                              <label class="control-label">Mobile *</label>
                              <input type="text" name="phone" required class="form-control">
                           </div>
                           <input type="hidden" checked data-toggle="toggle" data-style="ios" name="post_status" value=1>
                           <div class="text-right mb-sm"><a href="login-form.php" class="text-muted">Need to Signin?</a>
                        </div>
                        <div class="panel-footer">
                           <div class="clearfix text-center">
                              <!-- <div class="pull-right"> -->
                                 <input type="submit" name="Register" class="btn btn-primary" value="Register">
                              <!-- </div> -->
                           </div>
                        </div>
                     </div>
                     <!-- END panel-->
                  </form>
<!--          </div> -->
         <!-- END panel-->
      </div>
   </div>
 </div>
   <!-- END wrapper-->
   <!-- START Scripts-->
   
   <!-- Main vendor Scripts-->
    <script src="vendor/screenfull/dist/screenfull.min.js"></script>
   <script src="vendor/jquery/dist/jquery.min.js"></script>
   <script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
   <script src="vendor/parsleyjs/dist/parsley.min.js"></script>   
   <script src="vendor/jquery/dist/jquery.min.js"></script>
   <script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
   <!-- Animo-->
   <script src="vendor/animo.js/animo.min.js"></script>
   <!-- Custom script for pages-->
   <script src="app/js/pages.js"></script>
   <!-- END Scripts-->
</body>

</html>