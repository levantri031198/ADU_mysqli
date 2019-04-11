<?php
require "app/products.php";
session_start();
if ($_SESSION['user'] != 'admin')
{
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/login.css">    
    <link rel="shortcut icon" href="public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="public/css/matrix-style.css"/>

    <style type="text/css">
        #add {
            text-align: center;
            margin-left: 500px; 
        } 

        h1{
            color: white;
            background: #777777;
        }   

    </style>
    <title>Chỉnh sửa sản phẩm</title>
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
    
    <!-- Pagination -->
    <div class="container">
        <div class="header col-md-12">
            <h1>EDIT PRODUCT</h1>
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Product Detail</h5>
                    </div>
                    <div class="widget-content nopadding">

                         <!-- BEGIN USER FORM -->
                        <?php 
                            $id = $_GET['id'];                                                    
                            spl_autoload_register(function ($class_name){
                               require "app/" .$class_name . ".php";
                            });                                              
                            $product = new product();
                            $productById = $product->getProductById($id);
                            
                         ?> 

                        <form action="edit.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="control-group">
                                <label class="control-label col-md-3">Name :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Product name" name="name" value="<?php echo $productById[0]['name'] ?>" /> *
                                    <input type="hidden" name="id" value="<?php echo $id ?>" />
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label col-md-3">Choose a manufacture :</label>
                                <div class="controls">
                                    <select name="brand" value="<?php echo $productById[0]['brand'] ?>" >
                                        <option value="Apple">Apple</option>
                                        <option value="Samsung">Samsung</option>
                                        <option value="Xiaomi">Xiaomi</option>
                                        <option value="Oppo">Oppo</option>

                                    </select> *
                                </div>
                                <div class="control-group">
                                    <label class="control-label col-md-3">Choose an image :</label>
                                    <div class="controls">
                                        <input type="file" name="fileUpload" id="fileUpload" value="<?php echo $productById[0]['img'] ?>">*
                                    </div>
                                </div>
                                <div class="control-group">                                    
                                    <div class="control-group">
                                        <label class="control-label col-md-3">Price :</label>
                                        <div class="controls">
                                            <input type="text" class="span11" placeholder="price" name = "price" value="<?php echo $productById[0]['price'] ?>">*
                                        </div>

                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success">UPDATE</button>
                                    </div>
                                </div>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="public/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="public/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="public/js/jquery.min.js"></script>
    <script src="public/js/jquery.ui.custom.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/jquery.uniform.js"></script>
    <script src="public/js/select2.min.js"></script>
    <script src="public/js/jquery.dataTables.min.js"></script>
    <script src="public/js/matrix.js"></script>
    <script src="public/js/matrix.tables.js"></script>
</body>

    <footer>
        <p>© 2018 Đồ án Lập trình web - Lớp chiều thứ 5</p>
    </footer>
</html>
