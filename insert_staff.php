<?php
$con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

// Set default timezone to prevent date related issues
date_default_timezone_set('UTC');

// Get current date and time
$createdDate = date('Y-m-d H:i:s');
$updatedDate = date('Y-m-d H:i:s');

// Prepare the SQL statement
$stmt = mysqli_prepare($con, "INSERT INTO staff (StaffID, FirstName, LastName, DateOfBirth, Gender, Address, ContactNumber, EmailAddress, Position, DateHired, Status, CreatedDate, UpdatedDate, Password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    die('Error: ' . mysqli_error($con));
}

// Bind parameters with the values from the POST array
mysqli_stmt_bind_param($stmt, 'isssssssssssss', $_POST['StaffID'], $_POST['FirstName'], $_POST['LastName'], $_POST['DateOfBirth'], $_POST['Gender'], $_POST['Address'], $_POST['ContactNumber'], $_POST['EmailAddress'], $_POST['Position'], $_POST['DateHired'], $_POST['Status'], $createdDate, $updatedDate, $_POST['Password']);

// Execute the statement
if (!mysqli_stmt_execute($stmt)) {
    die('Error: ' . mysqli_stmt_error($stmt));
}

echo "1 record added";

// Close the statement
mysqli_stmt_close($stmt);

mysqli_close($con);
?>
