<?php
$con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}


mysqli_select_db($con, 'jqian');

$rs = mysqli_query($con, "select * from Reader where username = '" . $_POST['id'] . "'");
$row = mysqli_fetch_array($rs, MYSQLI_ASSOC);

$modify_sql = "update Reader set username = '" . $_POST['username'] . "', user_city = '" . $_POST['user_city'] . "', email = '" . $_POST['email'] ."' where username = '" . $_POST['id'] . "'";

if (mysqli_query($con, $modify_sql)) {
    echo "Successful!";
} else {
    echo "Failed!";
}

mysqli_close($con);
