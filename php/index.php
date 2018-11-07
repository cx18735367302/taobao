<?php
$con = mysqli_connect("localhost","root",'','shop');
mysqli_set_charset($con,"utf8");
    if($con){
        $sql = "select * from taobaoindex";
        $result = mysqli_query($con,$sql);
        $data = array();
        $shop = array();
        while ($row = mysqli_fetch_array($result)){
            //单独的一条数据
            $shop["id"]=$row["shopid"];
            $shop["productTit"]=$row["productTit"];
            $shop["productinfo"]=$row["productinfo"];
            $shop["prise"]=$row["price"];
            $shop["shopName"]=$row["shopName"];
            $shop["payPeople"]=$row["payPeople"];
            $shop["photoSmallSrc"]=$row["photoSmallSrc"];
            $data[] = $shop;
        }
            if(count($data)){
                $json["code"] = "ok";
                $json["data"] =$data;
            }else{
                $json["code"] = "fail";
            }
            echo json_encode($json);
        }
?>

