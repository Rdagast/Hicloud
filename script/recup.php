<?php
echo "coucou";
//directory for upload
$uploaddir = "/var/www/html/hicloud/upload/";
$uploadfile = $uploaddir . $_FILES['file']['name'];
echo $uploadfile;
echo '<pre>';
	// upload file json on the web server
	if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
	    echo "File is valid, and was successfully uploaded.\n";

		$json_file = file_get_contents('/var/www/html/hicloud/upload/result.json');
		$parse = json_decode($json_file);

		foreach ($parse as $item) {
				// insert values into database 
				$db = new PDO('mysql:host=localhost;dbname=hicloud','root','root');

				$req = $db->prepare('INSERT INTO sensor (temperature_sensor, humidity_sensor, power_sensor,vibration_sensor)VALUES (:temperature_sensor, :humidity_sensor, :power_sensor,:vibration_sensor)');
				$req->bindValue(":temperature_sensor", $item->temperature);
				$req->bindValue(":humidity_sensor", $item->humidity);
				$req->bindValue(":power_sensor", $item->battery);
				$req->bindValue(":vibration_sensor", $item->vibration);

				$req->execute();

		}

	} else {
		//if file does not upload
	    echo "Possible file upload attack!\n";
	}
// show file and the request
echo 'Here is some more debugging info:';
print_r($_FILES);
echo "\n<hr />\n";
print_r($_POST);
print "</pr" . "e>\n";
?>
