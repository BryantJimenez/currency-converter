$(document).ready(function(){
	// Login
	$("button[action='login']").on("click",function(){
		$("#formLogin").validate({
			rules:
			{
				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				}
			},
			submitHandler: function(form) {
				$("button[action='login']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Recovery Password
	$("button[action='recovery']").on("click",function(){
		$("#formRecovery").validate({
			rules:
			{
				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191
				}
			},
			submitHandler: function(form) {
				$("button[action='recovery']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Reset Password
	$("button[action='reset']").on("click",function(){
		$("#formReset").validate({
			rules:
			{
				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			submitHandler: function(form) {
				$("button[action='reset']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Profile
	$("button[action='profile']").on("click",function(){
		$("#formProfile").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				phone: {
					required: true,
					minlength: 5,
					maxlength: 15
				},

				password: {
					required: false,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			submitHandler: function(form) {
				$("button[action='profile']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Users
	$("button[action='user']").on("click",function(){
		$("#formUser").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191,
					remote: {
						url: "/usuarios/email",
						type: "get"
					}
				},

				phone: {
					required: true,
					minlength: 5,
					maxlength: 15
				},

				type: {
					required: true
				},

				state: {
					required: true
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				email: {
					remote: "Este correo ya esta en uso."
				},

				type: {
					required: 'Seleccione una opción.'
				}
			},
			submitHandler: function(form) {
				$("button[action='user']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Customers
	$("button[action='customer']").on("click",function(){
		if ($("#formCustomer").length) {
			$("#formCustomer").validate().destroy();
		}
		var slug='';
		if ($("button[action='customer'][slug]").length) {
			slug=$(this).attr('slug');
		}
		$("#formCustomer").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				dni: {
					required: true,
					minlength: 1,
					maxlength: 20
				},

				email: {
					required: false,
					email: true,
					minlength: 5,
					maxlength: 191,
					remote: {
						url: "/usuarios/email/"+slug,
						type: "get"
					}
				},

				phone: {
					required: true,
					minlength: 5,
					maxlength: 15
				},

				address: {
					required: true,
					minlength: 5,
					maxlength: 191
				},

				country_id: {
					required: true
				},

				account_question: {
					required: true
				},

				bank: {
					required: function(element) {
						return ($("select[name='account_question']").val()=='1');
					},
					minlength: 2,
					maxlength: 191
				},

				number: {
					required: function(element) {
						return ($("select[name='account_question']").val()=='1');
					},
					minlength: 2,
					maxlength: 191
				}
			},
			messages:
			{
				email: {
					remote: "Este correo ya esta en uso."
				},

				country_id: {
					required: 'Seleccione una opción.'
				},

				account_question: {
					required: 'Seleccione una opción.'
				}
			},
			submitHandler: function(form) {
				$("button[action='customer']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Customers Contact
	$("button[action='customer']").on("click",function(){
		$("#formContactCustomer").validate({
			rules:
			{
				customer_id: {
					required: true
				},

				user_alias: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				destination_alias: {
					required: true,
					minlength: 2,
					maxlength: 191
				}
			},
			messages:
			{
				customer_id: {
					required: 'Seleccione una opción.'
				}
			},
			errorPlacement: function(error, element) {
				if (element.hasClass('custom-error')) {
					error.appendTo('.custom-error-'+$(element).attr('name'));
				} else {
					error.insertAfter(element);
				}
			},
			submitHandler: function(form) {
				$("button[action='customer']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Customers Account
	$("button[action='customer']").on("click",function(){
		$("#formAccountCustomer").validate({
			rules:
			{
				bank: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				number: {
					required: true,
					minlength: 2,
					maxlength: 191
				}
			},
			submitHandler: function(form) {
				$("button[action='customer']").attr('disabled', true);
				form.submit();
			}
		});

		$("#formAccountCustomerEdit").validate({
			rules:
			{
				bank: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				number: {
					required: true,
					minlength: 2,
					maxlength: 191
				}
			},
			submitHandler: function(form) {
				$("button[action='customer']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Quotes
	$("button[action='quote']").on("click",function(){
		$("#formQuote").validate({
			rules:
			{
				customer_source_id: {
					required: true
				},

				customer_destination_id: {
					required: true
				},

				currency_source_id: {
					required: true
				},

				currency_destination_id: {
					required: true
				},

				reason: {
					required: true,
					minlength: 2,
					maxlength: 1000
				},

				type_operation: {
					required: true
				},

				amount: {
					required: true,
					number: true,
					min: 0
				}
			},
			messages:
			{
				customer_source_id: {
					required: 'Seleccione una opción.'
				},

				customer_destination_id: {
					required: 'Seleccione una opción.'
				},

				currency_source_id: {
					required: 'Seleccione una opción.'
				},

				currency_destination_id: {
					required: 'Seleccione una opción.'
				},

				type_operation: {
					required: 'Seleccione una opción.'
				}
			},
			errorPlacement: function(error, element) {
				if (element.hasClass('custom-error')) {
					error.appendTo('.custom-error-'+$(element).attr('name'));
				} else {
					error.insertAfter(element);
				}
			},
			submitHandler: function(form) {
				$("button[action='quote']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Currencies
	$("button[action='currency']").on("click",function(){
		$("#formCurrency").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				iso: {
					required: true,
					minlength: 3,
					maxlength: 3
				},

				symbol: {
					required: true,
					minlength: 1,
					maxlength: 3
				},

				side: {
					required: true
				}
			},
			messages:
			{
				side: {
					required: 'Seleccione una opción.'
				}
			},
			submitHandler: function(form) {
				$("button[action='currency']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Currencies Exchange
	$("button[action='currency']").on("click",function(){
		$("#formCurrencyExchange").validate({
			rules:
			{
				'conversion_rate[]': {
					required: true,
					number: true,
					min: 0
				}
			},
			errorPlacement: function(error, element) {
				if (element.hasClass('custom-error')) {
					error.appendTo('.custom-error-'+$(element).attr('id'));
				} else {
					error.insertAfter(element);
				}
			},
			submitHandler: function(form) {
				$("button[action='currency']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Settings
	$("button[action='setting']").on("click",function(){
		$("#formSetting").validate({
			rules:
			{
				fixed_commission: {
					required: true,
					number: true,
					min: 0
				},

				percentage_commission: {
					required: true,
					number: true,
					min: 0,
					max: 100
				},

				iva: {
					required: true,
					number: true,
					min: 0,
					max: 100
				}
			},
			errorPlacement: function(error, element) {
				if (element.hasClass('custom-error')) {
					error.appendTo('.custom-error-'+$(element).attr('name'));
				} else {
					error.insertAfter(element);
				}
			},
			submitHandler: function(form) {
				$("button[action='setting']").attr('disabled', true);
				form.submit();
			}
		});
	});
});