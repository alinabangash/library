<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>CSCE813 Project 2 - Books with number of physicalcopies.php</title>
</head>
<body>

<?php
$con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}


mysqli_select_db($con, 'library');

// DISPLAY RESULTS
echo "<br />";

$results = mysqli_query($con, "SELECT books.ISBN, books.Title, books.Author, books.Publisher, COUNT(*) AS copy_count FROM Book INNER JOIN PhysicalCopy ON books.Title = PhysicalCopy.title GROUP BY books.Title");

print("Books with number of PhysicalCopy: ");

while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
    print("<ul>");
    print("<li> ISBN: " . $row['ISBN'] . "</li>");
    print("<li> Title: " . $row['Title'] . "</li>");
    print("<li> Author: " . $row['Author'] . "</li>");
    print("<li> Publisher: " . $row['Publisher'] . "</li>");
    print("<li> Number of Physical Copies: " . $row['copy_count'] . "</li>");
    print("</ul>");
}

mysqli_close($con);
?>

</body>
</html>
