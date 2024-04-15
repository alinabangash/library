<?php
$con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

// Get the ISBN from the form
$ISBN = mysqli_real_escape_string($con, $_POST['ISBN']);

// Check if there are any references to this book in the holds table
$check_holds_sql = "SELECT COUNT(*) AS num_holds FROM holds WHERE ISBN='$ISBN'";
$result = mysqli_query($con, $check_holds_sql);
if (!$result) {
    die('Error checking holds: ' . mysqli_error($con));
}
$row = mysqli_fetch_assoc($result);
$num_holds = $row['num_holds'];

// If there are holds, inform the user and provide options
if ($num_holds > 0) {
    echo "Error: This book has $num_holds holds and cannot be deleted.<br>";
    echo "<a href='delete_book.php'>Go back</a>";
} else {
    // Delete the book from the books table
    $delete_book_sql = "DELETE FROM books WHERE ISBN='$ISBN'";
    if (!mysqli_query($con, $delete_book_sql)) {
        die('Error deleting book: ' . mysqli_error($con));
    }

    echo "Book removed successfully";
}

mysqli_close($con);
?>
