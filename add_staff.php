<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Staff</title>
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

<!-- Add new staff member and modify the staff information -->
<form action="insert_staff.php" method="post">
    Staff ID: <input type="number" name="StaffID" required /><br>
    First Name: <input type="text" name="FirstName" required /><br>
    Last Name: <input type="text" name="LastName" required /><br>
    Date of Birth: <input type="date" name="DateOfBirth" required /><br>
    Gender:
    <select name="Gender" required>
        <option value="">Select Gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
    </select><br>
    Address: <input type="text" name="Address" required /><br>
    Contact Number: <input type="text" name="ContactNumber" required /><br>
    Email Address: <input type="text" name="EmailAddress" required /><br>
    Position: 
    <select name="Position" required>
        <option value="">Select Position</option>
        <option value="Librarian">Librarian</option>
        <option value="IT Specialist">IT Specialist</option>
        <option value="Clerk">Clerk</option>
        <option value="Security">Security</option>
        <option value="Admin">Admin</option>
    </select><br>
    Date Hired: <input type="date" name="DateHired" required /><br>
    Status: 
    <select name="Status" required>
        <option value="">Select Status</option>
        <option value="Active">Active</option>
        <option value="In Active">Inactive</option>
    </select><br>
    Password: <input type="text" name="Password" required /><br>
    <input type="submit" />
</form>

</body>
</html>
