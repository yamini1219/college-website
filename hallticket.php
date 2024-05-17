<?php
$name = $_POST['Name'];
$RollNumber = $_POST['RollNumber'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'registrationdb');
if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT Hallticket_img FROM halltickets WHERE RollNumber=?");
$stmt->bind_param("i", $RollNumber);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Bind the result to a variable
    $stmt->bind_result($hallticketImgData);
    $stmt->fetch();

    header('Content-Type: image/png');
    header('Content-Disposition: attachment; filename="hallticket.png"');

    // Output the binary data directly
    echo $hallticketImgData;
    exit;
} else {
    echo "Hall ticket not found for the specified roll number.";
}
$stmt->close();
$conn->close();
?>
