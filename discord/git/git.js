$(document).ready(function() {
	$('#play').on('click', function(ev) {
		$(".video").each(function(i) {
			console.log(i)
			this.src += "?autoplay=1";
			this.src = this.src;
		})
		ev.preventDefault();
	});
});
