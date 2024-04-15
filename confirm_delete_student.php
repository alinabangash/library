<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Delete Student</title>
</head>
<body>
    <?php
    $con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
    if (!$con) {
        die('Could not connect: ' . mysqli_connect_error());
    }
    mysqli_select_db($con, 'library');

    // Retrieve StudentID from the form
    $studentID = mysqli_real_escape_string($con, $_POST['StudentID']);

    // Query to get student information
    $sql = "SELECT * FROM students WHERE StudentID = '$studentID'";
    $result = mysqli_query($con, $sql);

    // Check if student exists
    if (mysqli_num_rows($result) > 0) {
        // Fetch student data
        $studentData = mysqli_fetch_assoc($result);
        ?>
        <h2>Confirm Delete Student</h2>
        <h3>Student Information:</h3>
        <p><strong>Student ID:</strong> <?php echo $studentData['StudentID']; ?></p>
        <p><strong>First Name:</strong> <?php echo $studentData['FirstName']; ?></p>
        <p><strong>Last Name:</strong> <?php echo $studentData['LastName']; ?></p>
        <p><strong>Date of Birth:</strong> <?php echo $studentData['DateOfBirth']; ?></p>
        <p><strong>Gender:</strong> <?php echo $studentData['Gender']; ?></p>
        <p><strong>Address:</strong> <?php echo $studentData['Address']; ?></p>
        <p><strong>Contact Number:</strong> <?php echo $studentData['ContactNumber']; ?></p>
        <p><strong>Email Address:</strong> <?php echo $studentData['EmailAddress']; ?></p>
        <p><strong>Grade Year Level:</strong> <?php echo $studentData['GradeYearLevel']; ?></p>
        <p><strong>Status:</strong> <?php echo $studentData['Status']; ?></p>
        <!-- Add more fields if needed -->
        <form action="remove_student.php" method="post">
            <input type="hidden" name="StudentID" value="<?php echo $studentID; ?>">
            <button type="submit">Yes, Delete Student</button>
        </form>
        <form action="delete_student.php" method="post">
            <button type="submit">No, Go Back</button>
        </form>
    <?php
    } else {
        // If student does not exist, display an error message
        echo "Student not found.";
    }

    // Close database connection
    mysqli_close($con);
    ?>
</body>
</html>
