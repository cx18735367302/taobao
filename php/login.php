<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2018/10/24
 * Time: 21:22
 */
if(isset($_COOKIE["accountName"])&&isset($_COOKIE["password"])){
    $email = $_COOKIE["accountName"];
    $password = $_COOKIE["password"];

$link = mysqli_connect("localhost","root","","shop");
mysqli_set_charset($link,"utf8");
if($link){
    $sql = "select username,useremail,userpassword from user
WHERE useremail='$email' and userpassword='$password' ";
    $result = mysqli_query($link,$sql);
//    while ($row = mysqli_fetch_array($result)){
//        if ($row["useremail"]==$email&&$row["userpassword"]==$password){
//            echo "200";
//            break;
//        }else{
//            echo "201";
//        }
//    }
    $data = mysqli_fetch_array($result);
    if($data){
        $json["code"] = "200";
        $json["data"] = $data;


    }else{
        $json["code"] = "201";

    }
    echo json_encode($json);
    mysqli_close($link);
}}