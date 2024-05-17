<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

$RollNumber = $_POST['RollNumber'];
$Password = $_POST['Password'];

$conn = new mysqli('localhost', 'root', '', 'registrationdb');

if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
} 
else{
    echo "Connested Successfully";
}
$sql="SELECT * from registration WHERE RollNumber='$RollNumber' and Password='$Password'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
$count=Mysqli_num_rows($result);
if($count==1)
{
    header("Location: project.html");
}
else{
    echo '<script>
      alert("Login Failed.Invalid Username or Password");
      </script>';
}

?>

