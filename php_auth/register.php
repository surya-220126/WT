<?php
$server="localhost";
$user="root";
$password="";
$database="mydb";

$connection=mysqli_connect($server,$user,$password,$database);
if(!$connection){
    die("connection failed");
}
$user=$_POST["username"];
$email=$_POST["email"];
$password=$_POST["password"];
$qery="insert into users(username,email,password) values('$user','$email','$password')";

if(mysqli_query($connection,$qery)){
    echo "registration sucessfull";
}
else{
    echo "error occured during registration";
}
mysqli_close($connection);
?>