<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>CSCE813 Project 2 - Duedate of physicalcopies being borrowed.php</title>
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
//print("The selected reader name: " . $_GET['userName'] . "\n" );
echo"<br />";

//$results = mysqli_query($con, "SELECT Book.ISBN, Book.title, Book.author, Book.publisher, PhysicalCopy.title.count(*) FROM Book, PhysicalCopy where Book.title = PhysicalCopy.title and group by PhysicalCopy.title");
$results = mysqli_query($con, "SELECT PhysicalCopy.catalogNo, PhysicalCopy.title, PhysicalCopy.overdueChargePerDay, Loan.duedate FROM PhysicalCopy, Loan where PhysicalCopy.catalogNo = Loan.catalogNo and Loan.dateIn is NULL order by catalogNo");

print("Duedate of physicalcopies being borrowed sorted by catalogNo: ");

while($row = mysqli_fetch_array($results, MYSQLI_ASSOC))
{
print("<ul>");
print("<li> CatalogNo: " . $row['catalogNo'] . "</li>");
print("<li> Title: " . $row['title'] . "</li>");
print("<li> OverduechagePerDay: " . $row['overdueChargePerDay'] . "</li>");
print("<li> duedate: " . $row['duedate'] . "</li>");
//print("<li> Number of Physical Copies: " . $row['count(*)'] . "</li>");
print("</ul>");
}

mysqli_close($con);
?>

</body>
</html>
