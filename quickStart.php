<?php
$servername = "localhost";
$username = "root"; // Default username for XAMPP MySQL
$password = ""; // Default password for XAMPP MySQL is empty
$dbname = "OnCourse_db"; // Your database name
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick Start</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Reset some default styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column; /* Stack elements vertically */
            height: 100vh; /* Full height of the viewport */
            box-sizing: border-box;
        }

        /* Header styling */
        header {
            background-color: #fbe2e7;
            color: white;
            padding: 20px;
            width: 100%; /* Full width */
            text-align: center;
            box-sizing: border-box;
        }

        .clickable-header {
            text-decoration: none;
            color: white;
        }

        /* Flex container for search, dropdown, and calendar */
        .top-container {
            display: flex;
            align-items: flex-start; /* Align items to the top */
            justify-content: space-between; /* Space between elements */
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
        }

        /* Search bar container (aligned to the left) */
        .search-container {
            display: flex;
            flex-direction: column;
            width: 300px; /* Fixed width */
            position: relative; /* Allow absolute positioning of scrollable content */
        }

        .search-container input {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%; /* Make the input field take the full width of the container */
            color: #3d30a2;
        }

        /* Scrollable content area */
        .scrollable-content {
            max-height: 300px;
            overflow-y: auto; /* Enable vertical scrolling */
            padding: 10px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-top: 10px;
            width: 100%; /* Full width relative to search-container */
            position: absolute; /* Prevent it from affecting layout */
            top: 40px; /* Adjusted to appear below the search input */
            box-sizing: border-box; /* Prevent overflow */
        }

        .scrollable-content p {
            cursor: pointer; /* Change cursor to indicate clickable items */
            padding: 5px;
            border-bottom: 1px solid #ddd;
        }

        .scrollable-content p:hover {
            background-color: #f0f0f0; /* Highlight on hover */
        }

        /* Dropdown container (aligned to the right) */
        .dropdown-container {
            display: flex;
            flex-direction: column; /* Stack label and dropdown vertically */
            align-items: flex-end; /* Align dropdown to the right */
            width: 200px;
        }

        /* Dropdown label styling */
        .dropdown-container label {
            font-size: 16px;
            color: #3d30a2;
            margin-bottom: 5px; /* Space between label and dropdown */
        }

        select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            color: #3d30a2;
            width: 100%; /* Make the dropdown take up the full width of its container */
        }

        /* Calendar container (centered) */
        .calendar-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50%; /* Set width to 50% of the parent container */
            padding: 20px;
            box-sizing: border-box;
        }

        .calendar {
            display: grid;
            grid-template-columns: repeat(5, 1fr); /* 5 columns for Mon-Fri */
            grid-gap: 5px;
            width: 100%;
            max-width: 900px;
        }

        .calendar div {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            font-size: 14px;
            position: relative;
        }

        .calendar .day-header {
            font-weight: bold;
            background-color: #fbe2e7;
            color: #3d30a2;
        }

        /* Times 6AM to 10PM - Removed this section */
        .time-column {
            display: grid;
            grid-template-rows: repeat(17, 1fr); /* Remove this if not needed */
        }

        /* Checklist container (aligned to the right under the dropdown) */
        .checklist-container {
            display: flex;
            justify-content: flex-end; /* Align checklist to the right */
            padding: 0px;
            flex-grow: 1; /* Allow container to take up remaining space */
            box-sizing: border-box;
            margin-top: 20px; /* Ensure space between the calendar and checklist */
        }

        /* Styling for the checklist */
        .checklist {
            list-style: none;
            padding: 10px;
            max-width: 350px; /* Fixed width for checklist */
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .checklist-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .checklist-item input {
            margin-right: 10px;
        }

        .checklist-item.completed label {
            text-decoration: line-through;
            color: #4236a3;
        }

        .checklist-item label {
            font-size: 16px;
            color: #3d30a2;
        }

        /* Subheading for checklist */
        .checklist-subhead {
            text-align: center;
            font-size: 1.5rem;
            margin-top: 0;
            margin-bottom: 20px;
            color: #3d30a2;
        }

        /* Footer styling */
        footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: white;
        }

    </style>
