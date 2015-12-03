var conceptos = new Array();
var totales = new Array();
function selecionObraTerminado (data) {
	var num = data.cotizaciones.length;
	var e = "<option value=''>Seleccione una estimación</option>";
	for (var i = 0; i < num; i++) {
		e += "<option value='"+data.cotizaciones[i].id+"'>"+data.cotizaciones[i].estimacion_e+"</option>";	
	}
	$("#estimacion").html(e);
	//console.log(e);
	if($("#estimacion").val() == "") {
		$("#caja").css({"display":"none"});
		$("#caja1").css({"display":"none"});
	}
}

function guardarTerminado () {
	window.location.href = $("#form").attr("data-lista"); 
}
function seleccionarEstimacionTerminado (data) {
 var num = data.contratistas.length;
	var e = "<option value=''>Seleccione un contratista</option>";
	for (var i = 0; i < num; i++) {
		e += "<option value='"+data.contratistas[i].id+"'>"+data.contratistas[i].name+"</option>";	
	}
	$("#contratista").html(e);
	//console.log(e);
	if($("#contratista").val() == "") {
		$("#caja").css({"display":"none"});
		$("#caja1").css({"display":"none"});
	}
}
$(document).ready(function(){
	$("#obra").change(function(){
		$("#form").attr("data-obra",this.value);
		$.ajax({
			url: $("#form").attr("data-url"),
			type: "post",
			data: {
				id: this.value,
				_token: $("#token").val()
			},
			dataType: "json",
			success: selecionObraTerminado
		});
	});
	$("#estimacion").change(function(){
		$("#form").attr("data-estimacion",this.value);
			if(this.value != "") {
				$.ajax({
					url: $("#form").attr("data-contratistas"),
					type: "post",
					data: {
						id: this.value,
						_token: $("#token").val()
					}, 
					dataType: "json",

					success: seleccionarEstimacionTerminado
				});
			}
		if(this.value != "" && $("#contratista").val() != "") {
			$("#caja").css({"display":"yes"});
			$("#caja1").css({"display":"yes"});
		} else {
			$("#contratista").html("<option value=''>Contratista</option>");
			$("#caja").css({"display":"none"});
			$("#caja1").css({"display":"none"});
			//$("#agregar").css({"display":"none"});
			//$("#guardar").css({"display":"none"});
			$("#table").css({"display":"none"});
		}
	});
	$("#contratista").change(function(){
		if(this.value != "") {
			$("#caja").css({"display":"yes"});
			$("#caja1").css({"display":"yes"});
		} else {
			$("#caja").css({"display":"none"});
			$("#caja1").css({"display":"none"});
			//$("#agregar").css({"display":"none"});
			//$("#guardar").css({"display":"none"});
			$("#table").css({"display":"none"});
		}
	});
	$("#agregar").click(function(){
		var concepto = $("#concepto");
		var total = $("#total");
		if (concepto.val() == "" || concepto.val() == null) {
			$("#error1").html("Campo requerido");
			return false;
		} else {
			$("#error1").html("");
		}
		if (total.val() == "" || total.val() == null) {
			$("#error2").html("Campo requerido");
			return false;
		} else {
			$("#error2").html("");
		}
		conceptos.push(concepto.val());
		totales.push(total.val());
		concepto.val("");
		total.val("");
		var table = "<tr><th>Concepto</th><th>Total</th></tr>";
		for (var i = 0; i < conceptos.length; i++) {
			table += "<tr><td>"+conceptos[i]+"</td> <td> $ "+totales[i]+"</td></tr>";	
		}
		$("#tabla").html(table);
		$("#tabla").css({"display":"yes"});
	});
	$("#guardar").click(function(){
		$.ajax({
			url: $("#form").attr("data-i"),
			type: "post",
			data: {
				_token: $("#token").val(),
				c: conceptos,
				t: totales,
				i: $("#iva").val(),
				obra: $("#form").attr("data-obra"),
				estimacion: $("#form").attr("data-estimacion") ,
				contratista: $("#contratista").val()
			},
			dataType: "json",
			success: guardarTerminado
		});
	});
});