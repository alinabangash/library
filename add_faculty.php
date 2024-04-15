<head>
    <title>Add New Faculty</title>
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

    <!-- Add new faculty and modify the faculty information -->
    <form action="insert_faculty.php" method="post">
        Faculty ID: <input type="number" name="FacultyID" required /><br>
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
        Department: <input type="text" name="Department" required /><br>
        Position: <input type="text" name="Position" required /><br>
        Date Hired: <input type="date" name="DateHired" value="<?php echo date('Y-m-d'); ?>" required /><br>
        Status:
        <select name="Status" required>
            <option value="">Select Status</option>
            <option value="Active">Active</option>
            <option value="In Active">In Active</option>
        </select><br>
        Password: <input type="password" name="Password" required /><br>
        <input type="submit" />
    </form>

</body>
</html>
