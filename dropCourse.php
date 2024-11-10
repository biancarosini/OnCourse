<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "OnCourse_db";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for a connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the data from the AJAX request
$courseCode = isset($_POST['course_code']) ? $_POST['course_code'] : '';

// Validate inputs
if ($courseCode) {
    // Prepare the SQL query to insert the course into the schedule
    $sql = "DELETE FROM CurrentSchedule WHERE CourseCode = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters
        $stmt->bind_param("s", $courseCode);

        // Close the statement
        $stmt->close();
    } else {
        echo 'error';  // Respond with error if the prepare statement fails
    }
} else {
    echo 'error';  // Respond with error if any input is missing
}

// Close the connection
$conn->close();
?>
