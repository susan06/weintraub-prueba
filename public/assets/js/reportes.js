$(document).ready(function(){
	$(".iva").change(function(){
		$("#barra").css({"display":"yes"});
		$.ajax({
			url: $("#table-2").attr("data-iva"),
			type: "post",
			data: {
				id: this.id,
				_token: $("#table-2").attr("data-token"),
				valor: this.value,
			},
			dataType: "json",
			success: function(data) {
				window.location.href = $("#table-2").attr("data-location");
			}
		});
	});
});