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
<title>Account</title>
<link rel="stylesheet" href="/account.css">
</head>
<body>
<div class="homeContent">
<div class="accountTab">
      <a href="account.php">
      <div class="icon">
        <img src="/images/icon.png" alt="Icon">
      </div>
      </a>
    </div>
    <div class="logout">
    <a class="logoutText" href="logout.php">Logout</a>
  </div>
  <h1 class="welcome">Welcome to Your Account, <?php echo $_SESSION['FirstName'] . ' ' . $_SESSION['LastName']; ?></h1>
  <p><a href="view_checkouts.php">View Checkouts</a></p>
  <p><a href="view_holds.php">View Holds</a></p>

  <p><a href="history.php">History</a></p>

</div>
</body>
</html>
