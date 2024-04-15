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

    // Build the SQL query with dynamic filtering
    $query = "SELECT books.Title, books.Author, books.ISBN, books.Format, holds.HoldDate, holds.Status FROM holds INNER JOIN books ON holds.ISBN = books.ISBN";

    // Apply filters if they are provided
    if (!empty($filter_title)) {
        $query .= " WHERE books.Title LIKE '%$filter_title%'";
    }
    if (!empty($filter_author)) {
        $query .= " AND books.Author LIKE '%$filter_author%'";
    }
    // Add more conditions for additional filters if needed

    $result = mysqli_query($con, $query);
} else {
    // If form is not submitted, retrieve all holds without filtering
    $query = "SELECT books.Title, books.Author, books.ISBN, books.Format, holds.HoldDate, holds.Status FROM holds INNER JOIN books ON holds.ISBN = books.ISBN";
    $result = mysqli_query($con, $query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Holds - Admin</title>
    <link rel="stylesheet" href="view_holds.css"> <!-- Include your table.css file here -->
</head>
<body>
    <div class="homeContent">
        <h2 class="title_holds">View Holds - Admin</h2>

        <!-- Filter form -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="filter_title">Filter by Title:</label>
            <input type="text" name="filter_title" id="filter_title">
            <label for="filter_author">Filter by Author:</label>
            <input type="text" name="filter_author" id="filter_author">
            <!-- Add more input fields for additional filters if needed -->
            <button type="submit">Apply Filter</button>
        </form>

        <table class="resultsTable">
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>ISBN</th>
                <th>Format</th>
                <th>Hold Date</th>
                <th>Status</th>
            </tr>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    // Make the Title column a link to the book details page
                    echo "<td><a href='details_item.php?isbn=" . $row['ISBN'] . "'>" . $row['Title'] . "</a></td>";
                    echo "<td>" . $row['Author'] . "</td>";
                    echo "<td>" . $row['ISBN'] . "</td>";
                    echo "<td>" . $row['Format'] . "</td>";
                    echo "<td>" . $row['HoldDate'] . "</td>";
                    echo "<td>" . $row['Status'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No holds found.</td></tr>";
            }
            ?>
        </table>
        <!-- Add a link back to the home page -->
        <p><a href="home.php">Back to Home</a></p>
    </div>
</body>
</html>

<?php
mysqli_close($con);
?>
