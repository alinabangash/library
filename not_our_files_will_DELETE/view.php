<?php
// Establishing database connection
$con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

mysqli_select_db($con, 'jqian');

$q="select * from Reader";
$rs=mysqli_query($con, $q);

echo"<table>";
echo"<tr><td>action</td><td>username</td><td>user_city</td><td>email</td><td>telephone</td></tr>";
while($row=mysqli_fetch_row($rs)) 
echo "<tr><td><a href='modify.php?id=$row[0]'>modify</a></td><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td><td>$row[6]</td><td>$row[7]</td><td>$row[8]</td><td>$row[9]</td><td>$row[10]</td><td>$row[11]</td><td>$row[12]</td><td>$row[13]</td></tr>"; 
echo "</table>"; 
