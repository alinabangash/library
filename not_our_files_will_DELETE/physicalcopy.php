<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>CSCE813 Project 2 - PhysicalCopy.php</title>
</head>
<body>

<?php
// Establishing database connection
$con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

mysqli_select_db($con, 'jqian');

// DISPLAY RESULTS
echo "<br />";

$results = mysqli_query($con, "SELECT * FROM PhysicalCopy WHERE PhysicalCopy.catalogNo NOT IN (SELECT catalogNo FROM Loan)");

print("Books currently on hand for library: ");

while ($row = mysqli_fetch_assoc($results)) {
    echo "<ul>";
    echo "<li> catalogNo: " . $row['catalogNo'] . "</li>";
    echo "<li> title: " . $row['title'] . "</li>";
    echo "<li> overdueChargePerDay: " . $row['overdueChargePerDay'] . "</li>";
    echo "</ul>";
}

mysqli_close($con);
?>

</body>
</html>
