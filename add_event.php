<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Event</title>
    <script>
        window.onload = function() {
            var requiredInputs = document.querySelectorAll('input[required], select[required], textarea[required]');
            requiredInputs.forEach(function(input) {
                var label = document.createElement('label');
                label.textContent = '*';
                label.style.color = 'red'; // Change color as needed
                input.parentNode.insertBefore(label, input.nextSibling);
            });

            var dateInput = document.getElementById('date');
            var startTimeInput = document.getElementById('start_time');
            var endTimeInput = document.getElementById('end_time');

            // Prevent past dates
            var today = new Date().toISOString().split('T')[0];
            dateInput.setAttribute('min', today);

            // Disable end time earlier than start time
            startTimeInput.addEventListener('change', function() {
                endTimeInput.setAttribute('min', startTimeInput.value);
            });

            // Disable start time when end time is earlier than start time
            endTimeInput.addEventListener('change', function() {
                if (endTimeInput.value < startTimeInput.value) {
                    startTimeInput.value = '';
                }
            });
        };

        function validateForm() {
            var startTimeInput = document.getElementById('start_time');
            var endTimeInput = document.getElementById('end_time');

            // Ensure end time is not earlier than start time
            if (endTimeInput.value < startTimeInput.value) {
                alert("End time cannot be earlier than start time.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>

<!-- Add new event form -->
<form action="insert_event.php" method="post" onsubmit="return validateForm()">
    Event Name: <input type="text" name="event_name" required /><br>
    Date: <input type="date" id="date" name="date" required /><br>
    Start Time: <input type="time" id="start_time" name="start_time" required /><br>
    End Time: <input type="time" id="end_time" name="end_time" required /><br>
    Location: <input type="text" name="location" required /><br>
    Categories: 
    <select name="categories" required>
        <option value="">Select Category</option>
        <option value="Arts & Culture">Arts & Culture</option>
        <option value="Author Talks/Book Clubs">Author Talks/Book Clubs</option>
        <option value="Business, Career & Job Skills">Business, Career & Job Skills</option>
        <option value="Classes & Education">Classes & Education</option>
        <option value="Community & Outreach">Community & Outreach</option>
        <option value="Crafts & STEM">Crafts & STEM</option>
        <option value="Holidays & Observations">Holidays & Observations</option>
        <option value="Language Learning">Language Learning</option>
        <option value="Workshop">Workshop</option>
    </select><br>
    Description: <textarea name="description" required></textarea><br>
    Type: 
    <select name="type" required>
        <option value="">Select Type</option>
        <option value="online">Online</option>
        <option value="in-person">In Person</option>
    </select><br>
    Max Attendees: <input type="number" name="max_attendees" required /><br>
    <input type="submit" value="Add Event" />
</form>

</body>
</html>
