(function () {

	function FreedomNow() {
		this.init();
	}

	FreedomNow.prototype = {
		init: function () {
			console.log('init!');
			this.setVars();
			this.setListeners();
		},

		setVars: function () {

			this.photoBoxes = document.querySelectorAll('.photo-box');
			this.setPhotoBoxesSize();

			this.counters = document.querySelectorAll('.count-to');

			this.appealGridModule = document.querySelectorAll('.appeal-grid-module');

		},

		setPhotoBoxesSize: function () {

			var docWidth = document.body.clientWidth,
				w = docWidth / 4;

			for (var i = 0; i < this.photoBoxes.length; i++) {

				this.photoBoxes[i].style.width = w + 'px';
				this.photoBoxes[i].style.height = w + 'px';
			
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

			window.addEventListener('resize', function () {

				this.setPhotoBoxesSize.call(this);

			}.bind(this));

			window.addEventListener('startCounter', function () {

				this.startCounter.call(this);

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

			interval = setInterval(function () {
				el.innerHTML = i++;

				if (i === total) {
					clearInterval(interval);
				}
			}, 200);

		}

	};

	window.FreedomNow = new FreedomNow();

}());