<?php 
	require "app/users.php";
	session_start();
    if(isset($_SESSION['user'])){
        header('location: index.php');
    }
	$users = new users();
	$error = "";
	if(isset($_POST['username'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		if($users->login($username, $password)){
			$_SESSION['user'] = $username;
			header('location:./');
		}
		else{
			$error = "Sai tài khoản hoặc mật khẩu";
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="shortcut icon" href="public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/login.css">
    <title>Đăng nhập</title>
</head>
<body>
    <!-- Header -->
    <header>
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Navbar -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
            </div>
            
           

                <ul class="nav navbar-nav navbar-right">
                    <?php
                     if (isset($_SESSION['user']))
                     {
                         if ($_SESSION['user'] == 'admin')
                             echo '<li class="dropdown">
                             <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin</a>
                             <ul class="dropdown-menu">
                                 <li><a href="products.php?brand=Apple">Apple</a></li>
                                 <li><a href="products.php?brand=Samsung">Samsung</a></li>
                                 <li><a href="products.php?brand=Xiaomi">Xiaomi</a></li>
                                 <li><a href="products.php?brand=Oppo">Oppo</a></li>
                             </ul>
                         </li>';
                     
                         
                     }
                     else
                             
                     if(isset($_SESSION['user'])){
                         $logout = '<li><a href="logout.php">Đăng xuất</a></li>';
                         echo $logout;
                     }
                     else{
                         $login = '<li><a href="login.php">Đăng nhập</a></li>';
                         echo $login;
                     }
                     ?>
                   
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>
        
    </header>
    <!-- Content -->
    <div class="container">
    	<div>
            <h1 class="title">Đăng nhập</h1>
        </div>
     
        <div class = "login">
        	 <form action="login.php" method="POST">
			        <input type="text" name="username" class="form-control login-form" placeholder="Tên tài khoản" required autofocus>
			        <input type="password" name="password" class="form-control login-form" placeholder="Mật khẩu" required>
		      <span class="error login-form"><?php echo $error ?></span>
        <button class="btn btn-lg btn-primary btn-block login-form" type="submit">Sign in</button>
      </form>
        </div>
    </div> <!-- /container -->

    <script src="public/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="public/vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
