<?php

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

	// temp
	$name = 'Foobar';
	$email = 'foobar@foobar.com';
	$fb_uid = 9999999;
	$share_fb = 1;
	$share_email = 1;

	$stmt = $mysqli->prepare($sql_insert_tbl);

	if ($mysqli->error) {
		var_dump($mysqli->error);
	}

	$stmt->bind_param('ssiii', $name, $email, $fb_uid, $share_fb, $share_email);
	$stmt->execute();
	$stmt->close();

	$mysqli->close();