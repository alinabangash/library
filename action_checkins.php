<?php
session_start(); // Start or resume the session

// Check if the StudentID is set in the session
if(isset($_SESSION['StudentID']) && !empty($_SESSION['StudentID'])) {
    $studentId = $_SESSION['StudentID'];
    
    // Perform database query to update checkout record
    $con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
    if (!$con) {
        die('Could not connect: ' . mysqli_connect_error());
    }
    mysqli_select_db($con, 'library');
    
    // Get the ISBN from the form submission
    if(isset($_POST['isbn']) && !empty($_POST['isbn'])) {
        $isbn = $_POST['isbn'];
        
        // Update the CheckInDate column in the checkouts table
        $checkInDate = date("Y-m-d");
        $queryUpdate = "UPDATE checkouts 
                        SET CheckInDate = '$checkInDate' 
                        WHERE ISBN = '$isbn' AND StudentID = '$studentId' AND CheckInDate IS NULL
                        ORDER BY CheckoutDate ASC, CheckOutID ASC
                        LIMIT 1";
        $resultUpdate = mysqli_query($con, $queryUpdate);
        
        if($resultUpdate) {
            // Increment the available column in the books table
            $queryUpdateAvail = "UPDATE books SET available = available + 1 WHERE ISBN = '$isbn'";
            $resultUpdateAvail = mysqli_query($con, $queryUpdateAvail);
            
            if($resultUpdateAvail) {
                echo "<p>Book checked in successfully!</p>";
            } else {
                echo "<p>Failed to update book availability.</p>";
            }
        } else {
            echo "<p>Failed to check in the book.</p>";
        }
    } else {
        echo "<p>No ISBN provided.</p>";
    }
    
    mysqli_close($con);
} else {
    echo "<p>Student ID not found in the session.</p>";
}
?>
<p><a href="home.php">Back to Home</a></p>
