<?php
// Database connection
$servername = "localhost"; // Adjust this with your database server
$username = "root";        // Your database username
$password = "";            // Your database password
$dbname = "OnCourse_db"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the course name from the GET request
$courseCode = isset($_GET['course']) ? $_GET['course'] : '';

// Prepare the SQL query
$sql = "SELECT MonThurs FROM All_Courses WHERE CourseCode = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $courseCode); // 's' means the parameter is a string
$stmt->execute();
$stmt->store_result();

// Check if the course is found and is scheduled on Monday
if ($stmt->num_rows > 0) {
    $stmt->bind_result($MonThurs); // Bind the result
    $stmt->fetch();
    // If the course is scheduled on Monday
    if ($MonThurs != null) {
        echo $MonThurs;  // Respond with 'yes' if it's scheduled on Monday
    } else {
        echo 'no';   // Respond with 'no' if it's not scheduled on Monday
    }
} else {
    echo 'no';  // If no such course is found
}

$stmt->close();
$conn->close();
?>
