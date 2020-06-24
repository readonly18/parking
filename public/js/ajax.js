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

	/*$("#autoFormAdder").click(
		function(){
		$(".automobile").append("<div class=\"input-group input-group-sm mb-3\">\
			<div class=\"input-group-prepend\">\
			<span class=\"input-group-text\">Марка </span>\
			</div>");
		$(".automobile").append("<input type=\"text\" name = \"brand\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-sm\" required>\
			</div>");
        $(".automobile").append("<div class=\"input-group input-group-sm mb-3\">\
            <div class=\"input-group-prepend\">\
                <span class=\"input-group-text\">Модель </span>\
            </div>");
		$(".automobile").append("<input type=\"text\" name = \"model\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-sm\" required>\
        	</div>"); 
        $(".automobile").append("<div class=\"input-group input-group-sm mb-3\">\
            <div class=\"input-group-prepend\">\
                <span class=\"input-group-text\">Цвет кузова </span>\
            </div>");
		$(".automobile").append("<input type=\"text\" name = \"color\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-sm\" required>\
        	</div>");
        $(".automobile").append("<div class=\"input-group input-group-sm mb-3\">\
            <div class=\"input-group-prepend\">\
                <span class=\"input-group-text\">Гос номер</span>\
            </div>");
		$(".automobile").append("<input type=\"text\" name = \"plate_number\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-sm\" required>\
        	</div>");
        $(".automobile").append("<div class=\"input-group mb-3\">\
			<div class=\"input-group-prepend\">\
				<label class=\"input-group-text\" for=\"parking_status\">Припаркован</label>\
			</div>\
			<select class=\"custom-select\" name=\"parking_status\" required>\
				<option value=\"1\">Да</option>\
				<option value=\"0\">Нет</option>\
			</select>\
			</div>\
        	<hr>");
		}
	);*/
});