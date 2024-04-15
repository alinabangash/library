<?php
$con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

// Set Available to the same value as Stock and Holds to 0
$_POST['Available'] = $_POST['Stock'];
$_POST['Holds'] = 0;

// Get DigitalID from POST data
$DigitalID = $_POST['DigitalID'];

// SQL command that inserts into the digital_media_items table
$sql = "INSERT INTO digitalitems (DigitalID, Title, Author, Format, Publisher, PublicationYear, Genre, Description, Language, CoverImage, Stock, Available, Holds) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare the SQL statement
$stmt = mysqli_prepare($con, $sql);
if (!$stmt) {
    die('Error: ' . mysqli_error($con));
}

// Bind parameters with the values from the POST array
mysqli_stmt_bind_param($stmt, 'isssisssssiii', $DigitalID, $_POST['Title'], $_POST['Author'], $_POST['Format'], $_POST['Publisher'], $_POST['PublicationYear'], $_POST['Genre'], $_POST['Description'], $_POST['Language'], $_POST['CoverImage'], $_POST['Stock'], $_POST['Available'], $_POST['Holds']);

// Execute the statement
if (!mysqli_stmt_execute($stmt)) {
    die('Error: ' . mysqli_stmt_error($stmt));
}

echo "1 digital item added";

// Close the statement
mysqli_stmt_close($stmt);

mysqli_close($con);
?>
