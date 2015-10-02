<?php

	include_once('includes/helperFns.php')

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Contra as prisões políticas dos 15 activistas angolanos. Pela liberdade e a democracia em Angola. Freedom for the Political Prisoners in Angola.">
	<meta name="keywords" content="Luaty da Silva Beirão, Manuel Chivonde (Nito Alves), Nuno Álvaro Dala, Afonso Mahenda Matias (Mbanza Hanza), Nelson Dibango Mendes dos Santos, Itler Jessy Chivonde (Itler Samussuko), Albano Evaristo Bingocabingo, Sedrick Domingos de Carvalho, Fernando António Tomás (Nicolas o Radical), Arante Kivuvu Italiano Lopes, Benedito Jeremias, José Gomes Hata (Cheick Hata), Inocêncio António de Brito ">
	<title>Liberdade aos Presos Políticos em Angola</title>

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

			<?php $data = getPhotos(); $i = 0; ?>

			<?php foreach ($data As $k => $obj) : ?>
				<?php $i++; ?>
				<div class="photo-box anim-hover photo-popup" data-name="foo bar" data-index="<?php echo $i; ?>">
					<img src="<?php echo $obj['image_src']; ?>" alt="">
				</div>

				<!-- start: photo submit tile -->
				<?php if ($i === 4) : ?>
				<div class="photo-box photo-box-submit-cta anim-hover" data-cta="photo-submit">
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
				<!-- end: photo submit tile -->

				<!-- start: contact info tile -->
				<?php if ($i === 9) : ?>
				<div class="photo-box general-tile contact-email" data-cta="contact-email">
					<p>
						<span>Contacto</span>
						info@email.com
					</p>
				</div>
				<?php endif; ?>
				<!-- end: contact info tile -->

				<!-- start: contact info tile -->
				<?php if ($i === 11) : ?>
				<div class="photo-box general-tile amnistia-internacional-portugal" data-cta="contact-email">
					<h3>Assinar a petição</h3>
					<img src="images/amnistia-internacional-portugal.png" alt="">
				</div>
				<?php endif; ?>
				<!-- end: contact info tile -->

			<?php endforeach; ?>

		</div>
		<!-- end: appeal grid -->

		<!-- start: appeal popup -->
		<div class="appeal-popup-module" data-current-index="-1">

			<div class="img-container">

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
					<div class="inp-photo-wrap">
						<h3>Enviar foto com apelo:</h3>
						<input type="file" name="file">
					</div>
					<div class="permission-options">
						<h3>Agradecemos permissao para:</h3>
						<label>
							<input class="permission-checkbox" type="checkbox" name="tick-facebook" value="facebook">
							<span>Partilhar este apelo no facebook</span>
						</label>
						<label>
							<input class="permission-checkbox" type="checkbox" name="tick-email-publish" value="email_entities">
							<span>Enviar o apelo por email para as entidades</span>
						</label>
					</div>
					<div>
						<input class="confirm" type="submit" value="confirmar">
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