<!DOCTYPE html>

<head>

	<meta charset="UTF-8"/>
	<title>Thanks!</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

</head>

<body>
	<br>
	<br>

	<center><img height="100" width="300" src="avayalogo.jpg">
	</center>

	<h1>
	<center>
		We will respond to your Support Request within 2 business days.
	</center></h1>
	<h1>
	<center>
		Thank you!
	</center></h1>

	<?php

	$first = check_input($_POST['element_1_1']);
	$last = check_input($_POST['element_1_2']);
	$email = check_input($_POST['element_2']);
	$phone1 = check_input($_POST['element_11_1']);
	$phone2 = check_input($_POST['element_11_2']);
	$phone3 = check_input($_POST['element_11_3']);
	$phone = check_input($phone1 . $phone2 . $phone3);
	$organization = check_input($_POST['element_3']);
	$servicing = check_input($_POST['element_5']);
	$pbx = check_input($_POST['element_6']);
	$ucTopic = check_input($_POST['element_7']);
	$ccTopic = check_input($_POST['element_8']);
	$description = check_input($_POST['element_9']);
	$thedate = date('Y-m-d h:i:sa');

	//This is the directory where images will be saved
	$target = "uploads/";
	$target = $target . basename($_FILES['element_10']['name']);

	//This gets all the other information from the form
	$pic = "";
	$pic = ($_FILES['element_10']['name']);

	//Writes the information to the database
	//mysql_query("INSERT INTO `employees` VALUES ('$name', '$email', '$phone', '$pic')") ;

	$accounts = mysql_connect("localhost", "root", "password") or die(mysql_error());

	mysql_select_db('support services', $accounts);

	$sql = "
INSERT INTO support(Date,First, Last, Email, Phone, Organization, ServiceCategory,PBX,Description, UC, CC, upload )

 VALUES('$thedate','$first', '$last', '$email', '$phone', '$organization', '$servicing', '$pbx', '$description', '$ucTopic', '$ccTopic', '$pic') ";

	mysql_query($sql, $accounts);

	if ($pic != "") {
		//Writes the photo to the server
		if (move_uploaded_file($_FILES['element_10']['tmp_name'], $target)) {

			//Tells you if its all ok
			echo "<p><center>" . "The file " . basename($_FILES['element_10']['name']) . " has been uploaded, and your information has been added to the directory" . "</center></p>";
		} else {

			//Gives and error if its not
			echo "<p><center>Sorry, there was a problem uploading your file.</center></p>";
		}
	}
?>
</body>

</html>

<?php
function check_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>
