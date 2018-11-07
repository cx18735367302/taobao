<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2018/10/24
 * Time: 19:43
 */
if(isset($_COOKIE["idnumber"])&&isset($_COOKIE["email"])&&isset($_COOKIE["accountname"])&&isset($_COOKIE["phonenumber"])&&isset($_COOKIE["password"]))
{
    $id = $_COOKIE["idnumber"];
    $email = $_COOKIE["email"];
    $accountname = $_COOKIE["accountname"];
    $password = $_COOKIE["password"];
    $phonenumber = $_COOKIE["phonenumber"];
    $link = mysqli_connect("localhost","root","","shop");
    mysqli_set_charset($link,"utf8");
    if($link){
        $sql = "select useremail from user
WHERE  useremail= '$email'
";
        $result = mysqli_query($link,$sql);

        $row = mysqli_fetch_array($result);
        if ($row!=null){
            echo "201";
        }else{
            $sq2 = "insert into user
(useremail,username,userphonenumber,useridcard,userpassword)
VALUES 
('$email','$accountname','$phonenumber','$id','$password')
";
            $result2 = mysqli_query($link,$sq2);
            if ($result2){
                echo "200";
            }else{
                echo "201";
            }
        }
    }
    mysqli_close($link);
}

