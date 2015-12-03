var FormWizard = function () {
	"use strict";
    var wizardContent = $('#wizard');
    var wizardForm = $('#form');
    var numberOfSteps = $('.swMain > ul > li').length;
    var initWizard = function () {
        // function to initiate Wizard Form
        wizardContent.smartWizard({
            selected: 0,
            keyNavigation: false,
            onLeaveStep: leaveAStepCallback,
            onShowStep: onShowStep,
        });
        var numberOfSteps = 0;
        initValidator();
    };
    
     
    var initValidator = function () {
        
        $.validator.setDefaults({
            errorElement: "span", // contain the error msg in a span tag
            errorClass: 'help-block',
            ignore: ':hidden',
            rules: {
                apellidop: {
                    minlength: 3,
                    required: true
                },
                apellidom: {
                    minlength: 3,
                    required: true
                },
				
				 nombresu: {
                    minlength: 3,
                    required: true
                },

                fechanaci: { 
                    required: true
                },

                nacionalidad: {
                    required: true

                },

                paisnac: {
                    required: true
                },
				
                 estadonac: {
                    required: true
                },

                 curp: {
                    required: true
                },

                rfc: {
                    required:true
                },

                correoelec: {
                    required: true,
                    email: true
                },

                oficina:{
                    minlength: 8,
                    required: true
                },
                celular:{
                    minlength: 8,
                    required: true
                },
                casa:{
                    minlength: 8,
                    required: true
                },

                calle:{
                    minlength: 3,
                    required: true
                },

                noext:{
                    required: true
                },

                colonia:{
                    required: true
                },

                cp:{
                    required: true
                },

                delega:{
                    required: true
                },

                ciudad:{
                    required: true
                },

                estado:{
                    required: true
                },

                pais:{
                    required: true
               },

               anios:{
                    required: true
               },

               meses:{
                    required: true
               },

               nomempresa:{
                    required: true
               },

               puesto:{
                    required: true
               },

               departamento:{
                    required: true
               },

               anios_emp:{
                    required: true
               },

               meses_emp:{
                    required: true
               },

               sueldombruto:{
                    required: true
               },

               sueldomneto:{
                    required: true
               },
               numempleado:{
                    required: true
               },

                nombreref1:{
                    required: true
               },

               parentesco1:{
                    required: true
               },

               celular1:{
                    minlength: 10,
                    required: true
               },

               casa1:{
                     minlength: 8,
                    required: true
               },

               direccion1:{
                    required: true
               },

               nombreref2:{
                    required: true
               },
               parentesco2:{
                    required: true
               },
               celular2:{
                    minlength: 10,
                    required: true
                },
               
               casa2:{
                    minlength: 8,
                    required: true
               },

               direccion2:{
                    required: true
               },
               nombreref3:{
                    required: true
               },
               parentesco3:{
                    required: true
               },
               celular3:{
                    minlength: 10,
                    required: true
                },
               
               casa3:{
                    minlength: 8,
                    required: true
               },

               direccion3:{
                    required: true
               },

                password: {
                    minlength: 6,
                    required: true
                },
                password2: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                }
            },
            messages: {
                apellidop: "Debe introducir el apellido paterno",
				nombresu: "Debe introducir sus nombres",
                fechanaci: "Debe introducir su fecha de nacimiento",
                nacionalidad: "Debe introducir su nacionalidad",
                paisnac:"Debe introducir su país de nacimiento",
                estadonac:"Debe introducir el estado donde nacio",
                curp:"Debe introducir el curp",
                rfc:"Debe introducir el rfc",
                correoelec:"Debe introducir su correo electrónico",
                oficina:"Debe introducir el número de teléfono (8 digitos)",
                celular:"Debe introducir el número de teléfono (10 digitos)",
                casa:"Debe introducir el número de teléfono (8 digitos)",
                calle:"Debe introducir el nombre de la calle",
                noext:"Debe introducir el No. Ext",
                colonia:"Debe introducir la colonia",
                cp:"Debe introducir el C.P (5 digitos)",
                delega:"Debe introducir la delegación o municipio",
                ciudad:"Debe introducir la ciudad",
                estado:"Debe introducir el estado",
                pais:"Debe introducir el país",
                anios:"Debe introducir la cantidad de años",
                meses:"Debe introducir la cantidad de meses",
                nomempresa:"Debe introducir nombre de la empresa",
                puesto:"Debe introducir el puesto",
                departamento:"Debe introducir el departamento",
                anios_emp:"Debe introducir la cantidad de años",
                meses_emp:"Debe introducir la cantidad de meses",
                sueldombruto:"Debe introducir su sueldo mensual bruto",
                sueldomneto:"Debe introducir su sueldo mensual neto",
                numempleado:"Debe introducir su No. de empleado",
                calle_emp:"Debe introducir la calle",
                noext_emp:"Debe introducir el No. Ext",
                colonia_emp:"Debe introducir la colonia",
                cp_emp:"Debe introducir el C.P (5 digitos)",
                delegacionmunip:"Debe introducir la delegación o municipio",
                ciudad_emp:"Debe introducir la ciudad",
                estado_emp:"Debe introducir el estado",
                pais_emp:"Debe introducir el país",
                telefono_emp:"Debe introducir el teléfono",
                extension_emp:"Debe introducir la extensión",
                nombreref1:"Debe introducir el nombre",
                parentesco1:"Debe introducir la relación o parentesco",
                celular1:"Debe introducir el número de celular",
                casa1:"Debe introducir el número de casa",
                direccion1:"Debe introducir la dirección",
                nombreref2:"Debe introducir el nombre",
                parentesco2:"Debe introducir la relación o parentesco",
                celular2:"Debe introducir el número de celular",
                casa2:"Debe introducir el número de casa",
                direccion2:"Debe introducir la dirección",
                nombreref3:"Debe introducir el nombre",
                parentesco3:"Debe introducir la relación o parentesco",
                celular3:"Debe introducir el número de celular",
                casa3:"Debe introducir el número de casa",
                direccion3:"Debe introducir la dirección",
                apellidom: "Debe introducir el apellido materno"
            },
            highlight: function (element) {
                $(element).closest('.help-block').removeClass('valid');
                // display OK icon
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
                // add the Bootstrap error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error');
                // set error class to the control group
            },
            success: function (label, element) {
                label.addClass('help-block valid');
                // mark the current input as valid and display OK icon
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
            }
        });
    };
    var displayConfirm = function () {
        $('.display-value', form).each(function () {
            var input = $('[name="' + $(this).attr("data-display") + '"]', form);
            if (input.attr("type") == "text" || input.attr("type") == "email" || input.is("textarea")) {
                $(this).html(input.val());
            } else if (input.is("select")) {
                $(this).html(input.find('option:selected').text());
            } else if (input.is(":radio") || input.is(":checkbox")) {

                $(this).html(input.filter(":checked").closest('label').text());
            } else if ($(this).attr("data-display") == 'card_expiry') {
                $(this).html($('[name="card_expiry_mm"]', form).val() + '/' + $('[name="card_expiry_yyyy"]', form).val());
            }
        });
    };
    var onShowStep = function (obj, context) {
    	if(context.toStep == numberOfSteps){
    		$('.anchor').children("li:nth-child(" + context.toStep + ")").children("a").removeClass('wait');
            displayConfirm();
    	}
        $(".next-step").unbind("click").click(function (e) {
            e.preventDefault();
            wizardContent.smartWizard("goForward");
        });
        $(".back-step").unbind("click").click(function (e) {
            e.preventDefault();
            wizardContent.smartWizard("goBackward");
        });
        $(".go-first").unbind("click").click(function (e) {
            e.preventDefault();
            wizardContent.smartWizard("goToStep", 1);
        });
        $(".finish-step").unbind("click").click(function (e) {
            e.preventDefault();
            onFinish(obj, context);
        });
    };
    var leaveAStepCallback = function (obj, context) {
        return validateSteps(context.fromStep, context.toStep);
        // return false to stay on step and true to continue navigation
    };
    var onFinish = function (obj, context) {
        if (validateAllSteps()) {
            alert('form submit function');
            $('.anchor').children("li").last().children("a").removeClass('wait').removeClass('selected').addClass('done').children('.stepNumber').addClass('animated tada');
            //wizardForm.submit();
        }
    };
    var validateSteps = function (stepnumber, nextstep) {
        var isStepValid = false;
        
        
        if (numberOfSteps >= nextstep && nextstep > stepnumber) {
        	
            // cache the form element selector
            if (wizardForm.valid()) { // validate the form
                wizardForm.validate().focusInvalid();
                for (var i=stepnumber; i<=nextstep; i++){
        		$('.anchor').children("li:nth-child(" + i + ")").not("li:nth-child(" + nextstep + ")").children("a").removeClass('wait').addClass('done').children('.stepNumber').addClass('animated tada');
        		}
                //focus the invalid fields
                isStepValid = true;
                return true;
            };
        } else if (nextstep < stepnumber) {
        	for (i=nextstep; i<=stepnumber; i++){
        		$('.anchor').children("li:nth-child(" + i + ")").children("a").addClass('wait').children('.stepNumber').removeClass('animated tada');
        	}
            
            return true;
        } 
    };
    var validateAllSteps = function () {
        var isStepValid = true;
        // all step validation logic
        return isStepValid;
    };
    return {
        init: function () {
            initWizard();
        }
    };
}();