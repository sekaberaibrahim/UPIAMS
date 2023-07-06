<?php
	session_start();
	require 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Panel</title>
    <link rel="stylesheet" href="logstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
    <div class="wrapper">
        <header>UPI A.M.S </header>
        <form class="myform" action="index.php" method="post">
            <div class="field email">
                <div class="input-area">
                    <input name="username" type="text" class="inputvalues" placeholder="Type your username" required>
                    <i class="icon fas fa-envelope"></i>
                    <i class="error error-icon fas fa-exclamation-circle"></i>
                </div>
                <div class="error error-txt">Email can't be blank</div>
            </div>
            <div class="field password">
                <div class="input-area">
                    <input name="password" type="password" class="inputvalues" placeholder="Type your password" required">
                    <i class="icon fas fa-lock"></i>
                    <i class="error error-icon fas fa-exclamation-circle"></i>
                </div>
                <div class="error error-txt">Password can't be blank</div>
            </div>
            <div class="pass-txt"><a href="#">Forgot password?</a></div>
            <input name="login" type="submit" id="login_btn" value="Login">
        </form>


        <?php
		if(isset($_POST['login']))
		{
			$username=$_POST['username'];
			$password=$_POST['password'];
			
			$query="select * from admin WHERE username='$username' AND password='$password'";
			
			$query_run = mysqli_query($con,$query);
			if(mysqli_num_rows($query_run)>0)
			{
				$row = mysqli_fetch_assoc($query_run);
				// valid
				$_SESSION['username']= $row['username'];
			
				header('location:homepage.php');
			}
			else
			{
				// invalid credentials
         echo '<script type="text/javascript"> alert("Invalid credentials") </script>';
            
			}
			
		}
		
		
		?>




    </div>

    <script src="script/homescript.js"></script>
   

</body>


</html>