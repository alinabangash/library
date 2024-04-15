<head>
    <title>Add New Student</title>
    <script>
        window.onload = function() {
            var requiredInputs = document.querySelectorAll('input[required], select[required]');
            requiredInputs.forEach(function(input) {
                var label = document.createElement('label');
                label.textContent = '*';
                label.style.color = 'red'; // Change color as needed
                input.parentNode.insertBefore(label, input.nextSibling);
            });
        };
    </script>
</head>
<body>

    <!-- Add new student and modify the student information -->
    <form action="insert_student.php" method="post">
        Student ID: <input type="number" name="StudentID" required /><br>
        First Name: <input type="text" name="FirstName" required /><br>
        Last Name: <input type="text" name="LastName" required /><br>
        Date of Birth: <input type="date" name="DateOfBirth" value="<?php echo date('Y-m-d'); ?>" required /><br>
        Gender:
        <select name="Gender" required>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select><br>
        Address: <input type="text" name="Address" required /><br>
        Contact Number: <input type="number" name="ContactNumber" required /><br>
        Email Address: <input type="email" name="EmailAddress" required /><br>
        Grade Year Level:
        <select name="GradeYearLevel" required>
            <option value="">Select Grade Year Level</option>
            <option value="Freshmen">Freshmen</option>
            <option value="Sophomore">Sophomore</option>
            <option value="Junior">Junior</option>
            <option value="Senior">Senior</option>
        </select><br>
        Status:
        <select name="Status" required>
            <option value="">Select Status</option>
            <option value="Enrolled">Enrolled</option>
            <option value="Dropped">Dropped</option>
        </select><br>
        Password: <input type="password" name="Password" required /><br>
        <input type="submit" />
    </form>

</body>
</html>