</head>
<body>

    <header>
        <a href="index.php" class="clickable-header"><h1>OnCourse</h1></a>
    </header>

    <main>
        <!-- Flex container for search, dropdown, and calendar (row) -->
        <div class="top-container">
            <!-- Search bar Section: Positioned to the left -->
            <div class="search-container">
                <input type="text" id="search" placeholder="Search courses...">
                <div class="scrollable-content" id="scrollableContent">
                    <p>Start typing to search for courses...</p>
                    <?php
                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        //echo "Connected successfully";
                
                        $sql = "SELECT CourseCode FROM All_Courses";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<p class='courseToAdd'>" . $row["CourseCode"]. "</p>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>No courses found</td></tr>";
                        }

                        // Close the connection
                        $conn->close();
                    ?>
                </div>
            </div>

            <!-- Calendar Section: Positioned in the center -->
            <div class="calendar-container">
                <div class="calendar">
                    <!-- Monday to Friday Header -->
                    <div class="day-header" class="MR">Mon</div>
                    <div class="day-header" class="TF">Tue</div>
                    <div class="day-header" class="W">Wed</div>
                    <div class="day-header" class="MR">Thu</div>
                    <div class="day-header" class="TF">Fri</div>

                    <!-- Remove time columns -->
                    <div class="time-column" id="Mon">
                        <?php
                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            //echo "Connected successfully";
                            
                            $times = ["8:30", "9:55", "11:20", "2:10", "3:45"];
                            for ($i = 0; $i < count($times); $i++) {
                                // Ensure proper time format for SQL query
                                $time = date("H:i:s", strtotime($times[$i])); // Convert to 'HH:MM:SS' format
                                
                                // Use prepared statements to avoid SQL injection
                                $sql = "SELECT CourseCode FROM CurrentSchedule WHERE MeetingDays = 'MR' AND StartTime = ?";
                                
                                if ($stmt = $conn->prepare($sql)) {
                                    // Bind the time parameter
                                    $stmt->bind_param("s", $time); // "s" for string type
                                    
                                    // Execute the query
                                    $stmt->execute();
                                    
                                    // Get the result
                                    $result = $stmt->get_result();
                                    
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<p>" . $row["CourseCode"] . "</p>";
                                        }
                                    }
                                    
                                    // Close the statement
                                    $stmt->close();
                                }
                            }
                            // Close the connection
                            $conn->close();
                        ?>
                    </div>
                    <div class="time-column" id="Tues">
                    <?php
                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            //echo "Connected successfully";
                            
                            $times = ["8:30", "9:55", "11:20", "2:10", "3:45"];
                            for ($i = 0; $i < count($times); $i++) {
                                // Ensure proper time format for SQL query
                                $time = date("H:i:s", strtotime($times[$i])); // Convert to 'HH:MM:SS' format
                                
                                // Use prepared statements to avoid SQL injection
                                $sql = "SELECT CourseCode FROM CurrentSchedule WHERE MeetingDays = 'TF' AND StartTime = ?";
                                
                                if ($stmt = $conn->prepare($sql)) {
                                    // Bind the time parameter
                                    $stmt->bind_param("s", $time); // "s" for string type
                                    
                                    // Execute the query
                                    $stmt->execute();
                                    
                                    // Get the result
                                    $result = $stmt->get_result();
                                    
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<p>" . $row["CourseCode"] . "</p>";
                                        }
                                    }
                                    
                                    // Close the statement
                                    $stmt->close();
                                }
                            }
                            // Close the connection
                            $conn->close();
                        ?>
                    </div>
                    <div class="time-column" id="Wed"></div>
                    <div class="time-column" id="Thurs">
                    <?php
                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            //echo "Connected successfully";
                            
                            $times = ["8:30", "9:55", "11:20", "2:10", "3:45"];
                            for ($i = 0; $i < count($times); $i++) {
                                // Ensure proper time format for SQL query
                                $time = date("H:i:s", strtotime($times[$i])); // Convert to 'HH:MM:SS' format
                                
                                // Use prepared statements to avoid SQL injection
                                $sql = "SELECT CourseCode FROM CurrentSchedule WHERE MeetingDays = 'MR' AND StartTime = ?";
                                
                                if ($stmt = $conn->prepare($sql)) {
                                    // Bind the time parameter
                                    $stmt->bind_param("s", $time); // "s" for string type
                                    
                                    // Execute the query
                                    $stmt->execute();
                                    
                                    // Get the result
                                    $result = $stmt->get_result();
                                    
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<p>" . $row["CourseCode"] . "</p>";
                                        }
                                    }
                                    
                                    // Close the statement
                                    $stmt->close();
                                }
                            }
                            // Close the connection
                            $conn->close();
                        ?>
                    </div>
                    <div class="time-column" id="Fri">
                    <?php
                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            //echo "Connected successfully";
                            
                            $times = ["8:30", "9:55", "11:20", "2:10", "3:45"];
                            for ($i = 0; $i < count($times); $i++) {
                                // Ensure proper time format for SQL query
                                $time = date("H:i:s", strtotime($times[$i])); // Convert to 'HH:MM:SS' format
                                
                                // Use prepared statements to avoid SQL injection
                                $sql = "SELECT CourseCode FROM CurrentSchedule WHERE MeetingDays = 'TF' AND StartTime = ?";
                                
                                if ($stmt = $conn->prepare($sql)) {
                                    // Bind the time parameter
                                    $stmt->bind_param("s", $time); // "s" for string type
                                    
                                    // Execute the query
                                    $stmt->execute();
                                    
                                    // Get the result
                                    $result = $stmt->get_result();
                                    
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<p class = 'addedCourse' >" . $row["CourseCode"] . "</p>";
                                        }
                                    }
                                    
                                    // Close the statement
                                    $stmt->close();
                                }
                            }
                            // Close the connection
                            $conn->close();
                        ?>
                    </div>
                </div>
            </div>

            <!-- Dropdown Section: Positioned to the right -->
            <div class="dropdown-container">
                <label for="courses">Filter by a requirement: </label>
                <select id="courses" name="courses">
                    <option value="all">All</option>
                    <option value="maj">Major</option>
                    <option value="min">Minor</option>
                    <option value="deg">Distribution Requirements</option>
                    <option value="grad">Graduate School Requirements</option>
                </select>
                <!-- Checklist Section: Positioned below the dropdown -->
                <div class="checklist-container">
                    <div>
                        <div class="checklist-subhead">Completed Courses</div>
                        <ul id="checklist" class="checklist">
                            <!-- Checklist items will be dynamically added here -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script>

        $(document).ready(function() {
            $(".courseToAdd").click(function() {
                // Get the text of the clicked paragraph
                var theCourse = $(this).text();

                $.ajax({
                    url: "isMR.php",  // The PHP script that handles the request
                    type: "GET",               // Use GET to fetch the data
                    data: { course: theCourse }, // Pass the course name to PHP
                    success: function(response) {
                    // If the response is 'yes', add the course to the Monday section
                    if (response != 'no') {
                        // Split the string at the " - " separator
                        var times = response.split(" - ");

                        // Get the start time and end time
                        var startTime = times[0];  // "11:20"
                        var endTime = times[1];    // "12:35"
                        $.ajax({
                            url: "addCourse.php",  // The PHP script that handles the request
                            type: "POST",               // Use GET to fetch the data
                            data: { course_code: theCourse,
                                    day_of_week: "MR",
                                    start_time: startTime,
                                    end_time: endTime
                             }, // Pass the course name to PHP
                            success: function() {
                            }
                        });
                        $('#Mon').append('<p>' + theCourse + " " + response + '</p>');
                        $('#Thurs').append('<p>' + theCourse + '</p>');
                    }
                    }
                });

                $.ajax({
                    url: "isTF.php",  // The PHP script that handles the request
                    type: "GET",               // Use GET to fetch the data
                    data: { course: theCourse }, // Pass the course name to PHP
                    success: function(response) {
                    // If the response is 'yes', add the course to the Monday section
                    if (response != 'no') {
                        // Split the string at the " - " separator
                        var times = response.split(" - ");

                        // Get the start time and end time
                        var startTime = times[0];  // "11:20"
                        var endTime = times[1];    // "12:35"
                        $.ajax({
                            url: "addCourse.php",  // The PHP script that handles the request
                            type: "POST",               // Use GET to fetch the data
                            data: { course_code: theCourse,
                                    day_of_week: "TF",
                                    start_time: startTime,
                                    end_time: endTime
                             }, // Pass the course name to PHP
                            success: function() {
                            }
                        });
                        $('#Tues').append('<p>' + theCourse + '</p>');
                        $('#Fri').append('<p>' + theCourse + '</p>');
                    }
                    }
                });
                // Display the text in the <div id="response">
                //$("#response").html("You clicked on: <strong>" + paragraphText + "</strong>");
            });

            $(".addedCourse").click(function() {
                // Get the text of the clicked paragraph
                var theCourse = $(this).text();

                $.ajax({
                    url: "dropCourse.php",  // The PHP script that handles the request
                    type: "POST",               // Use GET to fetch the data
                    data: { course_code: theCourse }, // Pass the course name to PHP
                    success: function() {
                    }
                });
                // Display the text in the <div id="response">
                //$("#response").html("You clicked on: <strong>" + paragraphText + "</strong>");
            });
        })
            // Example list of tasks with boolean values (completed: true/false)
            const tasks = [
                { task: "Math 225", completed: false },
                { task: "Stat 218", completed: true },
                { task: "CS 230", completed: false },
                { task: "CS 240", completed: true }
            ];

            // Function to render the checklist based on the tasks array
            function renderChecklist() {
                const checklistElement = document.getElementById("checklist");
                checklistElement.innerHTML = ""; // Clear the checklist first

                tasks.forEach((task, index) => {
                    // Create a list item for each task
                    const listItem = document.createElement("li");
                    listItem.classList.add("checklist-item");
                    if (task.completed) {
                        listItem.classList.add("completed"); // Add class to indicate completed task
                    }

                    // Create the checkbox input and label for the task
                    const checkbox = document.createElement("input");
                    checkbox.type = "checkbox";
                    checkbox.checked = task.completed;
                    checkbox.addEventListener("change", () => toggleTaskCompletion(index)); // Handle checkbox toggle

                    const label = document.createElement("label");
                    label.textContent = task.task;

                    // Append the checkbox and label to the list item
                    listItem.appendChild(checkbox);
                    listItem.appendChild(label);

                    // Add the list item to the checklist
                    checklistElement.appendChild(listItem);
                });
            }

            // Function to toggle task completion based on checkbox
            function toggleTaskCompletion(index) {
                tasks[index].completed = !tasks[index].completed; // Toggle the boolean
                renderChecklist(); // Re-render the checklist to reflect the change
            }

            // Initial render of the checklist
            renderChecklist();
        </script>
    </main>

    <footer>
        <p>2024 WHACK OnCourse</p>
    </footer>

</body>
</html>