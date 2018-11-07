<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php

include "demo3.php";
//插入功能
//1、链接数据库
$link=mysqli_connect("localhost",
    "root",
    "",
    "shop");
mysqli_set_charset($link,"utf8");
//2、获取从前台传递过来的数据
//验证数据存不存在
if(isset($_POST["shopname"])
    && isset($_POST["shopdescribe"])
    && isset($_POST["shopprice"])
    && isset($_FILES["shopimg"])){

    $name=$_POST["shopname"];
    $des=$_POST["shopdescribe"];
    $price=$_POST["shopprice"];
    $img=upload("shopimg");

//3、编写sql语句
    $sql = "INSERT INTO  tb_shop
                    (shopname,shopdescribe,shopprice,shopimg) 
                VALUES ('$name','$des',$price,'$img')";

//4、执行
    $result=mysqli_query($link,$sql);

//5、ok  弹出插入成功     filed  弹出插入失败
    if($result){
        echo "<script>alert('插入成功')</script>";
    }else{
        echo "<script>alert('插入失败')</script>";
    }
    echo "<script>location.href='demo4.php'</script>";
}
?>

<form action="demo4.php" method="post" enctype="multipart/form-data">
    <input type="text" name="shopname">
    <input type="text" name="shopdescribe">
    <input type="text" name="shopprice">
    <input type="file" name="shopimg">
    <input type="submit">
</form>
<?php
$sql="select * from tb_shop";
$result=mysqli_query($link,$sql);
while ($arr=mysqli_fetch_array($result)){

    ?>
    <li>
        <h3><?php echo $arr["shopname"];?></h3>
        <h4><?php echo $arr["shopdescribe"];?></h4>
        <h5><?php echo $arr["shopprice"];?></h5>
    </li>
    <?php
}
?>
<ul>

</ul>
</body>
</html>