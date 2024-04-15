<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>CSCE813 Project 2 - information.php</title>
</head>
<body>

<p>Want to check one patron information? Please choose the name from droplist first!</p>

<?php
$con = mysqli_connect('cse.unl.edu', 'jqian', 'e_G95@');
if(!$con) {
  die("Could not connect:" . mysqli_connect_error());
}

mysqli_select_db($con, 'jqian');

if(isset($_GET['userName'])) {

    // DISPLAY RESULTS
    print("The selected reader name: " . $_GET['userName'] . "\n" );
    echo"<br />";

    $results = mysqli_query($con, "SELECT * FROM Reader LEFT JOIN Loan ON Reader.userName = Loan.username WHERE Reader.userName = '" . $_GET['userName'] . "'");

    //print("Number results:" . mysqli_num_rows($results) . "\n");

    $row = mysqli_fetch_array($results, MYSQLI_ASSOC);
    print("Reader's information: ");
    print("<ul>");
    print("<li> username: " . $row['username'] . "</li>");
    print("<li> user_city: " . $row['user_city'] . "</li>");
    print("<li> email: " . $row['email'] . "</li>");
    print("<li>Telephone: " . $row['telephone'] . "</li>");
    print("</ul>");

} else {
?>
<!-- adding code here for end users to pick the person and see the results -->
<form action="information.php" method="GET">
<div>


         <select name="userName" id="userName">
                <option value="blank">Select One Reader Name</option>
                <option value="Abe">Abe</option>
                <option value="Bob">Bob</option>
                <option value="Chuck">Chunck</option>
                <option value="David">David</option>
         </select>
<input type="submit" />
</div>
</form>
<?php
}
?>

<p>Want to modify one patron information? Please click this <a href="view.php">link</a>!</p>

</body>
</html>
