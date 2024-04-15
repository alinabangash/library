<!DOCTYPE html>
<html>
<head>
    <title>CSCE813 Project 2 - Modify the overduechargeperday of physicalcopy modify_overduechargeperday.php</title>
</head>
<body>

<?php
// Establishing database connection
$con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

mysqli_select_db($con, 'jqian');

if (isset($_GET['title'])) {

    // DISPLAY RESULTS
    print("The selected book title: " . $_GET['title'] . "\n");
    echo "<br />";

    $sql = "UPDATE PhysicalCopy SET overdueChargePerDay = '" . $_GET['overdueChargePerDay'] . "' WHERE title =  '" . $_GET['title'] . "'";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }

    echo "The overduechargeperday of the chosen book is modified!";
    echo "<br />";

    $results = mysqli_query($con, "SELECT * FROM PhysicalCopy WHERE title = '" . $_GET['title'] . "'");
    $row = mysqli_fetch_array($results, MYSQLI_ASSOC);
    print("PhysicalCopy's information: ");
    print("<ul>");
    print("<li> Title: " . $row['title'] . "</li>");
    print("<li> OverdueChargePerDay: " . $row['overdueChargePerDay'] . "</li>");
    print("</ul>");

} else {
?>

<form action="modify_overduechargeperday.php" method="GET">
    <div>
        <select name="title" id="title">
            <option value="blank">Select One Book Title</option>
            <option value="Computer Architecture">Computer Architecture</option>
            <option value="Introduction to Algorithms">Introduction to Algorithms</option>
            <option value="Mastering Linux">Mastering Linux</option>
            <option value="Introduction to Java Programming">Introduction to Java Programming</option>
            <option value="System Architecture">System Architecture</option>
        </select>

        <br><br>

        New OverdueChargePerday: <input type="text" name="overdueChargePerDay" />
        <input type="submit" />
    </div>
</form>

<?php
}
?>

</body>
</html>
