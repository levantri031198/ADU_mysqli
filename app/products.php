<?php
    require "db.php";
    class products extends db{
        
        // truy van tat ca san pham
        public function allProducts($page, $per_page)
        {
            $first_link = ($page - 1) * $per_page;
            $sql = "SELECT * FROM products ORDER BY price DESC LIMIT $first_link, $per_page";
            $result = self:: $conn->query($sql);
            return self::getData($result);
        }
        // dem so luong tat ca san pham
        public function countAll(){
            $sql = "SELECT * FROM products";
            $result = self::$conn->query($sql);
            return $result->num_rows;
        }

        // truy van tat ca san pham theo thuong hieu
        public function readAllProducts($brand, $page, $per_page)
        {
            $first_link = ($page - 1) * $per_page;
            $sql = "SELECT * FROM products WHERE products.brand = '$brand' ORDER BY price DESC LIMIT $first_link, $per_page";
            $result = self:: $conn->query($sql);
            return self:: getData($result);
        }
        // dem so luong san pham theo thuong hieu
        public function countAllProducts($brand){
            $sql = "SELECT * FROM products  WHERE products.brand = '$brand'";
            $result = self::$conn->query($sql);
            return $result->num_rows;
        }

        // lay du lieu mot san pham theo id
        public function getProduct($id)
        {
            $sql = "SELECT * FROM products  WHERE products.id = '$id'";
            $result = self::$conn->query($sql);
            return self::getData($result);
        }

        
    }