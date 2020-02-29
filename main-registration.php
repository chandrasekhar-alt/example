 <?php
session_start();     
   ?>  
   <!DOCTYPE html>
<html lang="en">
<?php ob_start()?>
<head>
<?php
$connection = mysqli_connect("localhost","root","","school");
?>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Blog Home - Start Bootstrap Template</title>
            <link rel="stylesheet" href="main.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
           <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
            <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
         <!-- pagination -->
          <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
  
          <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
  <style>

        .footer {
           position: fixed;
           left: 0;
           bottom: 0;
           width: 100%;
           color: white;
           text-align: center;
        }
        .navbar-fixed-left {
        width: 140px;
        position: fixed;
        border-radius: 0;
        height: 100%;
        }

        .navbar-fixed-left .navbar-nav > li {
        float: none;  /* Cancel default li float: left */
        width: 139px;
        }

        .navbar-fixed-left + .container {
        padding-left: 160px;
        }

        /* On using dropdown menu (To right shift popuped) */
        .navbar-fixed-left .navbar-nav > li > .dropdown-menu {
        margin-top: -50px;
        margin-left: 70px;
        }
  </style>
</head>
<body>
 <div class="container">
    <div class="text-center">
             <label><h1>Registration</h1></label>
     </div>
  <div class="row">
    <div class="col-md-4" id="form">   
        <?php
              echo '<a href="registration.php?Teacher"> <center><img class="img-responsive" src="teacher.jpg" alt="pic"></center>
            </a>';
            ?>
         <label style="padding-left: 150px; "><strong>Teacher</strong></label>  
      </div>
  <div class="col-md-4" id="form">     
      <?php
      echo '<a href="registration.php?Student"> <center><img class="img-responsive" src="student.jpeg" alt="pic"></center>
      </a>';
      ?>       
      <label style="padding-left: 150px; "><strong>Student</strong></label>
  </div>
<div class="col-md-4" id="form">    
       <?php
        echo '<a href="registration.php?parent"> <center><img class="img-responsive" src="parent.jpg" alt="pic"></center>
        </a>';
        ?>
         <label style="padding-left: 150px; "><strong>parent</strong></label>  
    </div>
  </div>
</div>
<div class="row">
  <div class="text-center">
      <?php
        echo '<a href="login-form.php"><button type="button" style="margin-top: 80px;" class="btn btn-danger fa fa-arrow-left"> Go back</button></a>';
        ?>
  </div>
</div>
           <?php
          unset($_SESSION["error"]);
          ?>
          

<style type="text/css">
  .img-responsive{
    background-color: lightgrey;
                width: 300px;
                height: 200px;
  }

</style>