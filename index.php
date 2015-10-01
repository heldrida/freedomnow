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
						<p><span class="count-to" data-count-to="diasPresos">0</span></p>
					</div>
					<div class="col col-2">
						<p>dias presos</p>
					</div>

				</div>

			</div>

			<div class="row r2">

				<div>

					<div class="col col-1">
						<p><span class="count-to" data-count-to="greveFome">0</span></p>
					</div>

					<div class="col col-2">
						<p>de greve<br>de fome</p>
					</div>

				</div>

			</div>

			<!-- topbox bottom bar -->
			<div class="topbox-bot-bar">

				<div class="arrow-down animated infinite floating">
					<img src="images/icon-arrow-down.svg" alt="">
				</div>

				<img class="logo-freedomnow npe" src="images/logo-freedomnow.jpg?201509300133" alt="Liberdade ja! Freedom Now!">

			</div>
			<!-- topbox bottom bar -->


		</div>
		<!-- end: clock -->

		<!-- start: appeal grid -->
		<div class="appeal-grid-module">

			<?php for ($i = 0; $i < 30; $i++) : ?>

				<div class="photo-box" data-name="foo bar" data-index="<?php echo $i; ?>">
					<img src="https://leakypedia.files.wordpress.com/2013/01/keep-fighting-cropped1.jpg" alt="">
				</div>

				<?php if ($i === 4) : ?>
				<div class="photo-box photo-box-submit-cta" data-cta="photo-submit">
					<p>
						<span>Eu</span>
						Quero<br>Participar!
					</p>
					<div class="arrow">
						<img class="animated infinite floating" src="images/icon-arrow-down.svg" alt="">
					</div>
					<div class="hashtags">
						<span class="hashtag">#liberdadeja</span>
						<span class="hashtag">#freedomnow</span>
					</div>
				</div>
				<?php endif; ?>

			<?php endfor; ?>

		</div>
		<!-- end: appeal grid -->

		<!-- start: appeal popup -->
		<div class="appeal-popup-module">

			<div class="img-container" data-photo="https://leakypedia.files.wordpress.com/2013/01/keep-fighting-cropped1.jpg">

				<div class="nav-ctrl">
					<button class="next">ver proximo</button>
					<button class="cta-appeal how-to-appeal">Participar!</button>
				</div>
				<button class="close">fechar</button>
			</div>

		</div>
		<!-- end: appeal popup -->

		<!-- start: form -->
		<div class="form-file-module">

			<form name="myFileForm" class="myFileForm" action="" method="post" enctype="multipart/form-data">

				<div class="user-data">
					<button class="close"></button>
					<div>
						<label for="file">Enviar foto:</label>
						<input type="file" name="file">
					</div>
					<div>
					<input type="submit" value="submit">
					</div>
				</div>

				<!-- start: success message -->
				<div class="form-success-message">
					<p>Mensagem sucesso!</p>
				</div>
				<!-- end: success message -->

			</form>

		</div>
		<!-- end: form -->

	</div>

	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/3.1.8/imagesloaded.pkgd.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/3.10.1/lodash.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
	<script src="js/app.js"></script>

</body>
</html>