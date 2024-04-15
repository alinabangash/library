<?php
   ob_start();
   session_start();
?>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="login.css">
   <title>Login</title>
</head>
<body>
   <h2 class="enterId">Enter Student ID and Password</h2>
   <?php
      $msg = '';
      $con = mysqli_connect('library-db.mysql.database.azure.com', 'alinabangash', 'libdb123!', 'library');
      if (!$con) {
          die('Could not connect: ' . mysqli_connect_error());
      }

      if (isset($_POST['login']) && !empty($_POST['StudentID']) && !empty($_POST['Password'])) {
         $studentId = mysqli_real_escape_string($con, $_POST['StudentID']);
         $password = mysqli_real_escape_string($con, $_POST['Password']);
         $query = "SELECT * FROM students WHERE StudentID = '$studentId'";
         $result = mysqli_query($con, $query);
         if ($row = mysqli_fetch_assoc($result)) {
    if ($row['Password'] == $password) {
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['StudentID'] = $studentId;
        $_SESSION['FirstName'] = $row['FirstName']; // Store first name in session
        $_SESSION['LastName'] = $row['LastName']; // Store last name in session
        $msg = "You have entered correct Student ID and Password";
        // Redirect to home page
        header("Location: home.php");
        exit();
    } else {
        $msg = "You have entered wrong password";
    }
} else {
    $msg = "Student ID does not exist";
}

      }
      mysqli_close($con);
   ?>

   <h4 style="margin-left:10rem; color:red;"><?php echo $msg; ?></h4>
   <br/><br/>
   <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <div>
         <label for="StudentID">Student ID:</label>
         <input type="text" name="StudentID" id="StudentID">
      </div>
      <div>
         <label for="Password">Password:</label>
         <input type="password" name="Password" id="Password">
      </div>
      <section style="margin-left:2rem;">
      <button class="loginButton" type="submit" name="login">Login</button>
      </section>
   </form>

   <p class="cleanSession"> 
      <a href="logout.php" tite="Logout">Click here to clean Session</a>
   </p>

   <!-- Link for admin -->
   <div class="adminSignIn">
   <a style="text-decoration:none; color: black;font-weight: normal" href="admin_login.php" tite="adminSignIn">Admin Sign In</a>
   </div>
</body>
</html>
