<?php
// Define the interval in seconds
$interval = 10;

while (true) {
    // Connect to the database
    $con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
    if (!$con) {
        die('Could not connect: ' . mysqli_connect_error());
    }
    mysqli_select_db($con, 'library');

    // Query books with available copies
    $query = "SELECT * FROM books WHERE available > 0";
    $result = mysqli_query($con, $query);

    // Loop through each book with available copies
    while ($book = mysqli_fetch_assoc($result)) {
        $isbn = $book['ISBN'];

        // Check if there are holds for this book, ordered by HoldID in ascending order
        $holdQuery = "SELECT * FROM holds WHERE ISBN = '$isbn' AND Status = 'pending' ORDER BY HoldID ASC";
        $holdResult = mysqli_query($con, $holdQuery);

        // If there are holds, process them
        if (mysqli_num_rows($holdResult) > 0) {
            $hold = mysqli_fetch_assoc($holdResult);
            $studentId = $hold['StudentID'];

            // Check out the book to the student
            $checkoutDate = date("Y-m-d");
            $returnDate = date("Y-m-d", strtotime("+7 days")); // Example return date

            $checkoutQuery = "INSERT INTO checkouts (ISBN, StudentID, CheckoutDate, ReturnDate) VALUES ('$isbn', '$studentId', '$checkoutDate', '$returnDate')";
            $checkoutResult = mysqli_query($con, $checkoutQuery);

            if ($checkoutResult) {
                // Update hold status to fulfilled
                $holdId = $hold['HoldID'];
                $updateHoldQuery = "UPDATE holds SET Status = 'fulfilled' WHERE HoldID = $holdId";
                mysqli_query($con, $updateHoldQuery);

                // Decrement available count in books table
                $updateBooksQuery = "UPDATE books SET available = available - 1 WHERE ISBN = '$isbn'";
                mysqli_query($con, $updateBooksQuery);

                echo "Book with ISBN $isbn checked out to Student ID $studentId.\n";
            } else {
                echo "Failed to check out book with ISBN $isbn to Student ID $studentId.\n";
            }
        }
    }

    // Close database connection
    mysqli_close($con);

    // Wait for the specified interval before running the script again
    sleep($interval);
}
