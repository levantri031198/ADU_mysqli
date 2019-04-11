<?php
require "app/products.php";
session_start();
$products = new products();
$per_page = 8;
$total_rows = $products->countAll();
if (isset($_GET['page']))
{
    $page = $_GET['page'];
}
else
    {
        $page = 1;
    }
    $data = $products->allProducts($page, $per_page);
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
    <link rel="stylesheet" href="public/font-awesome-4.7.0/css/font-awesome.min.css">
    <title>Trang chủ</title>
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
               
            </div>
            
          

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
            <h1 class="title">Tất cả sản phẩm (<?php echo $total_rows?>)</h1>
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
                           
                    </div>
                <?php } ?>
            </div>
    </div>
    <!-- Pagination -->
    <div align="center">
                <ul class="pagination pagination-lg" id="page-list">
                    <?php 
                    $base_url = $_SERVER['PHP_SELF']."?";
                    echo $products->create_links($base_url, $total_rows, $page, $per_page);
                    ?>
                </ul>
            </div>
    
    <!-- Footer -->
    <div class="footer-top">
   
    <script src="public/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="public/vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>