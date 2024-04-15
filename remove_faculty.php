<?php
$con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}
mysqli_select_db($con, 'library');

// Get the FacultyID from the form
$facultyID = mysqli_real_escape_string($con, $_POST['FacultyID']);

// Check if the faculty has any associated data (e.g., records in other tables)
// You can add additional checks here if necessary

// Delete the faculty from the faculty table
$delete_faculty_sql = "DELETE FROM faculty WHERE FacultyID='$facultyID'";
if (!mysqli_query($con, $delete_faculty_sql)) {
    die('Error deleting faculty: ' . mysqli_error($con));
}

echo "Faculty removed successfully";

mysqli_close($con);
?>
