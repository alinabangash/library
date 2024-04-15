<?php
session_start(); // Start or resume the session

// Check if the StudentID is set in the session
if(isset($_SESSION['StudentID']) && !empty($_SESSION['StudentID'])) {
    $studentId = $_SESSION['StudentID'];
    
    // Perform database connection
    $con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
    if (!$con) {
        die('Could not connect: ' . mysqli_connect_error());
    }

    // Check the number of books currently checked out by the student
    $queryCheckCount = "SELECT COUNT(*) AS num_checked_out FROM checkouts WHERE StudentID = '$studentId' AND CheckInDate IS NULL";
    $resultCheckCount = mysqli_query($con, $queryCheckCount);
    $rowCheckCount = mysqli_fetch_assoc($resultCheckCount);
    $numCheckedOut = $rowCheckCount['num_checked_out'];

    // Allow checkout only if the student has checked out less than 2 books
    if($numCheckedOut >= 2) {
        echo "<p>You have already checked out the maximum number of books allowed.</p>";
    } else {
        // Continue with the checkout process
        if(isset($_POST['isbn']) && !empty($_POST['isbn'])) {
            $isbn = $_POST['isbn'];
            
            // Calculate the return date (7 days from now)
            $returnDate = date("Y-m-d", strtotime("+7 days"));
            
            // Get the current date
            $checkoutDate = date("Y-m-d");
            
            // Check if the book is available for checkout
            $queryCheck = "SELECT available, Stock FROM books WHERE ISBN = '$isbn'";
            $resultCheck = mysqli_query($con, $queryCheck);
            
            if(mysqli_num_rows($resultCheck) > 0) {
                $row = mysqli_fetch_assoc($resultCheck);
                $available = $row['available'];
                $stock = $row['Stock'];
                
                if($available > 0 && $available <= $stock) {
                    // Insert the checkout record into the checkouts table
                    $queryInsert = "INSERT INTO checkouts (ISBN, StudentID, CheckoutDate, ReturnDate) VALUES ('$isbn', '$studentId', '$checkoutDate', '$returnDate')";
                    $resultInsert = mysqli_query($con, $queryInsert);
                    
                    if($resultInsert) {
                        // Decrement the available column in the books table
                        $queryUpdate = "UPDATE books SET available = available - 1 WHERE ISBN = '$isbn'";
                        $resultUpdate = mysqli_query($con, $queryUpdate);
                        
                        if($resultUpdate) {
                            echo "<p>Book checked out successfully!</p>";
                        } else {
                            echo "<p>Failed to update book availability.</p>";
                        }
                    } else {
                        echo "<p>Failed to check out the book.</p>";
                    }
                } else {
                    echo "<p>The book is no longer available for checkout.</p>";
                }
            } else {
                echo "<p>Book not found.</p>";
            }
        } else {
            echo "<p>No ISBN provided.</p>";
        }
    }
    
    mysqli_close($con);
} else {
    echo "<p>Student ID not found in the session.</p>";
}
?>
<p><a href="home.php">Back to Home</a></p>
