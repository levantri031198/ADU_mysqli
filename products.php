<?php
    require "app/products.php";
    session_start();
    $brand = $_GET['brand'];
    $products = new products();
    $per_page = 8;
    $total_rows = $products->countAllProducts($brand);
	if (isset($_GET['page']))
	{
		$page = $_GET['page'];
	}
	else
		{
			$page = 1;
		}
    $data = $products->readAllProducts($brand, $page, $per_page);
    //var_dump($data);
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

    <title>Sản phẩm</title>
</head>
<body>

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
                <a class="navbar-brand" href="index.php">Trang chủ</a>
            </div>
            
            <!-- Dropdown Brands -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sản phẩm</a>
                        <ul class="dropdown-menu">
                            <li><a href="products.php?brand=Apple">Apple</a></li>
                            <li><a href="products.php?brand=Samsung">Samsung</a></li>
                            <li><a href="products.php?brand=Xiaomi">Xiaomi</a></li>
                            <li><a href="products.php?brand=Oppo">Oppo</a></li>
                        </ul>
                    </li>
                    <li><a href="contact.php">Liên hệ</a></li>
                </ul>
            <!-- Form tim kiem -->
            <form action="search.php" class="navbar-form navbar-left" role="search" method="GET">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Nhập từ khoá..." name="key">
                </div>
                <button type="submit" class="btn btn-default">Tìm</button>
            </form>

                <ul class="nav navbar-nav navbar-right">
                <?php
                     if (isset($_SESSION['user']))
                     {
                         if ($_SESSION['user'] == 'admin')
                             echo '<li class="dropdown">
                             <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin</a>
                             <ul class="dropdown-menu">
                                <li><a href="admin.php">Quản lý</a></li>
                                <li><a href="addnewproduct.php">Thêm sản phẩm</a></li>
                             </ul>
                         </li>';
                     
                         else
                             echo '<li><a href="cart.php">Giỏ hàng</a></li>';
                     }
                     else
                             echo '<li><a href="cart.php">Giỏ hàng</a></li>';
                             
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
    <div class="container">
        <div>
            <h1 class="title"><?php echo $brand . " (" . $total_rows . ")"?></h1>
        </div>
        <div class="row inSanPham">
            <?php 
                foreach($data as $row)
                {
            ?>
                <div class="col-md-3" align="center">
                    <a href="details.php?id=<?php echo $row['id']?>"><img src="public/img/<?php echo $row['brand']."/".$row['img']?>" class="hinhSP"></a>
                        <a href="details.php?id=<?php echo $row['id']?>"><h4><?php echo $row['name']?></h4></a>
                            <b>Price:</b>
                            <div class = "price">
                            <?php echo $row['price']?>
                            </div>
                            <b>VND</b>
                        <div>
                            <a class="btn btn-primary" href="addcart.php?id=<?php echo $row['id']?>" role="button">Thêm vào giỏ</a>
                            <hr>
                        </div>
                </div>
            <?php } ?>
        </div>
            
            <!-- Pagination -->
            <div align="center">
                <ul class="pagination pagination-lg" id="page-list">
                    <?php 
                    $base_url = $_SERVER['PHP_SELF']."?brand=$brand&";
                    echo $products->create_links($base_url, $total_rows, $page, $per_page);
                    ?>
                </ul>
            </div>
        
    </div>
    
    <!-- Footer -->
    <div class="footer-top">
    <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-about-us">
                        <h2><span>Shop</span></h2>
                        <ul class="list-unstyled">
                            <li><h4>Phạm Ngọc Huy Duy</h4></li>
                            <li><h4>Cao Lê Viết Tiến</h4></li>
                            <li><h4>Lê Thanh Thiện</h4></li>
                        </ul>
                        <div class="footer-social">
                            <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Danh sách</h2>
                        <ul>
                            <li><a href="products.php?brand=Apple">Apple</a></li>
                            <li><a href="products.php?brand=Samsung">Samsung</a></li>
                            <li><a href="products.php?brand=Xiaomi">Xiaomi</a></li>
                            <li><a href="products.php?brand=Oppo">Oppo</a></li>
                        </ul>                        
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Chức năng</h2>
                        <ul>
                            <li><a href="cart.php">Giỏ hàng</a></li>
                            <li><a href="admin.php">Trang Admin</a></li>
                            <li><a href="login.php">Login</a></li>
                        </ul>                        
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-newsletter">
                        <h2 class="footer-wid-title">Newsletter</h2>
                        <p>Sign up to our newsletter and get exclusive deals you wont find anywhere else straight to your inbox!</p>
                        <div class="newsletter-form">
                            <form action="#">
                                <input type="email" placeholder="Type your email">
                                <input type="submit" value="Subscribe">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="public/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="public/vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>