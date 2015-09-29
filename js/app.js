(function () {

	function FreedomNow() {
		this.init();
	}

	FreedomNow.prototype = {
		init: function () {
			console.log('init!');
			this.setVars();
		},

		setVars: function () {

			this.photoBoxes = document.querySelectorAll('.photo-box');
			this.setPhotoBoxesSize();
		},

		setPhotoBoxesSize: function () {
			var docWidth = window.innerWidth,
				w = docWidth / 4;


			for (var i = 0; i < this.photoBoxes.length; i++) {

				this.photoBoxes[i].style.width = w + 'px';
				this.photoBoxes[i].style.height = w + 'px';
			}

		}
	};

	window.FreedomNow = new FreedomNow();

}());