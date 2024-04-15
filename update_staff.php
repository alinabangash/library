<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Staff</title>
</head>
<body>

    <h2>Update Staff</h2>

    <form action="revise_staff.php" method="post">
        Staff ID: <input type="number" name="StaffID" required><br>
        First Name: <input type="text" name="FirstName"><br>
        Last Name: <input type="text" name="LastName"><br>
        Date of Birth: <input type="date" name="DateOfBirth"><br>
        Gender:
        <select name="Gender">
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select><br>
        Address: <input type="text" name="Address"><br>
        Contact Number: <input type="text" name="ContactNumber"><br>
        Email Address: <input type="email" name="EmailAddress"><br>
        Position: 
        <select name="Position">
            <option value="">Select Position</option>
            <option value="Librarian">Librarian</option>
            <option value="IT Specialist">IT Specialist</option>
            <option value="Clerk">Clerk</option>
            <option value="Security">Security</option>
            <option value="Admin">Admin</option>
        </select><br>
        Date Hired: <input type="date" name="DateHired"><br>
        Status:
        <select name="Status">
            <option value="">Select Status</option>
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
        </select><br>
        Password: <input type="password" name="Password"><br>
        <input type="submit" value="Update">
    </form>

</body>
</html>
