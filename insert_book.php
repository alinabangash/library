<?php
$con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

// Set Available to the same value as Stock and Holds to 0
$_POST['Available'] = $_POST['Stock'];
$_POST['Holds'] = 0;

// SQL command that inserts into the books table
$sql = "INSERT INTO books (ISBN, Title, Author, Publisher, PublicationYear, Genre, Description, Language, CoverImage, Stock, Available, Holds, PageCount, Format) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare the SQL statement
$stmt = mysqli_prepare($con, $sql);
if (!$stmt) {
    die('Error: ' . mysqli_error($con));
}

// Bind parameters with the values from the POST array
mysqli_stmt_bind_param($stmt, 'ssssisssssiiis', $_POST['ISBN'], $_POST['Title'], $_POST['Author'], $_POST['Publisher'], $_POST['PublicationYear'], $_POST['Genre'], $_POST['Description'], $_POST['Language'], $_POST['CoverImage'], $_POST['Stock'], $_POST['Available'], $_POST['Holds'], $_POST['PageCount'], $_POST['Format']);

// Execute the statement
if (!mysqli_stmt_execute($stmt)) {
    die('Error: ' . mysqli_stmt_error($stmt));
}

echo "1 book record added";

// Close the statement
mysqli_stmt_close($stmt);

mysqli_close($con);

// Redirect to add_book.php after 1 second
header("refresh:1;url=add_book.php");