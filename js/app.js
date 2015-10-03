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
			this.setInitialDays();
			this.appealGridModule = document.querySelectorAll('.appeal-grid-module');

			this.arrowDown = document.querySelector('.arrow-down');
			this.clockModule = document.querySelector('.clock-module');

			this.fbSdkLoader();

			this.resizeThrottleMs = 30;
			this.scrollToMs = 800;

			this.appealPopupModule = document.querySelector('.appeal-popup-module');
			this.photoBoxPopupMs = 100;
			this.counterMs = 200;
			this.counterEasingAmount = 0.0500;
			this.ctaAppeal = document.querySelector('.cta-appeal');
			this.formFileModule = document.querySelector('.form-file-module');
			this.formFile = document.querySelector('.myFileForm');
			this.formFileCloseBtn = document.querySelector('.form-file-module .close');
			this.formConfirmBtn = document.querySelector('.form-file-module .confirm');
			this.ctaAppealTransitionMs = 1000;
			this.photoBoxSubmitCta = document.querySelector('.photo-box-submit-cta');
			this.formSuccessMessage = document.querySelector('.form-success-message');
			this.formUserData = document.querySelector('.form-file-module .user-data')
			this.formSuccessMessageStartMs = 800;
			this.formSuccessMessageEndMs = 5000;
			this.contactEmailCta = document.querySelector('.contact-email');
			this.signPetitionCta = document.querySelector('.amnistia-internacional-portugal');
			this.popupImgContainer = document.querySelector('.appeal-popup-module .img-container');
			this.popupNextBtn = document.querySelector('.nav-ctrl .next');
			this.userPermissions = {
				facebook: false, // todo: remove default to 'true' during development
				email_entities: false
			};
			this.checkboxFacebook = document.querySelector('input[name="tick-facebook"]');
			this.checkboxEmailPublish = document.querySelector('input[name="tick-email-publish"]');
			this.permissionCheckboxes = document.querySelectorAll('.permission-checkbox');
			this.formSubmitLockedMs = 10000;

			this.mandrillApiKey = 'RBG5r0gp1Fd4zylgpkIZFQ';

			this.emailOnlyPermissionsData = document.querySelector('.email-only-permissions-data');
			this.formErrors = document.querySelector('.form-errors');

		},

		calcBoxWidth: function () {

			var docWidth = document.body.clientWidth,
				factor = docWidth > 767 ? (docWidth > 1024 ? 4 : 3) : 2, // mobile, tablet & desktop nr columns
				w = docWidth / factor;

			return w;

		},

		setPhotoBoxesSize: function () {

			var w = this.calcBoxWidth();

			for (var i = 0; i < this.photoBoxes.length; i++) {

				this.photoBoxes[i].style.width = w + 'px';
				this.photoBoxes[i].style.height = w + 'px';

				this.setPhotoBoxEvents.call(this, this.photoBoxes[i]);

			}

			this.photoBoxWidth = w;

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
					this.formFileClose.call(this);
				}

			}.bind(this));

			/*
			 * todo: this should be called after validation
			// the fn is throttled, allowin only once submition every Xseconds
			this.formFile.addEventListener('submit', _.throttle(this.formHandler.bind(this), this.formSubmitLockedMs), false);
			*/

			// just to prevent default
			this.formFile.addEventListener('submit', function (e) {
				e.preventDefault();
			}, false);

			this.formFileCloseBtn.addEventListener('click', function () {
				console.log('formFileCloseBtn event click!');
				this.formFileClose.call(this);
			}.bind(this), false);

			this.photoBoxSubmitCta.addEventListener('click', function () {
				this.formFileModule.style.display = 'block';
				this.formFileModule.style.opacity = 1;
			}.bind(this));

			this.contactEmailCta.addEventListener('click', function () {

				window.location.href = "mailto: mail@example.org";

			}.bind(this));

			this.signPetitionCta.addEventListener('click', function () {

				var url = 'http://www.amnistia-internacional.pt/index.php?option=com_wrapper&view=wrapper&Itemid=40&sf_pid=a077000000TcpJGAAZ';
				window.open(url, '_blank', '');

			}.bind(this));

			this.popupNextBtn.addEventListener('click', function () {
				this.nextBtnHandler.call(this);
			}.bind(this));

			// permission checkboxes
			for (var i = 0; i < this.permissionCheckboxes.length; i++) {
				
				this.permissionCheckboxes[i].addEventListener('click', function (e) {

					this.userPermissions[e.target.value.toLowerCase()] = e.target.checked;

					console.log('this.userPermissions', this.userPermissions);
					// todo: check if 'this.emailOnlyPermissionsData' show be displayed
					this.displayEmailOnlyPermissionsData();

				}.bind(this));

			}

			// validation lib
			this.formValidator = new FormValidator('myFileForm', [{
			    name: 'file',
			    rules: 'required'
			}, {
			    name: 'fullname',
			    rules: 'required|min_length[2]'
			}, {
			    name: 'email',
			    rules: 'required|valid_email'
			}], function(errors, event) {

				console.log('errors', errors);
				console.log('event', event);

					if (errors.length > 0) {

						var errorString = '';

						for (var i = 0, errorLength = errors.length; i < errorLength; i++) {

							errorString += errors[i].message + '<br />';

						}

						this.formErrors.innerHTML = errorString;

						this.formErrors.style.display = 'block';

						// todo: add exception if facebook is ticked,
						// only validate if 'file' was choosen
						console.log('this.userPermissions', this.userPermissions);
						if ((this.userPermissions.facebook === this.userPermissions.email_entities) && errors[0].name !== 'file') {

							this.formErrors.style.display = '';

							// submit form
							this.formHandler.call(this);

						} else if (this.userPermissions.facebook) {
							
							this.formErrors.style.display = '';

							// submit form
							this.formHandler.call(this);

						}

					} else {

						this.formErrors.style.display = '';

						// submit form
						this.formHandler.call(this);

					}

			}.bind(this));
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
				  appId      : '982790748442723',
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
			// todo: the next event is triggered > 1, for some reason ?!
			// note: on window resize this is called, so the event is attached multi times
			var listener = function (e) {

				if (e.target.className.indexOf('photo-popup') === -1) {
					return false;
				}

				this.setPopupData.call(this, el);

				this.appealPopupModule.style.display = "block";

				setTimeout(function () {
					this.appealPopupModule.style.opacity = 1;
				}.bind(this), this.photoBoxPopupMs);

				document.querySelector('.appeal-popup-module .close').addEventListener('click', function (e) {

					this.closePopup.call(this);

				}.bind(this));

			};

			el.removeEventListener('click', listener, false);
			el.addEventListener('click', listener.bind(this), false);

		},

		closePopup: function () {
			this.popupNextBtn.style.display = '';
			this.appealPopupModule.style.opacity = 0;

			setTimeout(function () {
				this.appealPopupModule.style.opacity = '';
				this.appealPopupModule.style.display = '';
			}.bind(this), this.photoBoxPopupMs);
		},

		setPopupData: function (el) {

			var src = el.querySelector('img').getAttribute('src');

			this.popupImgContainer.style.backgroundImage = 'url(' + src + ')';
			this.appealPopupModule.setAttribute('data-current-index', el.getAttribute('data-index'));
		},

		formFileClose: function () {
			console.log('formFileClose()');
			this.formFileModule.style.opacity = 0;
			setTimeout(function () {
				this.formFileModule.style.display = '';
				this.formReset.call(this);
			}.bind(this), 800);
		},

		formReset: function () {
			console.log('formReset()');
			this.formUserData.style.opacity = '';
			this.formUserData.style.display = '';
			this.formSuccessMessage.style.display = '';
			this.formSuccessMessage.style.opacity = '';
			this.formFileModule.classList.remove('submited');
		},

		getDays: function (name) {

			var start,
				now = moment();

			if (name === 'greveFome') {

				start = moment("2015-09-20");

			} else if (name === 'diasPresos') {

				start = moment("2015-06-20");

			}

			return	now.diff(start, "days");
		},

		setInitialDays: function () {

			for (var i = 0; i < this.counters.length; i++) {
				var name = this.counters[i].getAttribute('data-count-to'),
					days = this.getDays(name);
				this.counters[i].setAttribute('data-count-to', days);
			}

		},

		formHandler: function () {
			this.formFileModule.classList.add('submited');
			console.log('formHandler!');
			this.saveFile();
		},

		saveFile: function () {

			console.log('saveFile');

			// This variables will be used to store the form data
			var context = this,
				file = document.querySelector('input[name="file"]').files[0],
				fd = new FormData();

			fd.append("file", file);

			var xhr = new XMLHttpRequest();

			xhr.open('POST', 'cms/wp-json/media', true);

			xhr.setRequestHeader("Authorization", "Basic " + btoa("public:Q5MJ7G7MlN&z4bCJEywtxZvW"));

			xhr.addEventListener('load', function () {
				if (this.status >= 200 && this.status <= 300) {
					var resp = JSON.parse(this.response);
					context.savePost(resp);
				} else {
					alert('Error: Are you logged in the system ? Logout and try again please, thank you!');
					// todo: close popup
					context.formFileClose.call(context);
				}
				console.log(this.status);
			});

			xhr.addEventListener('progress', function (e) {
				if (e.lengthComputable) {
					var percentComplete = (e.loaded / e.total) * 100;
					console.log(percentComplete + '% uploaded');
				}
			});

			xhr.send(fd);

		},

		savePost: function (data) {

			console.log('savePost');
			var context = this;
			var xhr = new XMLHttpRequest();
			var params = "title=foobar&content_raw=" + data.content + (this.userPermissions.facebook ? "&status=publish" : null);

			xhr.open('POST', 'cms/wp-json/posts', true);

			xhr.setRequestHeader("Authorization", "Basic " + btoa("public:Q5MJ7G7MlN&z4bCJEywtxZvW"));
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

			xhr.addEventListener('load', function () {
				if (this.status >= 200 && this.status <= 300) {
					var resp = JSON.parse(this.response);

					// if facebook accepted, get permissions, share
					// only after, proceed to display success message
					if (context.userPermissions.facebook) {
						context.facebookShare.call(context, resp, context.postedSuccessHandler.call(context, resp));
					} else {
						context.postedSuccessHandler.call(context, resp);
					}

					// if email-publish accepted, convert img to base64
					// and send to email list using email lib
					context.emailPublishHandler.call(context, resp);

				}

				console.log(this.status);
			});

			xhr.send(params);
		},

		facebookShare: function (data, callback) {

			var context = this;

			// request facebook auth
			window.FB.getLoginStatus(function (response) {
				
				console.log(response);

				if (response.status === 'connected') {
				
					context.sharePhotoToFacebookWall(data, callback);
				
				} else {

					FB.login(function(response) {

						// todo: check if correct permissions
						context.sharePhotoToFacebookWall(data, callback);

					},{ scope: 'email,publish_actions' });  
				
				}

			});

		},

		sharePhotoToFacebookWall: function (data, callback) {

			window.FB.api('/me/feed', 'post', {
				message : "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate sunt explicabo similique inventore magni dolorum laboriosam distinctio est incidunt harum autem laborum earum quisquam tempore quae reiciendis alias natus, placeat. http://www.bbc.co.uk http://www.rt.com",
				name : 'Liberdade ja!',
				link : 'http://freedomnow.punkbit.com',
				description : 'Lorem ipsum dolorem shortium soloriam freedomnow site description here',
				picture : this.extractSrc(data.content)
			}, function (response) {
				if (!response || response.error) {
					console.log('Posting error occured');
				}
				else {
					console.log('Success - Post ID: ' + response.id);

					if (typeof callback === "function") {
						callback.call(this);
					}

				}
			});

		},

		postedSuccessHandler: function (data) {

			this.formUserData.style.opacity = 0;

			setTimeout(function () {

				this.formUserData.style.display = 'none';
				this.formSuccessMessage.style.display = 'block';
				this.formSuccessMessage.style.opacity = 1;

				// todo: if user accepted sharing on facebook
				if (this.userPermissions.facebook) {
					// todo: request facebook permissions

					var src = this.extractSrc(data.content);
					this.createPhotoBox(src);
				}

				// close
				setTimeout(function () {
					this.formFileClose.call(this);
				}.bind(this), this.formSuccessMessageEndMs);


			}.bind(this), this.formSuccessMessageStartMs);

		},

		nextBtnHandler: function () {

			var currentIndex = this.appealPopupModule.getAttribute('data-current-index'),
				nextIndex = (parseInt(currentIndex) + 1),
				image_src = document.querySelectorAll('.photo-popup')[nextIndex] ? document.querySelectorAll('.photo-popup')[nextIndex].querySelector('img').getAttribute('src') : false;

			if (image_src) {

				this.appealPopupModule.querySelector('.img-container').style.backgroundImage = "url(" + image_src + ")";
				this.appealPopupModule.setAttribute('data-current-index', nextIndex);

			} else {

				this.popupNextBtn.style.display = 'none';

			}

		},

		extractSrc: function (html) {

			var myRegex = /<img[^>]+src="(http:\/\/[^">]+)"/g;

			return myRegex.exec(html)[1];

		},

		createPhotoBox: function (src) {

			var div = document.createElement('div');
			var img = document.createElement('img');
			var w = this.calcBoxWidth();

			div.setAttribute('class', "photo-box anim-hover photo-popup");
			div.setAttribute('data-index', '0');
			div.setAttribute('data-name', '');
			img.setAttribute('src', src);

			div.appendChild(img);

			div.style.width = w + 'px';
			div.style.height = w + 'px';

			this.photoBoxes[0].parentNode.insertBefore(div, this.photoBoxes[0]);

			// queue last after DOM manip
			setTimeout(function(){
				this.resetPhotoboxIndexes.call(this);
			}.bind(this), 0);

		},

		resetPhotoboxIndexes: function () {
			this.photoBoxes = document.querySelectorAll('.photo-box');
			this.setPhotoBoxesSize();
		},

		convertImgToBase64URL: function (url, callback, outputFormat) {

			var img = new Image();

			img.crossOrigin = 'Anonymous';

			img.onload = function(){
			    var canvas = document.createElement('CANVAS'),
			    	ctx = canvas.getContext('2d'),
			    	dataURL;
			    
			    canvas.height = this.height;
			    canvas.width = this.width;
			    
			    ctx.drawImage(this, 0, 0);
			    
			    dataURL = canvas.toDataURL(outputFormat);
			    
			    callback(dataURL);
			    
			    canvas = null; 
			};

			img.src = url;

		},

		emailPublishHandler: function (data) {

			console.log('emailPublishHandler call');

			var src = this.extractSrc(data.content);

			// if email-publish accepted, convert img to base64
			// and send to email list using email lib
			this.convertImgToBase64URL(src, function (base64img) {
				var params = {
					'mandrillApiKey': this.mandrillApiKey,
					'base64img': base64img.split('base64,')[1], // remove unwanted base64 prefix
					'from_email': document.querySelector('.email-only-permissions-data input[name="email"]').value,
					'to': [{
							'email': 'info@punkbit.com',
							'name': 'Punkbit',
							'type': 'to'
						}, {
							'email': 'pedrocorreiadacosta@gmail.com',
							'name': 'Pedro',
							'type': 'to'
						}, {
							'email': 'zashavozoff@gmail.com',
							'name': 'Mario',
							'type': 'to'
						}],
					'subject': 'TEST: Liberdade ja!', // todo: get this from cms article
					'html': 'todo: get html/content from wp backend article'
				};

				console.log('params', params);

				if (this.userPermissions.facebook) {
	
					FB.api('/me', { fields: 'name, email' }, function (response) {
	
						params.from_email = response.email;
						this.sendEmail.call(this, params);
						console.log('FB.api /me, response: ', response);
						console.log('FB.api /me, name, email: ', params);	
					}.bind(this));
	
				} else {
	
					this.sendEmail.call(this, params);
	
				}

			}.bind(this), 'image/jpg');

		},

		sendEmail: function (params){

			console.log('sendEmail call');

			var context = this,

			 	data = {
					'key': params.mandrillApiKey,
					'message': {
						'from_email': params.from_email,
						'to': params.to,
						'subject': params.subject,
						'html': params.html,
						'attachments': [{
							'type': 'image/jpeg',
							'name':  Math.random().toString(36).substr(2) + '.jpg',
							'content': params.base64img
						}]
					}
				},

				url = 'https://mandrillapp.com/api/1.0/messages/send.json',

				// construct an HTTP request
				xhr = new XMLHttpRequest();

			console.log(data);

			xhr.open('POST', url, true);

			xhr.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');

			// send the collected data as JSON
			xhr.send(JSON.stringify(data));

			xhr.addEventListener("load", function (res) {

				console.log('email xhr load event!');
				console.log(res);

				console.log('todo: show loading animation');

			});

			xhr.addEventListener('readystatechange', function() {
				
				console.log('readystatechange : this.status', this.status);
				console.log('readystatechange: this:', this);

				if (this.readyState == 4 && this.status == 200) {

					var response = this.responseText;

					console.log('readystatechange: todo: show success message');

				}

			});

			xhr.addEventListener("error", function (res) {

				console.log('todo: show error message');

			});

		},

		displayEmailOnlyPermissionsData: function () {

			if (!this.userPermissions.facebook && this.userPermissions.email_entities) {

				this.emailOnlyPermissionsData.style.display = "block";

			} else {

				this.emailOnlyPermissionsData.style.display = "";				

			}

		}

	};

	window.FreedomNow = new FreedomNow();

}());