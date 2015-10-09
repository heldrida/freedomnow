<?php

	if (!isset($_POST['track'])) {
		return;
	}

	require_once 'includes/db_credentials.php';

	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}

	$sql_create_tbl = "CREATE TABLE IF NOT EXISTS `wp_freedomnow`.`appeals` (
						`id` INT NOT NULL AUTO_INCREMENT ,
						`name` VARCHAR(255) NOT NULL ,
						`email` VARCHAR(255) NOT NULL ,
						`date` TIMESTAMP NOT NULL ,
						`fb_uid` INT NOT NULL ,
						`share_fb` BOOLEAN NOT NULL ,
						`share_email` BOOLEAN NOT NULL ,
						PRIMARY KEY (`id`)) ENGINE = InnoDB;";

	$sql_insert_tbl = "INSERT INTO `wp_freedomnow`.`appeals` (name, email, fb_uid, share_fb, share_email)
						VALUES (?, ?, ?, ?, ?);";

	$mysqli->query($sql_create_tbl);

	$name = isset($_POST['name']) ? $_POST['name'] : 'anonimous';
	$email = isset($_POST['email']) ? $_POST['email'] : '';
	$fb_uid = isset($_POST['fb_uid']) ? $_POST['fb_uid'] : '';
	$share_fb = isset($_POST['share_fb']) ? $_POST['share_fb'] : 0;
	$share_email = isset($_POST['share_email']) ? $_POST['share_email'] : 0;

	$stmt = $mysqli->prepare($sql_insert_tbl);

	if ($mysqli->error) {
		echo json_encode($mysqli->error);
		return;
	}

	$stmt->bind_param('ssiii', $name, $email, $fb_uid, $share_fb, $share_email);

	if ($stmt->execute()) {

		$stmt->close();
		$mysqli->close();

		echo json_encode('appeal tracked');

	}