	var num = 0; 
	evento = function (evt) {
	return (!evt) ? event : evt;
}

addStreet = function () { 
	
	var street = document.getElementById("street_field").value;
	
	if($("#street_field").valid() && isNaN(street)) {
	
		document.getElementById("table2").style.display='inline';
		
		
		var input  	= document.createElement("input");
		var tr  	= document.createElement("TR");
		var td  	= document.createElement("TD");
		var t 		= document.createTextNode(street);
		
		
		input.type	= 'hidden';
		input.name	= 'streets[]';
		input.value	= (street);
		input.id 	= 'street' + (++num);
		
		
		td.style.fontWeight = "600";
		td.name		= 'names[]';
		
		tr.className= 'text-info';
		tr.id 		= input.id;
		
		a 			= document.createElement('i');
		a.name		= tr.id;
		a.style.float	= 'right';
		a.style.cursor	= 'pointer';
		a.className		= 'icon fa fa-trash-o';
		a.onclick		= deleteStreet;
		
		tr.appendChild(td);
		td.appendChild(t);
		td.appendChild(a);


	   container = document.getElementById('streets');
	   container.appendChild(tr);
	   container.appendChild(input);
	   
		
	}else{
		if($('#steps-wizard').length) {
            $('#steps-wizard').validate({
				// Rules for form validation
				rules: {
					location: {
						required: true
					}
				},

				// Messages for form validation
				messages: {
					location: {
						required: 'Por favor, introduzca el nombre de las calles de la colonia.',
						
					}
				},

				errorPlacement: function (error, element) {
				error.insertAfter(element.parent());
				}
			});
		}
	}

}
deleteStreet= function (evt){
   evt = evento(evt);
   
   td = rObj(evt);
   td_field = document.getElementById(td.name);
   td_field.parentNode.removeChild(td_field); 
   
   input = rObj(evt);
   input_field = document.getElementById(input.name);
   input_field.parentNode.removeChild(input_field); 
   
}

addMail = function () { 
	var emails 		= document.getElementById("email_field").value;
	var emailArray	= emails.split("\n",10);

	var mail 		= "";

	emailArray.forEach( function (mail)
	{
		if(isNaN(mail)) {
			
			document.getElementById("mail_area").style.display='block';
			
			var input  	= document.createElement("input");
			var button  = document.createElement("BUTTON");
			var t 		= document.createTextNode(mail);
			
			input.type	= 'hidden';
			input.name	= 'mails[]';
			input.value	= (mail); 
			input.id 	= 'mail' + (++num);
			
			button.name		= 'invitation[]';
			button.className= 'btn btn-warning btn-xs';
			button.type		= 'button';
			button.style.paddingRight="25px";
			button.id 		= input.id;
			
			i 				= document.createElement('i');
			i.name			= button.id;
			i.style.cursor		= 'pointer';
			i.style.marginLeft	= '-3%';
			i.style.marginRight	= '1.5%';
			i.style.marginBottom= '2%';
			i.style.color	= '#FFFFFF';
			i.className		= 'fa fa-times-circle';
			i.onclick		= deleteMail;
			i.id			= button.id;
			
			
		
			button.appendChild(t);
			
			container = document.getElementById("mail_area");
			container.appendChild(button);
			container.appendChild(i);
			container.appendChild(input);
		   
		   
			
		}else{ 
		
			//$("#steps-wizard").validate().settings.ignore = ":disabled,:hidden";
			//return $("#steps-wizard").valid();
			
			if($('#steps-wizard').length) {
				$('#steps-wizard').validate({
					// Rules for form validation
					rules: {
						email: {
							required: true,
							email: true
						}
					},

					// Messages for form validation
					messages: {
						email: {
							required: 'Por favor, Ingrese al menos un E-mail de un vecino.',
							email	: 'Por favor, ingrese una dirección VÁLIDA de email.'
						}
					},

					errorPlacement: function (error, element) {
					error.insertAfter(element.parent());
					
					}
					
					
							
				});
				
			}
			
			
		}

	});
}

deleteMail = function (evt){
   evt = evento(evt);

   button = rObj(evt);
   button_new	= document.getElementById(button.name);
   button_new.parentNode.removeChild(button_new); 
   
   input = rObj(evt);
   input_field = document.getElementById(input.name);
   input_field.parentNode.removeChild(input_field); 
   
   i = rObj(evt);
   i_new= document.getElementById(i.id);
   i_new.parentNode.removeChild(i_new);
   
   
}
	
rObj = function (evt) { 
   return evt.srcElement ?  evt.srcElement : evt.target;
}


