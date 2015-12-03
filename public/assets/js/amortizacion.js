function inline () {
	$('.pago').editable({
           url: $("#amortizacion").attr("data-url"),
           type: 'text',
           title: 'Enter username',
           params: function(params) {  //params already contain `name`, `value` and `pk`
            var data = {};
            data['id'] = params.pk;
            data['value'] = params.value;
            data['_token'] = $("#amortizacion").attr("data-token");
            data['total'] = this.id;
            data['proyecto'] = $("#amortizacion").attr("data-id");
            data['estimado'] = $("#amortizacion").attr("data-total");
            $("#barra").css({"display":"yes"});
            return data;
          },
          success: function(data) {
            $("#cargar").html(data.vista);
            $("#barra").css({"display":"none"});
            inline();
          }
        });
  $("#dob").editable({
           url: $("#amortizacion").attr("data-fecha"),
           type: 'text',
           title: '',
           params: function(params) {  //params already contain `name`, `value` and `pk`
            var data = {};
            data['id'] = params.pk;
            data['value'] = params.value;
            data['_token'] = $("#amortizacion").attr("data-token");
            $("#barra").css({"display":"yes"});
            return data;
          },
          success: function(data) {
            $("#barra").css({"display":"none"});
            if(data.estado == 1) {
              $(".bien").css({"display":"yes"});
            } else {
              $(".mal").css({"display":"yes"});
            }
          }
  });
}
$(document).ready(function(){
	inline();
});