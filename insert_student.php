<?php
$con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}
mysqli_select_db($con, 'library');

$sql = "INSERT INTO students (StudentID, `FirstName`, `LastName`, DateOfBirth, Gender, Address, ContactNumber, EmailAddress, GradeYearLevel, Status, CreatedDate, UpdatedDate, Password) VALUES ('" . $_POST['StudentID'] . "','" . $_POST['FirstName'] . "','" . $_POST['LastName'] . "', '" . $_POST['DateOfBirth'] . "', '" . $_POST['Gender'] . "', '" . $_POST['Address'] . "', '" . $_POST['ContactNumber'] . "', '" . $_POST['EmailAddress'] . "', '" . $_POST['GradeYearLevel'] . "', '" . $_POST['Status'] . "', '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', '" . $_POST['Password'] . "')";

if (!mysqli_query($con, $sql)) {
  die('Error: ' . mysqli_error($con));
}
echo "1 record added";

mysqli_close($con);
?>
