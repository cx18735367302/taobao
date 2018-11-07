<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2018/10/24
 * Time: 16:17
 */
$link=mysqli_connect("localhost",
    "root",
    "",
    "shop");
mysqli_set_charset($link,"utf8");
$spl = 'select * from tb_shop';
$result = mysqli_query($link,$spl);
$data = array();
$shop = array();
while ($row = mysqli_fetch_array($result)){
    //单独的一条数据
    $shop["shopname"]=$row["shopname"];
    $shop["shopdes"]=$row["shopdescribe"];
    $shop["shopprise"]=$row["shopname"];
    $shop["shopimg"]=$row["shopimg"];
    $data[] = $shop;
}
//如果可以取讲code设置为ok
if(count($data)){
    $json["code"] = "ok";
$json["data"] =$data;
}else{
    $json["code"] = "fail";
 }
 echo json_encode($json);
