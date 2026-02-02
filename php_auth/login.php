<?php
$server="localhost";
$user="root";
$password="";
$database="mydb";

$connection = mysqli_connect($server,$user,$password,$database);
if(!$connection){
    die("connection failed");
}

$username = $_POST["username"];
$password = $_POST["password"];

$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($connection, $query);

if(mysqli_num_rows($result) == 1){
    echo "Login successful";
    
}
else{
    echo "Invalid credentials";

}

mysqli_close($connection);
?>
