<!DOCTYPE html>
<html lang="en">
<head>
<title>Add New Digital Item</title>
<script>
    window.onload = function() {
        var requiredInputs = document.querySelectorAll('input[required], select[required], textarea[required]');
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

<!-- Add new digital item -->
<form action="insert_digitalitem.php" method="post">
    Digital ID: <input type="number" name="DigitalID" required /><br>
    Stock: <input type="number" name="Stock" required /><br>
    Title: <input type="text" name="Title" required /><br>
    Author/Artist: <input type="text" name="Author" required /><br>
    Format: 
    <select name="Format" required>
        <option value="">Select Format</option>
        <option value="DVD">DVD</option>
        <option value="eBook">eBook</option>
        <option value="Audio Book">Audio Book</option>
    </select><br>
    Publisher/Studio: <input type="text" name="Publisher" /><br>
    Publication Year: <input type="number" name="PublicationYear" required min="1800" max="2024" /><br>
    Genre: 
    <select name="Genre" required>
        <option value="">Select Genre</option>
        <option value="Action">Action</option>
        <option value="Adventure">Adventure</option>
        <option value="Biography">Biography</option>
        <option value="Children">Children</option>
        <option value="Comedy">Comedy</option>
        <option value="Cookbook">Cookbook</option>
        <option value="Crime">Crime</option>
        <option value="Documentary">Documentary</option>
        <option value="Drama">Drama</option>
        <option value="Family">Family</option>
        <option value="Fantasy">Fantasy</option>
        <option value="Fiction">Fiction</option>
        <option value="History">History</option>
        <option value="Horror">Horror</option>
        <option value="Music">Music</option>
        <option value="Musical">Musical</option>
        <option value="Mystery">Mystery</option>
        <option value="Non-Fiction">Non-Fiction</option>
        <option value="Poetry">Poetry</option>
        <option value="Romance">Romance</option>
        <option value="Science Fiction">Science Fiction</option>
        <option value="Self-Help">Self-Help</option>
        <option value="Sport">Sport</option>
        <option value="Thriller">Thriller</option>
        <option value="War">War</option>
        <option value="Western">Western</option>
        <option value="Young Adult">Young Adult</option>
        <option value="Other">Other</option>
    </select><br>
    Description: <textarea name="Description" required></textarea><br>
    Language: 
    <select name="Language" required>
        <option value="">Select Language</option>
        <option value="English">English</option>
        <option value="Spanish">Spanish</option>
        <option value="French">French</option>
        <option value="Arabic">Arabic</option>
        <option value="Chinese">Chinese</option>
        <option value="Russian">Russian</option>
    </select><br>
    Cover Image: <input type="text" name="CoverImage" /><br>
    Stock: <input type="number" name="Stock" required /><br>
    <input type="submit" value="Add Digital Item" />
</form>

</body>
</html>
