<?php
// Establish connection to the database
$con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');

// Check if the connection is successful
if (!$con) {
    // If connection fails, display an error message and terminate the script
    die('Could not connect: ' . mysqli_connect_error());
}

// Select the database
mysqli_select_db($con, 'library');

// Prepare the SQL query to insert faculty data into the database
$sql = "INSERT INTO faculty (FacultyID, FirstName, LastName, DateOfBirth, Gender, Address, ContactNumber, EmailAddress, Department, Position, DateHired, Status, CreatedDate, UpdatedDate, Password) VALUES ('" . $_POST['FacultyID'] . "','" . $_POST['FirstName'] . "','" . $_POST['LastName'] . "', '" . $_POST['DateOfBirth'] . "', '" . $_POST['Gender'] . "', '" . $_POST['Address'] . "', '" . $_POST['ContactNumber'] . "', '" . $_POST['EmailAddress'] . "', '" . $_POST['Department'] . "', '" . $_POST['Position'] . "', '" . $_POST['DateHired'] . "', '" . $_POST['Status'] . "', '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', '" . $_POST['Password'] . "')";

// Execute the SQL query
if (!mysqli_query($con, $sql)) {
    // If the query execution fails, display an error message and terminate the script
    die('Error: ' . mysqli_error($con));
}

// If insertion is successful, display a success message
echo "1 record added";

// Close the database connection
mysqli_close($con);
?>
