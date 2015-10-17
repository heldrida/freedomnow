<?php

	if (!isset($_GET['language']) || empty($_GET['language'])) {
		$url = 'http://' . $_SERVER['HTTP_HOST'];
		$url .= '/pt/' . $_SERVER['QUERY_STRING'];
		header('Location: ' . $url, true, 302);
		die;
	}

	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	define("BASEURL", $protocol . $_SERVER['HTTP_HOST']);

	require_once("includes/mobile-detect/Mobile_Detect.php");
	require_once("includes/language_package.php");
	require_once("includes/phpfastcache/phpfastcache.php");
	include_once('includes/helperFns.php');

?>

<!DOCTYPE html>
<html lang="<?php echo $language; ?>" class="<?php echo $language; ?>">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php echo translation($language, 'site_description'); ?>">
	<meta name="keywords" content="Luaty da Silva Beirão, Manuel Chivonde (Nito Alves), Nuno Álvaro Dala, Afonso Mahenda Matias (Mbanza Hanza), Nelson Dibango Mendes dos Santos, Itler Jessy Chivonde (Itler Samussuko), Albano Evaristo Bingocabingo, Sedrick Domingos de Carvalho, Fernando António Tomás (Nicolas o Radical), Arante Kivuvu Italiano Lopes, Benedito Jeremias, José Gomes Hata (Cheick Hata), Inocêncio António de Brito ">

	<meta property="og:title" content="<?php echo translation($language, 'site_title'); ?>" />
	<meta property="og:type" content="non_profit" />
	<meta property="og:url" content="https://liberdade-ja.com/" />
	<meta property="og:image" content="https://liberdade-ja.com/images/liberdade.png?201510090222" />
	<meta property="og:site_name" content="<?php echo translation($language, 'site_title'); ?>" />
	<meta property="fb:admins" content="1685315056" />
	<meta property="fb:app_id" content="982790748442723" />
	<meta property="og:description" content="<?php echo translation($language, 'site_description'); ?>" />

	<title><?php echo translation($language, 'site_long_title'); ?></title>

	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
	<link rel="stylesheet" href="<?php echo BASEURL; ?>/css/app.css">

