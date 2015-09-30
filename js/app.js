(function () {

	function FreedomNow() {
		this.init();
	}

	FreedomNow.prototype = {
		init: function () {
			this.setVars();
			this.setListeners();
		},

		setVars: function () {

			this.photoBoxes = document.querySelectorAll('.photo-box');
			this.setPhotoBoxesSize();

			this.counters = document.querySelectorAll('.count-to');

			this.appealGridModule = document.querySelectorAll('.appeal-grid-module');

			this.arrowDown = document.querySelector('.arrow-down');
			this.clockModule = document.querySelector('.clock-module');

			this.fbSdkLoader();

			this.resizeThrottleMs = 30;
			this.scrollToMs = 800;

			this.appealPopupModule = document.querySelector('.appeal-popup-module');
			this.photoBoxPopupMs = 100;
			this.counterMs = 200;
			this.counterEasingAmount = 0.0125;
			this.ctaAppeal = document.querySelector('.cta-appeal');
			this.formFileModule = document.querySelector('.form-file-module');
			this.formFile = document.querySelector('.myFileForm');
			this.ctaAppealTransitionMs = 1000;
		},

		setPhotoBoxesSize: function () {

			var docWidth = document.body.clientWidth,
				factor = docWidth > 767 ? (docWidth > 1024 ? 4 : 3) : 2, // mobile, tablet & desktop nr columns
				w = docWidth / factor;

			for (var i = 0; i < this.photoBoxes.length; i++) {

				this.photoBoxes[i].style.width = w + 'px';
				this.photoBoxes[i].style.height = w + 'px';

				this.setPhotoBoxEvents(this.photoBoxes[i]);
			}

		},

		setListeners: function () {

			document.addEventListener("DOMContentLoaded", function(event) {

				this.triggerEvent({
					name: 'startCounter'
				});

			}.bind(this));

			imagesLoaded(this.appealGridModule).on('always', function () {
				console.log('images preloaded');
			});

			window.addEventListener('resize', _.throttle(this.setPhotoBoxesSize.bind(this), this.resizeThrottleMs));

			window.addEventListener('startCounter', function () {

				this.startCounter.call(this);

			}.bind(this));

			this.arrowDown.addEventListener('click', function () {

				var to = this.clockModule.offsetHeight;
				this.scrollTo.call(this, document.body, to, this.scrollToMs);

			}.bind(this));

			this.appealPopupModule.addEventListener('click', function (e) {

				if (e.target.className.indexOf('appeal-popup-module') > -1) {
					this.closePopup.call(this);
				}

			}.bind(this));

			this.ctaAppeal.addEventListener('click', function () {
				this.closePopup.call(this);

				setTimeout(function () {
					this.formFileModule.style.display = 'block';
					this.formFileModule.style.opacity = 1;
				}.bind(this), this.ctaAppealTransitionMs);

			}.bind(this));

			this.formFileModule.addEventListener('click', function (e) {

				if (e.target.className.indexOf('-module') > -1) {
					this.formFileModule.style.opacity = 0;
					setTimeout(function () {
						this.formFileModule.style.display = '';
					}.bind(this), 800);
				}

			}.bind(this));

			this.formFile.addEventListener('submit', function (e) {
				e.preventDefault();
				console.log('form event submit');
				alert('todo: request facebook auth, fb permissions, save file server side, grab destination file url, post to fb');
			}, false);

		},

		triggerEvent: function (params) {

			// Create the event.
			var event = document.createEvent('Event');;

			// Define that the event name is 'build'.
			event.initEvent(params.name, true, true);

			// target can be any Element or other EventTarget.
			window.dispatchEvent(event);

		},

		startCounter: function () {

			for (var i = 0; i < this.counters.length; i++) {
				this.countTimer(this.counters[i]);
			}

		},

		countTimer: function (el) {

			var total = parseInt(el.getAttribute('data-count-to')),
				i = 0,
				interval;

			/*
			interval = setInterval(function () {
				el.innerHTML = i++;

				if (i > total) {
					clearInterval(interval);
				}

				this.counterMs = this.counterMs > 10 ? this.counterMs - (this.counterMs * 0.01) : 10;

			}.bind(this), this.counterMs);
			*/

			function loop() {
					return setTimeout(function () {

						el.innerHTML = i++;

						if (i <= total) {
							interval = loop.call(this);
						} else {
							clearTimeout(interval);
						}

						this.counterMs = this.counterMs - (this.counterMs * this.counterEasingAmount);

				}.bind(this), this.counterMs);
			}

			interval = loop.call(this);

		},

		scrollTo: function(element, to, duration) {
		    var context = this,
		    	start = element.scrollTop,
		        change = to - start,
		        increment = 20;

		    var animateScroll = function(elapsedTime) {
		        elapsedTime += increment;
		        var position = context.easeInOut(elapsedTime, start, change, duration);
		        element.scrollTop = position;
		        if (elapsedTime < duration) {
		            setTimeout(function() {
		                animateScroll(elapsedTime);
		            }, increment);
		        }
		    };

		    animateScroll(0);
		},

		easeInOut: function(currentTime, start, change, duration) {
		    currentTime /= duration / 2;
		    if (currentTime < 1) {
		        return change / 2 * currentTime * currentTime + start;
		    }
		    currentTime -= 1;
		    return -change / 2 * (currentTime * (currentTime - 2) - 1) + start;
		},

		fbSdkLoader: function () {

			window.fbAsyncInit = function() {
				FB.init({
				  appId      : 'your-app-id',
				  xfbml      : true,
				  version    : 'v2.4'
				});
			};

			(function(d, s, id){
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) {return;}
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/en_US/sdk.js";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));

		},

		setPhotoBoxEvents: function (el) {

			el.addEventListener('click', function (e) {

				this.setPopupData.call(this, el);

				this.appealPopupModule.style.display = "block";

				setTimeout(function () {
					this.appealPopupModule.style.opacity = 1;
				}.bind(this), this.photoBoxPopupMs);

				document.querySelector('.appeal-popup-module .close').addEventListener('click', function (e) {

					this.closePopup.call(this);

				}.bind(this));

			}.bind(this));

		},

		closePopup: function () {
			this.appealPopupModule.style.opacity = 0;

			setTimeout(function () {
				this.appealPopupModule.style.opacity = '';
				this.appealPopupModule.style.display = '';
			}.bind(this), this.photoBoxPopupMs);
		},

		setPopupData: function (el) {

			console.log(el.querySelector('img'));

		}

	};

	window.FreedomNow = new FreedomNow();

}());