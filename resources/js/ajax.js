$(document).ready(function(){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$(".btn-primary").click(
		function(){
			let id = this.id.slice(7);
			window.location.href = `autos/${id}`;
			return false;
		}
    );

    $(".btn-danger").click(
		function(){
			let id = this.id.slice(7);
			var request = $.ajax({
				method: "DELETE",
				url: `autos/${id}`,
			  });

			request.done(function( msg ) {
			window.location.href = "/";
			});
			return false;
		}
	);
});
