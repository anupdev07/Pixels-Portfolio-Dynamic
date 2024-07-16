<html>
<head>
    <title> DATABASE ASSIGNMENT </title>
    <style>
        body{
    margin: 0;
    padding: 0;
    background: url(bg.gif);
    background-size: cover;
    background-position: center;    font-family: sans-serif;
}
.login-box{
    width: 320px;
    height: 420px;
    background: rgba(0, 0, 0, 0.5);
    color: #fff;
    top: 50%;
    left: 50%;
    position: absolute;
    transform: translate(-50%,-50%);
    box-sizing: border-box;
    padding: 70px 30px;
}
.avatar{
    width: 100px;
    height: 100px;
    border-radius: 50%;
    position: absolute;
    top: -50px;
    left: calc(50% - 50px);
}
h1{
    margin: 0;
    padding: 0 0 20px;
    text-align: center;
    font-size: 22px;
}
.login-box p{
    margin: 0;
    padding: 0;
    font-weight: bold;
	}
.login-box input{
    width: 100%;
    margin-bottom: 20px;
}
.login-box input[type="text"], input[type="password"]
{
    border: none;
    border-bottom: 1px solid #fff;
    background: TRANSPARENT;
    outline: none;
    height: 40px;
    color: #fff;
    font-size: 16px;
}
.login-box input[type="submit"]
{
    border: none;
    outline: none;
    height: 40px;
    background: #1c8adb;
    color: #fff;
    font-size: 18px;
    border-radius: 20px;
}
.login-box input[type="submit"]:hover
{
    cursor: pointer;
    background: #39dc79;
    color: #000;
}

.login-box a{
    text-decoration: none;
    font-size: 18px;
    color: #fff;
}
.login-box a:hover
{
    color: #39dc79;
	}
    #link{
        font-size: 15px;
        font-family:italic; 
    }
    p{
        font-size:18px;
        
    }
    </style>   
</head>
    <body>
    <div class="login-box">
    <img src="avatar.png" class="avatar">
        <h1>Admin Login</h1>
		<form name="login" method="POST" autocomplete="off">
			 
           
		   <p>User Name</p>
            <input type="text" name="name" placeholder="Enter Admin's username" required>
            <p>Password</p>
            <input type="password" name="password" placeholder="Enter Password" required>
			     
            
			
            <input type="submit" name="submit" value="Login">
            
			</form>
       </div>
    </body>
</html>
<?php
session_start();
include 'connect.php';
if(isset($_POST['submit']))
{
    $name=$_POST['name'];
    $pass=$_POST['password'];
    $query="select * from admin where username='$name' and password='$pass' ";
    $result=mysqli_query($conn,$query);
    $count=mysqli_num_rows($result);
    if($count>0)
    {
        $_SESSION['username'] = $name;
        header("Location: http://localhost/Pixels/admin.php");
    }
    else{
        echo '<script>alert("Invalid username or password! Please try again")</script>';
    }
}
?>