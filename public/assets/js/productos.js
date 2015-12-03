var imgs = {f:[]};
var num = 0;
var count = 1;
var id;
function del () {
	
	$(".del").click(function(){
		var id = $(this).attr("id");
		imgs.f.splice(id,1);
		var filess = "";
		for (var i in imgs.f) {
			filess += "<tr><td>"+imgs.f[i].name+"</td><td> <button class='del btn btn-danger' id='"+i+"'>X</button><td></tr>";
		}
		$("#lista").html(filess);
		del();
	});
}
function subir (e) {
	http = new XMLHttpRequest();
	var file = new FormData();
		file.append("file",imgs.f[num]);
		file.append("id",id);
		file.append("_token",$("#token").val());
		file.append("num",count)
	var	upload = http.upload;
		upload.addEventListener("load",cargado,false);
		http.open("POST",$("#form").attr("data-image"));
		http.send(file);
}
function cargado (e) {
	if (num < imgs.f.length-1)
	{
		num++
		count++;
		subir();
	} else {
		window.location.href = $("#form").attr("data-lista");
		num = 0;
	}
}
function loadSubTerminado (data) {
	var sub = "<option value=''>Seleccionar Subategoría...</option>";
	var num = data.sub.length;
	for (var i = 0; i < num; i++) {
		sub += "<option value='"+data.sub[i].id+"'>"+data.sub[i].name+"</option>";
	}
	$("#sub").html(sub);
}
function guardarTerminado (data) {
	id = data.id
	subir();
}
$(document).ready(function(){
	$("#categorias").change(function(){
		$.ajax({
			url: $("#form").attr("data-load"),
			type: "post",
			data: {
				id: this.value,
				_token: $("#token").val()
			},
			dataType: "json",
			success: loadSubTerminado 
		});
	});
	$("#imgs").change(function(){
		imgs.f.push(this.files[0]);
		var filess = "";
		for (var i in imgs.f) {
			filess += "<tr><td>"+imgs.f[i].name+"</td> <td><button class='del btn btn-danger' id='"+i+"'>X</button></td></tr>";
		}
		$("#lista").html(filess);
		del();
	});
	
	$("#guardar").click(function(){
		
		$(this).attr("disabled",true)
		
		$.ajax({
			url: $("#form").attr("data-productos"),
			type: "post",
			data: $("#form").serialize(),
			dataType: "json",
			success: guardarTerminado
		});
		
	});
	
});