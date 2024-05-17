<?php
$FirstName = $_POST['FirstName'];
$LastName = $_POST['LastName'];
$RollNumber = $_POST['RollNumber'];
$Department = $_POST['Department'];
$Email = $_POST['Email'];
$PhoneNumber = $_POST['pnumber'];
$Password = $_POST['Password'];

$conn = new mysqli('localhost', 'root', '', 'registrationdb');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO registration(FirstName, LastName, RollNumber, Department, Email, PhoneNumber, Password) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die('Error in prepare statement: ' .$conn->error);
    }
    $stmt->bind_param("ssissis", $FirstName, $LastName, $RollNumber, $Department, $Email, $PhoneNumber, $Password);
    if (!$stmt->execute()) {
        die('Error in execution: ' . $stmt->error);
    }
    echo "Registration Successful";
    $stmt->close();
    $conn->close();
}
?>
