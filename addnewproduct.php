<?php
require "app/products.php";
session_start();
if ($_SESSION['user'] != 'admin')
{
    header('location: index.php');
}
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
    <title>Thêm sản phẩm mới</title>
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
    
    <!-- Pagination -->
    <div class="container">
        <div class="header col-md-12">
            <h1>ADD NEW PRODUCT</h1>
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Product Detail</h5>
                    </div>
                    <div class="widget-content nopadding">

                        <!-- BEGIN USER FORM -->
                        <form action="addproduct.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="control-group">
                                <label class="control-label col-md-3">Name :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Product name" name="name" /> *
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label col-md-3">Choose a manufacture :</label>
                                <div class="controls">
                                    <select name="brand">
                                        <option value="Apple">Apple</option>
                                        <option value="Samsung">Samsung</option>
                                        <option value="Xiaomi">Xiaomi</option>
                                        <option value="Oppo">Oppo</option>

                                    </select> *
                                </div>
                               
                                <div class="control-group">                                    
                                    <div class="control-group">
                                        <label class="control-label col-md-3">Price :</label>
                                        <div class="controls">
                                            <input type="text" class="span11" placeholder="price" name = "price" /> *
                                        </div>

                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success">ADD</button>
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
    <!--end-Footer-part-->
    <script src="public/js/jquery.min.js"></script>
    <script src="public/js/jquery.ui.custom.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/jquery.uniform.js"></script>
    <script src="public/js/select2.min.js"></script>
    <script src="public/js/jquery.dataTables.min.js"></script>
    <script src="public/js/matrix.js"></script>
    <script src="public/js/matrix.tables.js"></script>
</body>
</html>