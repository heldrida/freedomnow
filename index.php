<?php 

	header('Access-Control-Allow-Origin: liberdade-ja.com');
	header('Access-Control-Allow-Origin: www.liberdade-ja.com');

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
				<div class="photo-box general-tile who-we-are-tile" data-cta="who-we-area-box">
					<!--
					<p>
						<span>Contacto</span>
						<span class="group-email-contact"></span>
					</p>
					-->
					<div class="who-we-are-el">
						<span>ler</span>
						<span>Quem<br>somos</span>
					</div>
					<div class="arrow">
						<img class="animated infinite floating" src="images/icon-arrow-down.svg" alt="">
					</div>
				</div>
				<?php endif; ?>
				<!-- end: contact info tile -->

				<!-- start: contact info tile -->
				<?php if ($i === 11) : ?>
				<div class="photo-box general-tile amnistia-internacional" data-cta="contact-email">
					<img src="images/amnesty-international.png?20151008" alt="">
				</div>
				<?php endif; ?>
				<!-- end: contact info tile -->

				<!-- start: privacy policy tile -->
				<?php if ($i === 14) : ?>
				<div class="photo-box general-tile visit-us-on-facebook" data-cta="visit-us-on-facebook">
					<div class="fb-icon-wrp">
						<img src="images/icon-fb.png" alt="">
					</div>
					<p>
						<span>Visita-nos<br>no<br>Facebook</span>
					</p>
					<div class="arrow">
						<img class="animated infinite floating" src="images/icon-arrow-down.svg" alt="">
					</div>
				</div>
				<?php endif; ?>
				<!-- end: privacy policy tile -->

			<?php endforeach; ?>

			<!-- start: privacy policy tile -->
			<div class="photo-box general-tile privacy-policy-box" data-cta="privacy-policy">
				<p>
					<span>Política<br>de<br>Privacidade</span>
				</p>
				<div class="arrow">
					<img class="animated infinite floating" src="images/icon-arrow-down.svg" alt="">
				</div>
			</div>
			<!-- end: privacy policy tile -->

		</div>
		<!-- end: appeal grid -->

		<!-- start: appeal popup -->
		<div class="appeal-popup-module" data-current-index="-1">

			<div class="img-container">

				<div class="nav-ctrl">
					<button class="next">ver proximo</button>
					<button class="cta-appeal how-to-appeal">Participar!</button>
					<button class="cta-appeal fb-share-btn" data-image=""></button>
				</div>
				<button class="close">fechar</button>
			</div>

		</div>
		<!-- end: appeal popup -->

		<!-- start: form -->
		<div class="form-file-module">

			<form name="myFileForm" class="myFileForm" action="#" method="post" enctype="multipart/form-data">

				<div class="user-data">
					<div class="close"></div>
					<div class="inp-photo-wrap">
						<h3>Enviar foto com apelo:</h3>
						<input type="file" name="file" accept="image/png, image/gif, image/jpeg">
						<div class="browse-photo">Browse...</div>
					</div>
					<div class="permission-options">
						<h3>Agradecemos permissao para:</h3>

						<textarea class="facebook-share-message" name="facebook-share-message" placeholder="Mensagem para partilha no facebook aqui..."></textarea>

						<label>
							<input class="permission-checkbox" type="checkbox" name="tick-facebook" value="facebook">
							<span>Partilhar este apelo no facebook</span>
						</label>
						<label>
							<input class="permission-checkbox" type="checkbox" name="tick-email-publish" value="email_entities">
							<span>Enviar o apelo por email para as entidades competentes</span>
						</label>
					</div>
					<div class="email-only-permissions-data">
						<h3>Qual o teu nome e email ?</h3>
						<label>
							<span>Nome</span>
							<input type="text" name="fullname" value="" placeholder="Name here...">
						</label>
						<label>
							<span>Email</span>
							<input type="text" name="email" value="" placeholder="Your e-mail...">
						</label>
					</div>
					<div class="extended-email">
						<label class="click-email-preview-wrp">
							<span>Click aqui para ver um exemplo do conteudo do email a enviar</span>
						</label>
					</div>
					<div class="form-errors"></div>
					<div>
						<input class="confirm" type="submit" value="confirmar">
						<span class="loading animated infinite loading">&#9679;</span>
					</div>
				</div>

				<!-- start: success message -->
				<div class="form-success-message">
					<p>O seu apelo foi registado com sucesso.<br>Obrigado!</p>
				</div>
				<!-- end: success message -->

			</form>

		</div>
		<!-- end: form -->

		<!-- start: email preview -->
		<div class="email-preview">
			<div class="close"></div>
			<div class="where-to"></div>
			<div class="content"></div>
			<div class="photo">
				<img src="images/person-icon.png" alt="">
				<span>* Esta foto é um exemplo, pois será utilizada a foto-apelo que irá partilhar ao clicar no botão confirmar do formulário.</span>
			</div>
		</div>
		<!-- end: email preview -->

		<!-- start: who we are -->
		<div class="who-we-are">
			<div class="close"></div>
			<div class="content">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione similique quod maiores debitis beatae quis quaerat necessitatibus suscipit, quae delectus cupiditate saepe dicta sed excepturi voluptatum, laudantium, aut quam nam?
			</div>
		</div>
		<!-- end: who are we -->

	</div>

	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/3.1.8/imagesloaded.pkgd.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/3.10.1/lodash.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
	<script src="js/vendor/validate.min.js"></script>
	<script src="js/vendor/console-polyfill.js"></script>
	<script src="js/vendor/base64.min.js"></script>
	<script src="js/vendor/json-polyfill.js"></script>
	<script src="js/vendor/xhr-polyfill.min.js"></script>
	<script src="js/app.js"></script>

</body>
</html>