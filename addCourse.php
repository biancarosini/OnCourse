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
$dayOfWeek = isset($_POST['day_of_week']) ? $_POST['day_of_week'] : '';
$startTime = isset($_POST['start_time']) ? $_POST['start_time'] : '';
$endTime = isset($_POST['end_time']) ? $_POST['end_time'] : '';

// Validate inputs
if ($courseCode && $dayOfWeek && $startTime && $endTime) {
    // Prepare the SQL query to insert the course into the schedule
    $sql = "INSERT INTO CurrentSchedule (MeetingDays, StartTime, EndTime, CourseCode)
            VALUES (?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters
        $stmt->bind_param("ssss", $dayOfWeek, $startTime, $endTime, $courseCode);

        // Execute the query
        if ($stmt->execute()) {
            echo 'success';  // Respond with success if the query executed correctly
        } else {
            echo 'error';    // Respond with error if there was an issue with the query
        }

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
