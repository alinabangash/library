<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>CSCE813 Project 2 - Total current fines for each reader until 11/01/2012, fines.php</title>
</head>
<body>

<?php
$con = mysqli_connect('cse.unl.edu', 'jqian', 'e_G95@');
if(!$con) {
  die("Could not connect:" . mysqli_connect_error());
}

mysqli_select_db($con, 'jqian');

// DISPLAY RESULTS
echo"<br />";

$results = mysqli_query($con, "SELECT Reader.username, Reader.user_city, Reader.email, Reader.telephone, Loan.dateIn, Loan.duedate, PhysicalCopy.overdueChargePerDay FROM Reader, Loan, PhysicalCopy where Reader.username = Loan.username Group by Reader.username");

print("Total current fines for each reader until 11/01/2012: ");

while($row = mysqli_fetch_array($results, MYSQLI_ASSOC))
{
print("<ul>");
print("<li> Username: " . $row['username'] . "</li>");
print("<li> User_city: " . $row['user_city'] . "</li>");
print("<li> E-mail: " . $row['email'] . "</li>");
print("<li> Telephone: " . $row['telephone'] . "</li>");

// Assuming $row['dateIn'] and $row['duedate'] are properly formatted date strings
$days = strtotime("2012-11-01") - strtotime($row['duedate']);
$fine = ($days > 0) ? $days * $row['overdueChargePerDay'] : 0;
print("<li> current fine: " . $fine . "</li>");

print("</ul>");
}

mysqli_close($con);
?>

</body>
</html>
