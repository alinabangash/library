<?php
$con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}
mysqli_select_db($con, 'library');

// Get the StudentID from the form
$studentID = mysqli_real_escape_string($con, $_POST['StudentID']);

// Check if the student has books checked out
$check_books_sql = "SELECT COUNT(*) AS num_books_checked_out FROM checkouts WHERE StudentID='$studentID'";
$result = mysqli_query($con, $check_books_sql);
if (!$result) {
    die('Error checking books checked out: ' . mysqli_error($con));
}
$row = mysqli_fetch_assoc($result);
$num_books_checked_out = $row['num_books_checked_out'];

// If the student has books checked out, inform the user and provide options
if ($num_books_checked_out > 0) {
    echo "Error: This student has $num_books_checked_out books checked out and cannot be deleted.<br>";
    echo "<a href='delete_student.php'>Go back</a>";
} else {
    // Delete the student from the students table
    $delete_student_sql = "DELETE FROM students WHERE StudentID='$studentID'";
    if (!mysqli_query($con, $delete_student_sql)) {
        die('Error deleting student: ' . mysqli_error($con));
    }

    echo "Student removed successfully";
}

mysqli_close($con);
?>
