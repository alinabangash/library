<?php
session_start();
if (!isset($_SESSION['valid']) || $_SESSION['valid'] !== true) {
    header("Location: login.php");
    exit();
}

// Function to sanitize user input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize filter criteria
    $filter_title = sanitize_input($_POST['filter_title']);
    $filter_isbn = sanitize_input($_POST['filter_isbn']);
    // You can add more filters as needed

    // Perform database query to retrieve checkout records for the current user with applied filters
    $con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
    if (!$con) {
        die('Could not connect: ' . mysqli_connect_error());
    }
    mysqli_select_db($con, 'library');

    // Get the current user's StudentID
    $studentId = $_SESSION['StudentID'];

    // Build the SQL query with dynamic filtering
    $query = "SELECT checkouts.ISBN, checkouts.CheckoutDate, checkouts.ReturnDate, books.Title, books.Author, books.Format FROM checkouts INNER JOIN books ON checkouts.ISBN = books.ISBN WHERE StudentID = '$studentId' AND CheckinDate IS NULL";

    // Apply filters if they are provided
    if (!empty($filter_title)) {
        $query .= " AND books.Title LIKE '%$filter_title%'";
    }
    if (!empty($filter_isbn)) {
        $query .= " AND checkouts.ISBN = '$filter_isbn'";
    }
    // Add more conditions for additional filters if needed

    $result = mysqli_query($con, $query);
} else {
    // If form is not submitted, retrieve all checkout records without filtering
    $con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
    if (!$con) {
        die('Could not connect: ' . mysqli_connect_error());
    }
    mysqli_select_db($con, 'library');

    // Get the current user's StudentID
    $studentId = $_SESSION['StudentID'];

    // Query to retrieve checkout records for the current user where CheckinDate is NULL
    $query = "SELECT checkouts.ISBN, checkouts.CheckoutDate, checkouts.ReturnDate, books.Title, books.Author, books.Format FROM checkouts INNER JOIN books ON checkouts.ISBN = books.ISBN WHERE StudentID = '$studentId' AND CheckinDate IS NULL";
    $result = mysqli_query($con, $query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Checkouts</title>
    <link rel="stylesheet" href="/view_checkouts.css">
    <link rel="stylesheet" href="styles/table.css"> <!-- Add the table.css file -->
</head>
<body>
<div class="homeContent">
    <h2 class="title_checkout">Books Currently Checked Out</h2>

    <!-- Filter form -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="filter_title">Filter by Title:</label>
        <input type="text" name="filter_title" id="filter_title">
        <label for="filter_isbn">Filter by ISBN:</label>
        <input type="text" name="filter_isbn" id="filter_isbn">
        <!-- Add more input fields for additional filters if needed -->
        <button type="submit">Apply Filter</button>
    </form>

    <?php
    if(mysqli_num_rows($result) > 0) {
        // Display checkout records in a table with the resultsTable class
        echo "<table class='resultsTable'>";
        echo "<tr><th>Title</th><th>Author</th><th>ISBN</th><th>Format</th><th>Checkout Date</th><th>Due Date</th></tr>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td><a href='details_item.php?isbn={$row['ISBN']}'>{$row['Title']}</a></td>";
            echo "<td>{$row['Author']}</td>";
            echo "<td>{$row['ISBN']}</td>";
            echo "<td>{$row['Format']}</td>";
            echo "<td>{$row['CheckoutDate']}</td>";
            echo "<td>{$row['ReturnDate']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No books currently checked out.</p>";
    }

    mysqli_close($con);
    ?>
    <!-- Add a link back to the home page -->
    <p><a href="home.php">Back to Home</a></p>
</div>
</body>
</html>
