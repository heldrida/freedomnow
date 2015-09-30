<?php 

	include_once('includes/helperFns.php')

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Freedom Now!</title>

	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
	<link rel="stylesheet" href="css/app.css">
</head>
<body data-lang="en">

	<div class="freedomnow">

		<!-- start: clock -->
		<div class="clock-module npe">

			<div class="row r1">

				<div>

					<div class="col col-1">
						<p><span class="count-to" data-count-to="<?php echo getTheDate('diasPresos'); ?>">0</span></p>
					</div>
					<div class="col col-2">
						<p>dias presos</p>
					</div>

				</div>

			</div>

			<div class="row r2">

				<div>

					<div class="col col-1">
						<p><span class="count-to" data-count-to="<?php echo getTheDate('greveFome'); ?>">0</span></p>						
					</div>

					<div class="col col-2">
						<p>de greve<br>de fome</p>
					</div>

				</div>

			</div>

		</div>
		<!-- end: clock -->

		<!-- start: appeal grid -->
		<div class="appeal-grid-module">

			<?php for ($i = 0; $i < 100; $i++) : ?>
			<div class="photo-box">
				<img src="https://leakypedia.files.wordpress.com/2013/01/keep-fighting-cropped1.jpg" alt="">
			</div>
			<?php endfor; ?>

		</div>
		<!-- end: appeal grid -->


		<div class="arrow-down animated infinite floating">
			<img src="images/icon-arrow-down.svg" alt="">
		</div>

		<img class="logo-freedomnow npe" src="images/logo-freedomnow.jpg?201509300133" alt="Liberdade ja! Freedom Now!">
	
	</div>

	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/3.1.8/imagesloaded.pkgd.min.js"></script>
	<script src="js/app.js"></script>

</body>
</html>