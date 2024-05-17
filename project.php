<?php
$rollNumber = $_POST['RollNumber'];

$conn = new mysqli('localhost', 'root', '', 'registrationdb');
if ($conn->connect_error) {
   die('Connection failed: ' . $conn->connect_error);
} 

$stmt = $conn->prepare("SELECT Attendance_percentage FROM attendance WHERE RollNumber = ?");
$stmt->bind_param("i", $rollNumber);

if (!$stmt->execute()) {
    die('Error executing the query: ' . $stmt->error);
}

$result = $stmt->get_result();
if (!$result) {
    die('Error fetching result: ' . $conn->error);
}

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $attendance_percentage = $row['Attendance_percentage'];
    if ($attendance_percentage > 75) {
        echo "You are eligible for the exam";
    } else {
        echo '<script>';
        echo 'alert("You are not eligible for the exam");'; // Example of JavaScript alert
        echo '</script>';
        echo '<p style="font-size: 24px;">Attendance Percentage: '.$attendance_percentage.'</p>'; // Display attendance percentage in bigger size
        die();
    }
} else {
    echo "No attendance found with this roll number";
}

$stmt->close();
$conn->close();
?>
