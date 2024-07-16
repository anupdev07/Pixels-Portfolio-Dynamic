<?php
$servername = 'localhost';
$username = 'root';
$password='Helloworld123@#$';
$dbname= 'pixels_database';
$conn =new mysqli($servername,$username,$password,$dbname);
if(!$conn)
{
 
    die(mysqli_error($conn));
}
else{
    
}
?>


