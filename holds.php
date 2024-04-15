<?php
session_start();

// Check if the StudentID is set in the session
if(isset($_SESSION['StudentID']) && !empty($_SESSION['StudentID'])) {
    $studentId = $_SESSION['StudentID'];
    
    // Perform database connection
    $con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
    if (!$con) {
        die('Could not connect: ' . mysqli_connect_error());
    }

    // Get the ISBN from the form submission
    if(isset($_POST['isbn']) && !empty($_POST['isbn'])) {
        $isbn = $_POST['isbn'];
        
        // Get the current date
        $holdDate = date("Y-m-d");
        
        // Insert the hold request into the holds table
        $queryInsert = "INSERT INTO holds (ISBN, StudentID, HoldDate) VALUES ('$isbn', '$studentId', '$holdDate')";
        $resultInsert = mysqli_query($con, $queryInsert);
        
        if($resultInsert) {
            echo "<p>Hold request placed successfully!</p>";
        } else {
            echo "<p>Failed to place hold request.</p>";
        }
    } else {
        echo "<p>No ISBN provided.</p>";
    }
    
    mysqli_close($con);
} else {
    echo "<p>Student ID not found in the session.</p>";
}