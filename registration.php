<?php
// Retrieve form data
$firstName = $_POST['FirstName'];
$lastName = $_POST['LastName'];
$rollNumber = $_POST['RollNumber'];
$department = $_POST['Department'];
$email = $_POST['Email'];
$phoneNumber = $_POST['pnumber'];
$password = $_POST['Password'];

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registrationdb";

try {
    // Create a PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;port=3306", $username, $password);
    
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // SQL query to insert form data into the database
    $sql = "INSERT INTO student (FirstName, LastName, RollNumber, Department, Email, PhoneNumber, Password) 
            VALUES (:firstName, :lastName, :rollNumber, :department, :email, :phoneNumber, :password)";
    
    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);
    
    // Bind parameters to the prepared statement
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':rollNumber', $rollNumber);
    $stmt->bindParam(':department', $department);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phoneNumber', $phoneNumber);
    $stmt->bindParam(':password', $password);
    
    // Execute the prepared statement
    $stmt->execute();
    
    // Success message
    echo "Registration Successful. <a href='Register2.html'>Go back to registration form</a>";
} catch(PDOException $e) {
    // Error message
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn = null;
?>
