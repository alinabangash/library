<?php
session_start();

if (!isset($_SESSION['valid']) || $_SESSION['valid'] !== true) {
    header("Location: login.php");
    exit();
}

// Perform database connection
$con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
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
    $filter_author = sanitize_input($_POST['filter_author']);
    // You can add more filters as needed

    // Get the current user's StudentID
    $studentId = $_SESSION['StudentID'];

    // Build the SQL query with dynamic filtering
    $query = "SELECT checkouts.*, books.Title, books.Author, books.Format FROM checkouts INNER JOIN books ON checkouts.ISBN = books.ISBN WHERE StudentID = '$studentId'";

    // Apply filters if they are provided
    if (!empty($filter_title)) {
        $query .= " AND books.Title LIKE '%$filter_title%'";
    }
    if (!empty($filter_author)) {
        $query .= " AND books.Author LIKE '%$filter_author%'";
    }
    // Add more conditions for additional filters if needed

    $result = mysqli_query($con, $query);
} else {
    // If form is not submitted, retrieve all transaction history without filtering

    // Get the current user's StudentID
    $studentId = $_SESSION['StudentID'];

    $query = "SELECT checkouts.*, books.Title, books.Author, books.Format FROM checkouts INNER JOIN books ON checkouts.ISBN = books.ISBN WHERE StudentID = '$studentId'";
    $result = mysqli_query($con, $query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <link rel="stylesheet" href="/history.css">
    <link rel="stylesheet" href="styles/table.css"> <!-- Use your table.css file -->
</head>
<body>
    <div class="homeContent">
        <h2 class="title_history">Transaction History</h2>

        <!-- Filter form -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="filter_title">Filter by Title:</label>
            <input type="text" name="filter_title" id="filter_title">
            <label for="filter_author">Filter by Author:</label>
            <input type="text" name="filter_author" id="filter_author">
            <!-- Add more input fields for additional filters if needed -->
            <button type="submit">Apply Filter</button>
        </form>

        <?php
        if(mysqli_num_rows($result) > 0) {
            // Display transaction history in a table with the resultsTable class
            echo "<table class='resultsTable'>";
            echo "<tr><th>ISBN</th><th>Title</th><th>Author</th><th>Format</th><th>Checkout Date</th><th>Return Date</th><th>Checkin Date</th></tr>";
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['ISBN']}</td>";
                // Make the Title column a link to the book details page
                echo "<td><a href='details_item.php?isbn={$row['ISBN']}'>{$row['Title']}</a></td>";
                echo "<td>{$row['Author']}</td>";
                echo "<td>{$row['Format']}</td>";
                echo "<td>{$row['CheckoutDate']}</td>";
                echo "<td>{$row['ReturnDate']}</td>";
                echo "<td>{$row['CheckinDate']}</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No transaction history found.</p>";
        }

        mysqli_close($con);
        ?>
        <!-- Add a link back to the home page -->
        <p><a href="home.php">Back to Home</a></p>
    </div>
</body>
</html>
