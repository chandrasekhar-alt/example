<?php 
include "session.php";
$connection = mysqli_connect("localhost","root","","school");
             $db_uname ='';
             $db_password ='';
		 if(isset($_POST['Login']))
		{
			$Username = $_POST['Username'];
			$Username = trim($Username);
			$password = $_POST['password'];

			$radio = $_POST['name'];
			$error1 ='Invalid Username';
			$error11 ='Invalid Password';
		

			$Username = mysqli_real_escape_String($connection,$Username);
			$password = mysqli_real_escape_String($connection,$password);

		    if($radio == "teacher")
		   {
		 
		    $query = "select * from teachers where teacher_username ='{$Username}'";
		   
		    
			$result = mysqli_query($connection,$query);

			if(!$result)
			{
				die("query faild..".mysqli_error($connection));
			}

			while($row = mysqli_fetch_assoc($result))
			{
			     $_id = $row['teacher_id'];
			    $db_uname = $row['teacher_username'];
			    $db_password = $row['teacher_password'];
			    $db_role =  $row['role_id'];
			    $db_class =  $row['class_id'];
		      
			}
			
			$error2 = "Username/Password Incorrect";
			$error3 = "Username Incorrect";
			$error4 = "Password Incorrect";
			if($Username !== $db_uname)
			{
		              
		        	$_SESSION['error'] = $error3;
		    header("location: login-form.php");
			}
		    elseif ($password !== $db_password) {
		    	$_SESSION['error'] = $error4;
		      header("location: login-form.php");
		    }

			else{
		       
		           $_SESSION['username']=$db_uname;
		               $_SESSION['role_id']=$db_role;
		               $_SESSION['id'] = $_id;
		               $_SESSION['my_class'] = $db_class;
		        	header("Location: dashboard.php");
		     //send user back to the login page.
				
			}
			}
		   elseif($radio == "student")
		   {
			$query = "select * from students where student_username ='{$Username}'";
			$result = mysqli_query($connection,$query);

			if(!$result)
			{
				die("query faild..".mysqli_error($connection));
			}

			while($row = mysqli_fetch_assoc($result))
			{
			     $_id = $row['student_id'];
			    $db_uname = $row['student_username'];
			    $db_password = $row['student_password'];
			    $db_role =  $row['role_id'];
		      
			}
			$error = "Username/Password Incorrect";
			if($Username === $db_uname && $password === $db_password && $db_role == 2)
			{
		             $_SESSION['username']=$db_uname;
		              $_SESSION['id'] = $_id;
		               $_SESSION['role_id']=$db_role;
		        	header("Location: dashboard.php");
			}
			
			else{
				 $_SESSION['error'] = $error;
		    header("location: login-form.php");
			}
		    }
		}
		
 

		?>