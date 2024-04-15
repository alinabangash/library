<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Delete Faculty</title>
</head>
<body>
    <?php
    $con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
    if (!$con) {
        die('Could not connect: ' . mysqli_connect_error());
    }
    mysqli_select_db($con, 'library');

    // Retrieve FacultyID from the form
    $facultyID = mysqli_real_escape_string($con, $_POST['FacultyID']);

    // Query to get faculty information
    $sql = "SELECT * FROM faculty WHERE FacultyID = '$facultyID'";
    $result = mysqli_query($con, $sql);

    // Check if faculty exists
    if (mysqli_num_rows($result) > 0) {
        // Fetch faculty data
        $facultyData = mysqli_fetch_assoc($result);
        ?>
        <h2>Confirm Delete Faculty</h2>
        <h3>Faculty Information:</h3>
        <p><strong>Faculty ID:</strong> <?php echo $facultyData['FacultyID']; ?></p>
        <p><strong>First Name:</strong> <?php echo $facultyData['FirstName']; ?></p>
        <p><strong>Last Name:</strong> <?php echo $facultyData['LastName']; ?></p>
        <p><strong>Date of Birth:</strong> <?php echo $facultyData['DateOfBirth']; ?></p>
        <p><strong>Gender:</strong> <?php echo $facultyData['Gender']; ?></p>
        <p><strong>Address:</strong> <?php echo $facultyData['Address']; ?></p>
        <p><strong>Contact Number:</strong> <?php echo $facultyData['ContactNumber']; ?></p>
        <p><strong>Email Address:</strong> <?php echo $facultyData['EmailAddress']; ?></p>
        <p><strong>Department:</strong> <?php echo $facultyData['Department']; ?></p>
        <p><strong>Position:</strong> <?php echo $facultyData['Position']; ?></p>
        <p><strong>Date Hired:</strong> <?php echo $facultyData['DateHired']; ?></p>
        <p><strong>Status:</strong> <?php echo $facultyData['Status']; ?></p>
        <!-- Add more fields if needed -->
        <form action="remove_faculty.php" method="post">
            <input type="hidden" name="FacultyID" value="<?php echo $facultyID; ?>">
            <button type="submit">Yes, Delete Faculty</button>
        </form>
        <form action="delete_faculty.php" method="post">
            <button type="submit">No, Go Back</button>
        </form>
    <?php
    } else {
        // If faculty does not exist, display an error message
        echo "Faculty not found.";
    }

    // Close database connection
    mysqli_close($con);
    ?>
</body>
</html>
