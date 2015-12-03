var email1 = $("#email1");

function comprobacionTerminada (data) {
	if (data.dato == 2) {
		email1.popover("show");
		
		email1.click(function(){
			email1.popover("hide");
		});
	}
}

function permisoEstado (id) {
	if ($(id).is(":checked")) {
		return 1;
	} else {
		return 0;
	}
}

function cambioPermisosTerminado (data) {
	$(".alert").css({"display":"block"})
	if(data.estado == 1){
		$(".alert").removeClass("alert-warning");
		$(".alert").addClass("alert-success");
		$(".alert").html("<strong>Cambios realizados con exito</strong>");
		permiso = "";
		permisos = "";
	}

}
function cambiarTablaPermisos (data) {
	$("#caragarPanel").html("");
	$("#caragarPanel").append(data.datos);
	rolesChange();
	cambiarPermiso();
	botonCambiarPermiso();
}


function rolesChange () {
	 permisos = "";
	 $("#roles").change(function(){
		var rol = $("#roles option:selected").text();
		          $("#tituloRol").html(rol);
		          $(".table").attr("data-rol",$("#roles").val());
		   	$.ajax({
				url: "cambiartablapermisos",
				type:"POST",
				data:{
					id: $("#roles").val(),
					role: rol,  
				},
				dataType: "json",
				success: cambiarTablaPermisos
			});
	});
}

function cambiarPermiso () {
	$(".cambioPermiso").change(function(){
		var rolValor = $(".table").attr("data-rol");
		var permisoId = $("#"+this.id).attr("data-id");
		var estado = permisoEstado("#"+this.id);
		permisos = permisos +","+permisoId+"."+estado;
		console.log(permisos);
		/**/
	});
}

function botonCambiarPermiso () {
	
	$("#botonCambiarPermisos").click(function(){
		if (permisos != null && permisos != "") {
		var permiso = permisos.substr(1);
		console.log(permiso);
		$.ajax({
				url: "cambiarpermisos",
				type:"POST",
				data:{
					datos: permiso
				},
				dataType: "json",
				success: cambioPermisosTerminado
			});
		 } else {
   			$(".alert").removeClass("alert-success");
			$(".alert").addClass("alert-warning");
			$(".alert").html("<strong>No a realizado cambios en ningun permiso</strong>");
			$(".alert").css({"display":"block"})
   		}
	});
}

function crearRolTerminado (data) {
	if (data.estado == 1) {
		$("#rol").attr("data-content","Registro Exitoso")
		$("#rol").popover("show");
		$("#rol").val("");
		$("#cargarTabla").html(data.html);
		eliminarRol();
	} else {
		$("#rol").attr("data-content",data.error.rol);
		$("#rol").popover("show");
	}
	$("#rol").click(function(){
		$("#rol").popover("hide");
	});
}

function asignarRolTerminado (data) {
	$(".alert").css({"display":"block"})
	if(data.estado == 1){
		$(".alert").removeClass("alert-warning");
		$(".alert").addClass("alert-success");
		$(".alert").html("<strong>Cambios realizados con exito</strong>");
		rol = "";
		roles = "";
	}
}

function eliminarRolTerminado (data) {
	$(".alert").css({"display":"block"})
	if(data.estado == 1) {
		$(".alert").removeClass("alert-success");
		$(".alert").addClass("alert-warning");
		$(".alert").html("<strong>No es posible eliminar el rol, desvincule los usuarios asignados al rol</strong>");
		$(".eliminar").removeClass("btn-default");
		$(".eliminar").addClass("btn-danger");
	} else {
		$(".alert").removeClass("alert-warning");
		$(".alert").addClass("alert-success"); 
		$(".alert").html("<strong>El rol fue eliminado con exito</strong>");
		$("#cargarTabla").html(data.html);
		eliminarRol();
		$(".eliminar").removeClass("btn-default");
		$(".eliminar").addClass("btn-danger");
	}
	
}

function eliminarRol () {
	$(".eliminar").click(function(){
		$(".alert").click(function(){
			$(".alert").css({"display":"none"})
		});	
		$(this).addClass("btn-default");
		$.ajax({
				url: "eliminarrol",
				type:"POST",
				data:{
					rol:this.name
				},
				dataType: "json",
				success: eliminarRolTerminado
			});
	});
}
$(document).ready(function(){
	roles = "";
	permisos = "";
	cambiarPermiso();
	rolesChange();
	email1.blur(function () {
		if (email1.val() != "" && email1.val() != null)	{
			$.ajax({
				url: "usuario",
				type:"POST",
				data:{email:email1.val()},
				dataType: "json",
				success: comprobacionTerminada
			});
		}
	});
	$("#crear").click(function(){
		$.ajax({
				url: "crearrol",
				type:"POST",
				data:{rol:$("#rol").val()},
				dataType: "json",
				success: crearRolTerminado
			});
	});

	/* asignar rol antes del cambio */
	$(".asignarRol").change(function(){
		roles = roles +","+this.value;
		/*$.ajax({
				url: "asignarrol",
				type:"POST",
				data:{
					rol:this.value
				},
				dataType: "json",
				success: asignarRolTerminado
			});*/
	});

	$("#botonAsignarRol").click(function(){
		rol = roles.substr(1);
		$(".alert").click(function(){
			$(".alert").css({"display":"none"})
		});
		if (rol != null && rol != "") {
			$.ajax({
				url: "asignarrol",
				type:"POST",
				data:{
					rol:rol
				},
				dataType: "json",
				success: asignarRolTerminado
			});
		} else {
			$(".alert").removeClass("alert-success");
			$(".alert").addClass("alert-warning");
			$(".alert").html("<strong>No a realizado cambios en ningun rol</strong>");
			$(".alert").css({"display":"block"})
	}});

	$(".eliminar").click(function(){
		$(".alert").click(function(){
			$(".alert").css({"display":"none"})
		});	
		$.ajax({
				url: "eliminarrol",
				type:"POST",
				data:{
					rol:this.name
				},
				dataType: "json",
				success: eliminarRolTerminado
			});
	});
	eliminarRol();
	botonCambiarPermiso();
});