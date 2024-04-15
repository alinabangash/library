<?php
session_start();
if (!isset($_SESSION['valid']) || $_SESSION['valid'] !== true) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Item Details</title>
<link rel="stylesheet" href="styles/MainPage.css">
</head>
<body>
<div class="homeContent">
  <!-- Display item details here -->
  <?php
  // Check if digital ID or ISBN is provided
  if(isset($_GET['digitalID']) || isset($_GET['isbn'])) {
      if(isset($_GET['digitalID'])){
          $id = $_GET['digitalID'];
          $idType = 'Digital ID';
          $query = "SELECT * FROM digitalitems WHERE DigitalID = '$id'";
      } else {
          $id = $_GET['isbn'];
          $idType = 'ISBN';
          $query = "SELECT * FROM books WHERE ISBN = '$id'";
      }
      
      // Perform database query to retrieve item details based on the provided ID
      $con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
      if (!$con) {
          die('Could not connect: ' . mysqli_connect_error());
      }
      mysqli_select_db($con, 'library');
      
      $result = mysqli_query($con, $query);
      if(mysqli_num_rows($result) > 0) {
          // Display item details
          $row = mysqli_fetch_assoc($result);
          echo "<h2>{$idType} Details</h2>";
          echo "<table class='itemDetails'>";
          echo "<tr><td>Title:</td><td><a href='details_item.php?{$idType}={$row[$idType]}'>{$row['Title']}</a></td></tr>";
          echo "<tr><td>Author:</td><td>{$row['Author']}</td></tr>";
          echo "<tr><td>{$idType}:</td><td>{$row[$idType]}</td></tr>";
          echo "<tr><td>Description:</td><td>{$row['Description']}</td></tr>";
          echo "<tr><td>Language:</td><td>{$row['Language']}</td></tr>";
          echo "<tr><td>Available Copies:</td><td>{$row['Available']}</td></tr>";
          if(isset($row['PageCount'])){
            echo "<tr><td>Page Count:</td><td>{$row['PageCount']}</td></tr>";
          }
          if(isset($row['Genre'])){
            echo "<tr><td>Genre:</td><td>{$row['Genre']}</td></tr>";
          }
          if(isset($row['Format'])){
            echo "<tr><td>Format:</td><td>{$row['Format']}</td></tr>";
          }
          echo "</table>";
          
          // Add forms based on the item type
          if(isset($_GET['digitalID'])){
              // Add a form for checking out the digital item
              echo "<form action='action_checkouts.php' method='post'>";
              echo "<input type='hidden' name='digitalID' value='{$row['DigitalID']}'>";
              echo "<button type='submit' name='operation' value='check-out'>Check Out</button>";
              echo "</form>";
              
              // Add a form for putting the digital item on hold
              echo "<form action='holds.php' method='post'>";
              echo "<input type='hidden' name='digitalID' value='{$row['DigitalID']}'>";
              echo "<button type='submit' name='operation' value='hold'>Hold</button>";
              echo "</form>";
          } else {
              // Add a form for checking out the book
              echo "<form action='action_checkouts.php' method='post'>";
              echo "<input type='hidden' name='isbn' value='{$row['ISBN']}'>";
              echo "<button type='submit' name='operation' value='check-out'>Check Out</button>";
              echo "</form>";
              
              // Check if available count is less than stock count
              if ($row['Available'] < $row['Stock']) {
                  // Add a form for checking in the book
                  echo "<form action='action_checkins.php' method='post'>";
                  echo "<input type='hidden' name='isbn' value='{$row['ISBN']}'>";
                  echo "<button type='submit' name='operation' value='check-in'>Check In</button>";
                  echo "</form>";
              }
              
              // Add a form for putting the book on hold
              echo "<form action='holds.php' method='post'>";
              echo "<input type='hidden' name='isbn' value='{$row['ISBN']}'>";
              echo "<button type='submit' name='operation' value='hold'>Hold</button>";
              echo "</form>";
          }
      } else {
          echo "<p>No item details found for the provided {$idType}.</p>";
      }
      mysqli_close($con);
  } else {
      echo "<p>No item identifier provided.</p>";
  }
  ?>
  <!-- Add a link back to the home page -->
  <p><a href="home.php">Back to Home</a></p>
</div>
</body>
</html>
