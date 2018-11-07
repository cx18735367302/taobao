<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2018/10/24
 * Time: 22:21
 */
function upload($name){
    $img=$_FILES[$name];
//         $destination="uploaded/1.jpg";
//         move_uploaded_file($img["tmp_name"],$destination);
    $filename=$img["name"];
    //   string  字符串    $start开始     $length =null  长度
    $pos=strpos($filename,".");
    $ext= substr($filename,$pos);
    $t1=time();
    $newname=md5($t1.$filename);
    $destination="../images/".$newname.$ext;
    move_uploaded_file($img["tmp_name"],$destination);
    $destination = "images/".$newname.$ext;
    return $destination;
}
$link = mysqli_connect("localhost","root","","shop");
mysqli_set_charset($link,"utf8");
 if (isset($_POST["productname"])&&isset($_POST["productinfo"])&&isset($_POST["productprise"])&&isset($_FILES["photosrc"])&&isset($_COOKIE["accountname"])){
     $productname = $_POST["productname"];
     $productinfo = $_POST["productinfo"];
     $productprise = $_POST["productprise"];
     $photosrc = upload("photosrc");
     $accountname = $_COOKIE["accountname"];


     if($link){
         $sql = "insert into taobaoindex
(productTit,productinfo,price,shopName,photoSmallsrc,payPeople)
VALUES
('$productname','$productinfo','$productprise','$accountname','$photosrc',0)
";
         $result = mysqli_query($link,$sql);
         if ($result){
             echo "200";
         }else{
             echo "201";
         }
     }
     mysqli_close($link);
}