<?php
$con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}
mysqli_select_db($con, 'library');

// Get the StaffID from the form
$staffID = mysqli_real_escape_string($con, $_POST['StaffID']);

// Check if the staff has any associated data (e.g., records in other tables)
// You can add additional checks here if necessary

// Delete the staff from the staff table
$delete_staff_sql = "DELETE FROM staff WHERE StaffID='$staffID'";
if (!mysqli_query($con, $delete_staff_sql)) {
    die('Error deleting staff: ' . mysqli_error($con));
}

echo "Staff removed successfully";

mysqli_close($con);
?>
