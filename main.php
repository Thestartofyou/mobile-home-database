<!DOCTYPE html>
<html>
<head>
	<title>Find Mobile Homes for Sale</title>
</head>
<body>
	<h1>Find Mobile Homes for Sale</h1>

	<?php
		// Check if the form has been submitted
		if(isset($_POST['submit'])) {
			// Get the user's input values
			$name = $_POST['name'];
			$phone = $_POST['phone'];
			$zip_code = $_POST['zip_code'];

			// Connect to the database
			$db = new mysqli('localhost', 'username', 'password', 'database_name');

			// Check for errors
			if($db->connect_error) {
				die('Sorry, there was an error connecting to the database.');
			}

			// Prepare the SQL statement
			$sql = "SELECT * FROM mobile_homes WHERE zip_code = '$zip_code'";

			// Execute the SQL statement
			$result = $db->query($sql);

			// Check for errors
			if(!$result) {
				die('Sorry, there was an error retrieving the mobile homes.');
			}

			// Display the results
			if($result->num_rows > 0) {
				echo "<p>Here are the mobile homes for sale in your area:</p>";
				echo "<ul>";
				while($row = $result->fetch_assoc()) {
					echo "<li>".$row['address']." - ".$row['price']." - ".$row['bedrooms']." bedrooms</li>";
				}
				echo "</ul>";
			} else {
				echo "<p>Sorry, there are no mobile homes for sale in your area.</p>";
			}

			// Close the database connection
			$db->close();
		} else {
			// Display the form
			echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
			echo "<label for='name'>Name:</label>";
			echo "<input type='text' name='name' id='name'><br>";
			echo "<label for='phone'>Phone Number:</label>";
			echo "<input type='text' name='phone' id='phone'><br>";
			echo "<label for='zip_code'>Zip Code:</label>";
			echo "<input type='text' name='zip_code' id='zip_code'><br>";
			echo "<input type='submit' name='submit' value='Find Mobile Homes'>";
			echo "</form>";
		}
	?>

</body>
</html>
