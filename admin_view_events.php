<?php
session_start();
if (!isset($_SESSION['valid']) || $_SESSION['valid'] !== true) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Events and Attendees</title>
<link rel="stylesheet" href="styles/MainPage.css">
<link rel="stylesheet" href="styles/table.css"> <!-- Add the table.css file -->
</head>
<body>
<div class="homeContent">
  <h2>All Events and Attendees</h2>
  <?php
  // Perform database query to retrieve all events and their attendees
  $con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
  if (!$con) {
      die('Could not connect: ' . mysqli_connect_error());
  }
  mysqli_select_db($con, 'library');

  // Query to retrieve all events and their attendees
  $query = "SELECT events.EventID, events.EventName, events.Date, TIME_FORMAT(events.StartTime, '%h:%i %p') AS StartTime, TIME_FORMAT(events.EndTime, '%h:%i %p') AS EndTime, events.Location, events.Categories, events.Type, events.MaxAttendees, IFNULL(COUNT(event_attendees.StudentID), 0) AS Attendees, events.Status, events.CreatedDate, events.UpdatedDate FROM events LEFT JOIN event_attendees ON events.EventID = event_attendees.EventID GROUP BY events.EventID";
  $result = mysqli_query($con, $query);

  if(mysqli_num_rows($result) > 0) {
      // Display events and their attendees in a table with the resultsTable class
      echo "<table class='resultsTable'>";
      echo "<tr><th>Event ID</th><th>Event Name</th><th>Date</th><th>Start Time</th><th>End Time</th><th>Location</th><th>Categories</th><th>Type</th><th>Max Attendees</th><th>Attendees</th><th>Status</th><th>Created Date</th><th>Updated Date</th></tr>";
      while($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td><a href='admin_view_event_attendees.php?event_id={$row['EventID']}'>{$row['EventID']}</a></td>";
          echo "<td><a href='details_event.php?event_id={$row['EventID']}'>{$row['EventName']}</a></td>";
          echo "<td>{$row['Date']}</td>";
          echo "<td>{$row['StartTime']}</td>";
          echo "<td>{$row['EndTime']}</td>";
          echo "<td>{$row['Location']}</td>";
          echo "<td>{$row['Categories']}</td>";
          echo "<td>{$row['Type']}</td>";
          echo "<td>{$row['MaxAttendees']}</td>";
          echo "<td>{$row['Attendees']}</td>";
          echo "<td>{$row['Status']}</td>";
          echo "<td>{$row['CreatedDate']}</td>";
          echo "<td>{$row['UpdatedDate']}</td>";
          echo "</tr>";
      }
      echo "</table>";
  } else {
      echo "<p>No events found.</p>";
  }

  mysqli_close($con);
  ?>
  <!-- Add a link back to the home page -->
  <p><a href="home.php">Back to Home</a></p>
</div>
</body>
</html>
