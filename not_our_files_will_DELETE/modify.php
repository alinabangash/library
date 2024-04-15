<?php
// Establishing database connection
$con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

$del_id = $_GET["id"];
$q = "SELECT * FROM Reader WHERE username = '" . $_GET['id'] . "'";

mysqli_select_db($con, 'jqian');
$rs = mysqli_query($con, "SELECT * FROM Reader WHERE username = '" . $_GET['id'] . "'");

if (!$rs) {
    die("No result for" . $del_id . "!");
}
?>

<html>
<head>
</head>
<body>

<form action="modify_finish.php" method="POST">
    <?php
    echo "<table>";
    echo "<input type='text' size=25 name='id' value='$del_id'>";
    while ($row = mysqli_fetch_assoc($rs)) {
        echo "username: <input type='text' size=10 name='username' value='" . $row['username'] . "'>";
        echo "<br />";
        echo "user_city: <input type='text' size=10 name='user_city' value='" . $row['user_city'] . "'>";
        echo "<br />";
        echo "email: <input type='text' size=10 name='email' value='" . $row['email'] . "'>";
        echo "<br />";
        echo "telephone: <input type='text' size=10 name='telephone' value='" . $row['telephone'] . "'>";
    }
    echo "</table>";
    ?>

    <input type="submit" name="submit" value="submit">
</form>

</body>
</html>
