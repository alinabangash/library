<head>
<title>Add New Book</title>
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

<!-- ADD new book -->
<form action="insert_book.php" method="post">
    ISBN: <input type="number" name="ISBN" required /><br>
    Title: <input type="text" name="Title" required /><br>
    Author: <input type="text" name="Author" required /><br>
    Publisher: <input type="text" name="Publisher" /><br>
    Publication Year: <input type="number" name="PublicationYear" required min="1800" max="2024" /><br>
    Genre: 
    <select name="Genre" required>
        <option value="">Select Genre</option>
        <option value="Adventure">Adventure</option>
        <option value="Biography">Biography</option>
        <option value="Children">Children</option>
        <option value="Cookbook">Cookbook</option>
        <option value="Drama">Drama</option>
        <option value="Fantasy">Fantasy</option>
        <option value="Fiction">Fiction</option>
        <option value="Historical Fiction">Historical Fiction</option>
        <option value="Horror">Horror</option>
        <option value="Mystery">Mystery</option>
        <option value="Non-Fiction">Non-Fiction</option>
        <option value="Poetry">Poetry</option>
        <option value="Romance">Romance</option>
        <option value="Science Fiction">Science Fiction</option>
        <option value="Self-Help">Self-Help</option>
        <option value="Thriller">Thriller</option>
        <option value="Young Adult">Young Adult</option>
        <option value="Other">Other</option>
    </select><br>
    Page Count: <input type="number" name="PageCount" required /><br>
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
    Format: 
    <select name="Format" required>
        <option value="">Select Format</option>
        <option value="Book">Book</option>
    </select><br>
    Cover Image: <input type="text" name="CoverImage" /><br>
    Stock: <input type="number" name="Stock" required /><br>
    <input type="submit" value="Add Book" />
</form>

</body>
</html>
