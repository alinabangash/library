<?php
session_start();
if (!isset($_SESSION['valid']) || $_SESSION['valid'] !== true) {
    header("Location: login.php");
    exit();
}

// Check if the event ID is provided in the URL
if(isset($_GET['event_id'])) {
    $eventID = $_GET['event_id'];

    // Perform database query to retrieve event details based on EventID
    $con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
    if (!$con) {
        die('Could not connect: ' . mysqli_connect_error());
    }
    mysqli_select_db($con, 'library');

    // Query to retrieve event details
    $query = "SELECT * FROM events WHERE EventID = '$eventID'";
    $result = mysqli_query($con, $query);
    
    if(mysqli_num_rows($result) > 0) {
        // Display event details
        $row = mysqli_fetch_assoc($result);
        echo "<h2>Event Details</h2>";
        echo "<p>Event Name: {$row['EventName']}</p>";
        echo "<p>Description: {$row['Description']}</p>";
        
        // Format date in Month Day, Year format (e.g., January 1, 2023)
        $formattedDate = date("F j, Y", strtotime($row['Date']));
        echo "<p>Date: $formattedDate</p>";
        
        // Format start and end time in 12-hour format with AM/PM
        $startTime = date("g:i A", strtotime($row['StartTime']));
        $endTime = date("g:i A", strtotime($row['EndTime']));
        echo "<p>Time: $startTime - $endTime</p>";
        
        echo "<p>Location: {$row['Location']}</p>";
        echo "<p>Categories: {$row['Categories']}</p>";
        echo "<p>Type: {$row['Type']}</p>";
        
        // Calculate spots left
        $spotsLeft = $row['MaxAttendees'] - $row['Attendees'];
        echo "<p>Spots Left: $spotsLeft</p>";

        // Display Register button if spots are available
        if ($spotsLeft > 0) {
            echo "<form action='action_register.php' method='post'>";
            echo "<input type='hidden' name='EventID' value='{$row['EventID']}'>";
            echo "<button type='submit'>Register! - $spotsLeft spots left</button>";
            echo "</form>";
        } else {
            echo "<p>No spots left for registration.</p>";
        }
    } else {
        echo "<p>No event details found for the provided Event ID.</p>";
    }

    mysqli_close($con);
} else {
    echo "<p>No Event ID provided.</p>";
}
?>

<!-- Add a link back to the home page -->
<p><a href="home.php">Back to Home</a></p>