</head>
<body data-lang="en">

	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-68681219-1', 'auto');
	  ga('send', 'pageview');

	</script>

	<div class="freedomnow">

		<div class="language-selector">
			<ul>
				<li class="<?php echo $language == 'pt' ? 'active' : '' ?>"><a href="<?php echo BASEURL . '/pt' ?>">português</a></li>
				<li class="<?php echo $language == 'en' ? 'active' : '' ?>"><a href="<?php echo BASEURL . '/en' ?>">english</a></li>
			</ul>
		</div>

		<!-- start: clock -->
		<div class="clock-module npe">

			<div class="row r1">

				<div>

					<div class="col col-1">
						<p><span class="count-to" data-count-to="diasPresos">0</span></p>
					</div>
					<div class="col col-2">
						<p><?php echo translation($language, 'dias_presos'); ?></p>
					</div>

				</div>

			</div>

			<div class="row r2">

				<div>

					<div class="col col-1">
						<p><span class="count-to" data-count-to="greveFome">0</span></p>
					</div>

					<div class="col col-2">
						<p><?php echo translation($language, 'greve_fome'); ?></p>
					</div>

				</div>

			</div>

			<!-- topbox bottom bar -->
			<div class="topbox-bot-bar">

				<div class="arrow-down animated infinite floating">
					<img src="<?php echo BASEURL; ?>/images/icon-arrow-down.svg" alt="">
				</div>

				<img class="logo-freedomnow npe" src="<?php echo BASEURL; ?>/images/logo-freedomnow.jpg?201509300133" alt="Liberdade ja! Freedom Now!">

			</div>
			<!-- topbox bottom bar -->


		</div>
		<!-- end: clock -->

		<!-- start: appeal grid -->
		<div ng-app="photobox">
			<div class="appeal-grid-module" ng-controller="mainController" load-more>
				
				<div ng-repeat="post in posts track by $index">				 
					<div photobox class="photo-box anim-hover photo-popup" data-index="{{ $index }}" data-id="{{ post.ID }}" data-name="{{ post.title }}" data-img-lrg="{{ post.src }}">
						<img src="{{ post.src }}" alt="">
					</div>
					<div ng-if="$index == 3">
						<!-- start: photo submit tile -->
						<div class="photo-box photo-box-submit-cta anim-hover" data-cta="photo-submit">
							<p>
								<?php echo translation($language, 'quero_participar'); ?>
							</p>
							<div class="arrow">
								<img class="animated infinite floating" src="<?php echo BASEURL; ?>/images/icon-arrow-down.svg" alt="">
							</div>
							<div class="hashtags">
								<span class="hashtag">#liberdadeja</span>
								<span class="hashtag">#freedomnow</span>
							</div>
						</div>
						<!-- end: photo submit tile -->
					</div>
					<div ng-if="$index == 8">
						<!-- start: contact info tile -->
						<div class="photo-box general-tile who-we-are-tile" data-cta="who-we-area-box">
							<!--
							<p>
								<span>Contacto</span>
								<span class="group-email-contact"></span>
							</p>
							-->
							<div class="who-we-are-el">
								<?php echo translation($language, 'ler_quem_somos'); ?>
							</div>
							<div class="arrow">
								<img class="animated infinite floating" src="<?php echo BASEURL; ?>/images/icon-arrow-down.svg" alt="">
							</div>
						</div>
						<!-- end: contact info tile -->
					</div>
					<div ng-if="$index == 13">
						<!-- start: contact info tile -->
						<div class="photo-box general-tile amnistia-internacional" data-cta="contact-email">
							<img src="<?php echo BASEURL; ?>/images/amnesty-international.png?20151008" alt="">
						</div>
						<!-- end: contact info tile -->
					</div>
					<div ng-if="$index == 16">
						<!-- start: privacy policy tile -->
						<div class="photo-box general-tile visit-us-on-facebook" data-cta="visit-us-on-facebook">
							<!--
							<div class="fb-icon-wrp">
								<img src="images/icon-fb.png" alt="">
							</div>
							-->
							<p>
								<?php echo translation($language, 'visita_nos_facebook'); ?>
							</p>
							<div class="arrow">
								<img class="animated infinite floating" src="<?php echo BASEURL; ?>/images/icon-arrow-down.svg" alt="">
							</div>
						</div>
						<!-- end: privacy policy tile -->
					</div>
				</div>
 
			</div>
		</div>
		<!-- end: appeal grid -->

		<!-- start: appeal popup -->
		<div class="appeal-popup-module" data-current-index="-1">

			<div class="img-container">

				<div class="nav-ctrl">
					<button class="next"><?php echo translation($language, 'proximo'); ?></button>
					<button class="cta-appeal how-to-appeal"><?php echo translation($language, 'participar'); ?></button>
					<button class="cta-appeal fb-share-btn" data-image=""></button>
				</div>
				<button class="close"><?php echo translation($language, 'fechar'); ?></button>
			</div>

		</div>
		<!-- end: appeal popup -->

		<!-- start: form -->
		<div class="form-file-module">

			<form name="myFileForm" class="myFileForm" action="#" method="post" enctype="multipart/form-data">

				<div class="user-data">
					<div class="close"></div>
					<div class="inp-photo-wrap">
						<h3><?php echo translation($language, 'enviar_foto_apelo'); ?></h3>
						<input type="file" name="file" accept="image/png, image/gif, image/jpeg">
						<div class="browse-photo" data-default-text="<?php echo translation($language, 'seleccionar_foto'); ?>"><?php echo translation($language, 'seleccionar_foto'); ?></div>
					</div>
					<div class="permission-options">
						<h3><?php echo translation($language, 'agradecemos_permissao'); ?>:</h3>

						<textarea class="facebook-share-message" name="facebook-share-message" placeholder="<?php echo translation($language, 'mensagem_partilha_facebook'); ?>"></textarea>

						<label>
							<input class="permission-checkbox" type="checkbox" name="tick-facebook" value="facebook">
							<span><?php echo translation($language, 'partilhar_apelo_facebook'); ?></span>
						</label>
						<label>
							<input class="permission-checkbox" type="checkbox" name="tick-email-publish" value="email_entities">
							<span><?php echo translation($language, 'enviar_para_entidades'); ?></span>
						</label>
					</div>
					<div class="email-only-permissions-data">
						<h3><?php echo translation($language, 'qual_nome_email'); ?></h3>
						<label>
							<span><?php echo translation($language, 'form_nome'); ?></span>
							<input type="text" name="fullname" value="" placeholder="<?php echo translation($language, 'form_nome_placeholder'); ?>">
						</label>
						<label>
							<span><?php echo translation($language, 'form_email'); ?></span>
							<input type="text" name="email" value="" placeholder="<?php echo translation($language, 'form_email_placeholder'); ?>">
						</label>
					</div>
					<div class="extended-email">
						<label class="click-email-preview-wrp">
							<span><?php echo translation($language, 'form_preview_email'); ?></span>
						</label>
					</div>
					<div class="form-errors"></div>
					<div class="note-about-share">
						<?php echo translation($language, 'form_about_photo_approvals'); ?>
					</div>
					<div>
						<input class="confirm" type="submit" value="<?php echo translation($language, 'form_confirmar'); ?>">
						<span class="loading animated infinite loading">&#9679;</span>
					</div>
				</div>

				<!-- start: success message -->
				<div class="form-success-message">
					<p><?php echo translation($language, 'form_success_message'); ?></p>
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
			<div><?php echo translation($language, 'email_preview_your_name_here'); ?></div>
			<div class="photo">
				<img src="<?php echo BASEURL; ?>/images/person-icon.png" alt="">
				<span><?php echo translation($language, 'email_preview_about_this_photo'); ?></span>
			</div>
		</div>
		<!-- end: email preview -->

		<!-- start: who we are -->
		<div class="who-we-are">
			<div class="close"></div>
			<div class="content">
			</div>
		</div>
		<!-- end: who are we -->

		<div style="display: none;">

				<!-- start: photo submit tile -->
				<div class="photo-box photo-box-submit-cta anim-hover" data-cta="photo-submit">
					<p>
						<?php echo translation($language, 'quero_participar'); ?>
					</p>
					<div class="arrow">
						<img class="animated infinite floating" src="<?php echo BASEURL; ?>/images/icon-arrow-down.svg" alt="">
					</div>
					<div class="hashtags">
						<span class="hashtag">#liberdadeja</span>
						<span class="hashtag">#freedomnow</span>
					</div>
				</div>
				<!-- end: photo submit tile -->


				<!-- start: contact info tile -->
				<div class="photo-box general-tile who-we-are-tile" data-cta="who-we-area-box">
					<!--
					<p>
						<span>Contacto</span>
						<span class="group-email-contact"></span>
					</p>
					-->
					<div class="who-we-are-el">
						<?php echo translation($language, 'ler_quem_somos'); ?>
					</div>
					<div class="arrow">
						<img class="animated infinite floating" src="<?php echo BASEURL; ?>/images/icon-arrow-down.svg" alt="">
					</div>
				</div>
				<!-- end: contact info tile -->


				<!-- start: contact info tile -->
				<div class="photo-box general-tile amnistia-internacional" data-cta="contact-email">
					<img src="<?php echo BASEURL; ?>/images/amnesty-international.png?20151008" alt="">
				</div>
				<!-- end: contact info tile -->

				<!-- start: privacy policy tile -->
				<div class="photo-box general-tile visit-us-on-facebook" data-cta="visit-us-on-facebook">
					<!--
					<div class="fb-icon-wrp">
						<img src="images/icon-fb.png" alt="">
					</div>
					-->
					<p>
						<?php echo translation($language, 'visita_nos_facebook'); ?>
					</p>
					<div class="arrow">
						<img class="animated infinite floating" src="<?php echo BASEURL; ?>/images/icon-arrow-down.svg" alt="">
					</div>
				</div>
				<!-- end: privacy policy tile -->

		</div>

	</div>

	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/3.1.8/imagesloaded.pkgd.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/3.10.1/lodash.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.7/angular.min.js"></script>
	<script src="<?php echo BASEURL; ?>/js/vendor/validate.min.js"></script>
	<script src="<?php echo BASEURL; ?>/js/vendor/console-polyfill.js"></script>
	<script src="<?php echo BASEURL; ?>/js/vendor/base64.min.js"></script>
	<script src="<?php echo BASEURL; ?>/js/vendor/json-polyfill.js"></script>
	<script src="<?php echo BASEURL; ?>/js/vendor/xhr-polyfill.min.js"></script>
	<script src="<?php echo BASEURL; ?>/js/app.js"></script>

</body>
</html>