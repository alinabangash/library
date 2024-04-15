<?php
$con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}
mysqli_select_db($con, 'library');

$facultyID = $_POST['FacultyID'];
$firstName = $_POST['FirstName'];
$lastName = $_POST['LastName'];
$dateOfBirth = $_POST['DateOfBirth'];
$gender = $_POST['Gender'];
$address = $_POST['Address'];
$contactNumber = $_POST['ContactNumber'];
$emailAddress = $_POST['EmailAddress'];
$department = $_POST['Department'];
$position = $_POST['Position'];
$schoolIDNumber = $_POST['SchoolIDNumber'];
$dateHired = $_POST['DateHired'];
$status = $_POST['Status'];
$createdDate = $_POST['CreatedDate'];
$updatedDate = $_POST['UpdatedDate'];
$password = $_POST['Password'];

$sql = "INSERT INTO faculty (FacultyID, FirstName, LastName, DateOfBirth, Gender, Address, ContactNumber, EmailAddress, Department, Position, SchoolIDNumber, DateHired, Status, CreatedDate, UpdatedDate, Password) 
        VALUES ('$facultyID', '$firstName', '$lastName', '$dateOfBirth', '$gender', '$address', '$contactNumber', '$emailAddress', '$department', '$position', '$schoolIDNumber', '$dateHired', '$status', '$createdDate', '$updatedDate', '$password')";

if (!mysqli_query($con, $sql)) {
  die('Error: ' . mysqli_error($con));
}
echo "1 record added";

mysqli_close($con);