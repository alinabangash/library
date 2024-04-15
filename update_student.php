<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
</head>
<body>

    <h2>Update Student</h2>

    <form action="revise_student.php" method="post">
        Student ID: <input type="text" name="StudentID" required><br>
        First Name: <input type="text" name="FirstName"><br>
        Last Name: <input type="text" name="LastName"><br>
        Date of Birth: <input type="date" name="DateOfBirth"><br>
        Gender:
        <select name="Gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select><br>
        Address: <input type="text" name="Address"><br>
        Contact Number: <input type="number" name="ContactNumber"><br>
        Email Address: <input type="email" name="EmailAddress"><br>
        Grade Year Level:
        <select name="GradeYearLevel">
            <option value="Freshmen">Freshmen</option>
            <option value="Sophomore">Sophomore</option>
            <option value="Junior">Junior</option>
            <option value="Senior">Senior</option>
        </select><br>
        Status:
        <select name="Status">
            <option value="Enrolled">Enrolled</option>
            <option value="Dropped">Dropped</option>
        </select><br>
        Password: <input type="password" name="Password"><br>
        <input type="submit" value="Update">
    </form>

</body>
</html>
