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

			window.addEventListener('resize', function () {

				this.setPhotoBoxesSize.call(this);

			}.bind(this));

		}
	};

	window.FreedomNow = new FreedomNow();

}());