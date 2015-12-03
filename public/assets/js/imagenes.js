var pos = "";
$(document).ready(function(){
	$(".seleccionar").change(function(){
		
		pos += ","+$(this).attr("id")+"."+$(this).val();
		console.log(pos);
	});
	$("#actualizar").click(function(){
		a = $("#alerta");
		var data = pos.substr(1);
		pos = "";
		if (data != "") {
			$.ajax({
				url: $("#tabla").attr("data-url"),
				type: "post",
				data: {
					data: data,
					_token: $("#token").val()
				},
				dataType: "json",
				success: function(data) {
					if(data.estado == 1) {
						a.removeClass();
						a.addClass(" alert alert-success");
						a.text("Imagenes ordenadas con exito");
					} else {
						a.removeClass();
						a.addClass("alert alert-danger");
						a.text("Ocurrio un error al ordenar las imagenes");
					}
				}
			});
		} else {
			a.removeClass();
			a.addClass("alert alert-warning");
			a.text("No se a relizado ningun cambio");
		}
	});
});