<?php
$con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}
mysqli_select_db($con, 'library');

// Get the ISBN from the form
$ISBN = mysqli_real_escape_string($con, $_POST['ISBN']);

// Initialize a variable to store the new value of 'Stock'
$newStock = '';

// Construct the update query
$sql = "UPDATE books SET ";

// Check each field individually and append to the query if it's provided in the form
if (!empty($_POST['Title'])) {
    $sql .= "Title='" . $_POST['Title'] . "', ";
}
if (!empty($_POST['Author'])) {
    $sql .= "Author='" . $_POST['Author'] . "', ";
}
if (!empty($_POST['Publisher'])) {
    $sql .= "Publisher='" . $_POST['Publisher'] . "', ";
}
if (!empty($_POST['PublicationYear'])) {
    $sql .= "PublicationYear='" . $_POST['PublicationYear'] . "', ";
}
if (!empty($_POST['Genre'])) {
    $sql .= "Genre='" . $_POST['Genre'] . "', ";
}
if (!empty($_POST['Description'])) {
    $sql .= "Description='" . $_POST['Description'] . "', ";
}
if (!empty($_POST['Language'])) {
    $sql .= "Language='" . $_POST['Language'] . "', ";
}
if (!empty($_POST['CoverImage'])) {
    $sql .= "CoverImage='" . $_POST['CoverImage'] . "', ";
}
if (!empty($_POST['Stock'])) {
    // If 'Stock' is edited, update 'Stock' and 'Available' fields
    $sql .= "Stock='" . $_POST['Stock'] . "', ";
    $newStock = $_POST['Stock']; // Store the new 'Stock' value
}
if (!empty($_POST['PageCount'])) {
    $sql .= "PageCount='" . $_POST['PageCount'] . "', ";
}
if (!empty($_POST['Format'])) {
    $sql .= "Format='" . $_POST['Format'] . "', ";
}

// If 'Stock' is edited, update 'Available' field with the same value
if ($newStock !== '') {
    $sql .= "Available='" . $newStock . "', ";
}

// Append the UpdatedDate field with the current date and time
$sql .= "UpdatedDate='" . date('Y-m-d H:i:s') . "' ";

// Remove the trailing comma and space from the query string
$sql = rtrim($sql, ", ");

// Add the WHERE clause to specify which record to update
$sql .= " WHERE ISBN='$ISBN'";

// Execute the query
if (!mysqli_query($con, $sql)) {
    die('Error: ' . mysqli_error($con));
}

echo "Record updated successfully";

mysqli_close($con);
?>
