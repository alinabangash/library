<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Delete Staff</title>
</head>
<body>
    <?php
    $con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
    if (!$con) {
        die('Could not connect: ' . mysqli_connect_error());
    }
    mysqli_select_db($con, 'library');

    // Retrieve StaffID from the form
    $staffID = mysqli_real_escape_string($con, $_POST['StaffID']);

    // Query to get staff information
    $sql = "SELECT * FROM staff WHERE StaffID = '$staffID'";
    $result = mysqli_query($con, $sql);

    // Check if staff exists
    if (mysqli_num_rows($result) > 0) {
        // Fetch staff data
        $staffData = mysqli_fetch_assoc($result);
        ?>
        <h2>Confirm Delete Staff</h2>
        <h3>Staff Information:</h3>
        <p><strong>Staff ID:</strong> <?php echo $staffData['StaffID']; ?></p>
        <p><strong>First Name:</strong> <?php echo $staffData['FirstName']; ?></p>
        <p><strong>Last Name:</strong> <?php echo $staffData['LastName']; ?></p>
        <p><strong>Date of Birth:</strong> <?php echo $staffData['DateOfBirth']; ?></p>
        <p><strong>Gender:</strong> <?php echo $staffData['Gender']; ?></p>
        <p><strong>Address:</strong> <?php echo $staffData['Address']; ?></p>
        <p><strong>Contact Number:</strong> <?php echo $staffData['ContactNumber']; ?></p>
        <p><strong>Email Address:</strong> <?php echo $staffData['EmailAddress']; ?></p>
        <p><strong>Position:</strong> <?php echo $staffData['Position']; ?></p>
        <p><strong>Date Hired:</strong> <?php echo $staffData['DateHired']; ?></p>
        <p><strong>Status:</strong> <?php echo $staffData['Status']; ?></p>
        <!-- Add more fields if needed -->
        <form action="remove_staff.php" method="post">
            <input type="hidden" name="StaffID" value="<?php echo $staffID; ?>">
            <button type="submit">Yes, Delete Staff</button>
        </form>
        <form action="delete_staff.php" method="post">
            <button type="submit">No, Go Back</button>
        </form>
    <?php
    } else {
        // If staff does not exist, display an error message
        echo "Staff not found.";
    }

    // Close database connection
    mysqli_close($con);
    ?>
</body>
</html>
