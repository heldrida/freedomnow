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
		<div class="clock-module">

			<div class="row r1">

				<div>

					<div class="col col-1">
						<p>101</p>
					</div>
					<div class="col col-2">
						<p>dias presos</p>
					</div>

				</div>

			</div>

			<div class="row r2">

				<div>

					<div class="col col-1">
						<p>9</p>
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

	</div>

	<script src="js/app.js"></script>

</body>
</html>