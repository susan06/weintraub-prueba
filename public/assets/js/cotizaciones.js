var total,cantidad,sub,precio,iva;
function subTotal () {
	cantidad = $('#cantidad').val() || 0;
  	precio = $("#precio").val() || 0;
  	sub = cantidad*precio;
  	iva = sub*0.16;
  	total = sub + iva;
  	$("#subtotal").val(sub);
  	$("#subtotal_e").val(sub);
  	$("#iva").val(iva);
  	$("#iva_e").val(iva);
  	$("#total").val(total);
  	$("#total_e").val(total);
}
$(document).ready(function(){
  $('#cantidad').keyup(function(){
  		subTotal();
  });
  $('#precio').keyup(function(){
  		subTotal();
  });
});