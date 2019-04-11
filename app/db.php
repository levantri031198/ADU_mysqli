<?php
require "config.php";

class db{
    public static $conn;
    public function __construct(){
        self:: $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        self:: $conn->set_charset('utf8');
    }

    public function getData($obj)
    {
        $arr = array();
        while ($row = $obj->fetch_assoc())
        {
            $arr[] = $row;
        }
        return $arr;
    }

    // tao danh sach phan trang
    public function create_links ($base_url, $total_rows, $page, $per_page)
    {
        $total_links = ceil($total_rows/$per_page);
        $link ="";
        for($j=1; $j <= $total_links ; $j++)
        {
            $link = $link."<li class =". 'page' . "><a href='".$base_url."page=$j'> $j </a></li>";
        }
        return $link;
    }   
    public function __destruct()
    {
        self:: $conn->close();
    }
}