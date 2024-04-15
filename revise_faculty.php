<?php
$con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}
mysqli_select_db($con, 'library');

// Assuming FacultyID is the primary key
$facultyID = mysqli_real_escape_string($con, $_POST['FacultyID']);

// Construct the update query
$sql = "UPDATE faculty SET ";

// Check each field individually and append to the query if it's provided in the form
if (!empty($_POST['FirstName'])) {
    $sql .= "FirstName='" . $_POST['FirstName'] . "', ";
}
if (!empty($_POST['LastName'])) {
    $sql .= "LastName='" . $_POST['LastName'] . "', ";
}
if (!empty($_POST['DateOfBirth'])) {
    $sql .= "DateOfBirth='" . $_POST['DateOfBirth'] . "', ";
}
if (!empty($_POST['Gender'])) {
    $sql .= "Gender='" . $_POST['Gender'] . "', ";
}
if (!empty($_POST['Address'])) {
    $sql .= "Address='" . $_POST['Address'] . "', ";
}
if (!empty($_POST['ContactNumber'])) {
    $sql .= "ContactNumber='" . $_POST['ContactNumber'] . "', ";
}
if (!empty($_POST['EmailAddress'])) {
    $sql .= "EmailAddress='" . $_POST['EmailAddress'] . "', ";
}
if (!empty($_POST['Department'])) {
    $sql .= "Department='" . $_POST['Department'] . "', ";
}
if (!empty($_POST['Position'])) {
    $sql .= "Position='" . $_POST['Position'] . "', ";
}
if (!empty($_POST['DateHired'])) {
    $sql .= "DateHired='" . $_POST['DateHired'] . "', ";
}
if (!empty($_POST['Status'])) {
    $sql .= "Status='" . $_POST['Status'] . "', ";
}
if (!empty($_POST['Password'])) {
    $sql .= "Password='" . $_POST['Password'] . "', ";
}

// Append the UpdatedDate field with the current date and time
$sql .= "UpdatedDate='" . date('Y-m-d H:i:s') . "' ";

// Remove the trailing comma and space from the query string
$sql = rtrim($sql, ", ");

// Add the WHERE clause to specify which record to update
$sql .= " WHERE FacultyID='$facultyID'";

// Execute the query
if (!mysqli_query($con, $sql)) {
    die('Error: ' . mysqli_error($con));
}

echo "Record updated successfully";

mysqli_close($con);
?>
