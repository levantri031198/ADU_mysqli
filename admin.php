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
    <link rel="shortcut icon" href="public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/login.css">
    <style type="text/css">
        #add {
            text-align: center;
            margin-left: 500px; 
        }
    </style>
    <title>Trang Admin</title>
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
            <h1 class="title">Tất cả sản phẩm(<?php echo $total_rows?>)</h1>
        </div>
        
        <form action="deleteproduct.php" method="get" class="form-horizontal" enctype="multipart/form-data">
            <div class="widget-content nopadding">
                        <table action='deleteproduct.php' class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Brand</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                             <?php 
                            foreach($data as $row)
                            {
                            ?>   
                            <tr class="control">
                                <td name='id'><?php 
                                    echo $row['id'];
                                 ?></td>
                                 <td><img src="public/img/<?php echo $row['brand']."/".$row['img']?>" class="hinhSP"></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['brand']?></td>
                                <td><?php echo $row['price']?></td>
                                <td>
                                    <a href="editproduct.php?id=<?php echo $row['id']?>" class="btn btn-success btn-mini">Edit</a>

                                    <div class="form-actions">
                                    <a href="deleteproduct.php?id=<?php echo $row['id']?>" class="btn btn-danger btn-mini">Delete</a>
                                    </div>
                                </td>
                            </tr>

                            <?php } ?>
                            </tbody>
                        </table>
                    </div> 
        </form>
          <a href="addnewproduct.php" class="btn btn-success btn-mini">ADD</a>     
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
    
    <script src="public/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="public/vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>