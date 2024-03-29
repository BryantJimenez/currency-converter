/*
=========================================
|                                       |
|           Scroll To Top               |
|                                       |
=========================================
*/ 
$('.scrollTop').click(function() {
  $("html, body").animate({scrollTop: 0});
});


$('.navbar .dropdown.notification-dropdown > .dropdown-menu, .navbar .dropdown.message-dropdown > .dropdown-menu ').click(function(e) {
  e.stopPropagation();
});

/*
=========================================
|                                       |
|       Multi-Check checkbox            |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {

  var checker = $('#' + clickchk);
  var multichk = $('.' + relChkbox);


  checker.click(function () {
    multichk.prop('checked', $(this).prop('checked'));
  });    
}


/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

/*
    This MultiCheck Function is recommanded for datatable
*/

function multiCheck(tb_var) {
  tb_var.on("change", ".chk-parent", function() {
    var e=$(this).closest("table").find("td:first-child .child-chk"), a=$(this).is(":checked");
    $(e).each(function() {
      a?($(this).prop("checked", !0), $(this).closest("tr").addClass("active")): ($(this).prop("checked", !1), $(this).closest("tr").removeClass("active"))
    })
  }),
  tb_var.on("change", "tbody tr .new-control", function() {
    $(this).parents("tr").toggleClass("active")
  })
}

/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {

  var checker = $('#' + clickchk);
  var multichk = $('.' + relChkbox);


  checker.click(function () {
      multichk.prop('checked', $(this).prop('checked'));
  });    
}

/*
=========================================
|                                       |
|               Tooltips                |
|                                       |
=========================================
*/

$('.bs-tooltip').tooltip();

/*
=========================================
|                                       |
|               Popovers                |
|                                       |
=========================================
*/

$('.bs-popover').popover();


/*
================================================
|                                              |
|               Rounded Tooltip                |
|                                              |
================================================
*/

$('.t-dot').tooltip({
  template: '<div class="tooltip status rounded-tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
})


/*
================================================
|            IE VERSION Dector                 |
================================================
*/

function GetIEVersion() {
  var sAgent = window.navigator.userAgent;
  var Idx = sAgent.indexOf("MSIE");

  // If IE, return version number.
  if (Idx > 0) 
    return parseInt(sAgent.substring(Idx+ 5, sAgent.indexOf(".", Idx)));

  // If IE 11 then look for Updated user agent string.
  else if (!!navigator.userAgent.match(/Trident\/7\./)) 
    return 11;

  else
    return 0; //It is not IE
}

//////// Scripts ////////
function errorNotification() {
  Lobibox.notify('error', {
    title: 'Error',
    sound: true,
    msg: 'Ha ocurrido un problema, inténtelo de nuevo.'
  });
}

$(document).ready(function() {
  //Validación para introducir solo números
  $('.number, #phone').keypress(function() {
    return event.charCode >= 48 && event.charCode <= 57;
  });
  //Validación para introducir solo letras y espacios
  $('#name, #lastname, .only-letters').keypress(function() {
    return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode==32;
  });
  //Validación para solo presionar enter y borrar
  $('.date').keypress(function() {
    return event.charCode == 32 || event.charCode == 127;
  });

  //select2
  if ($('.select2').length) {
    $('.select2').select2({
      language: "es",
      placeholder: "Seleccione",
      tags: true
    });
  }

  //Datatables normal
  if ($('.table-normal').length) {
    $('.table-normal').DataTable({
      "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>><'table-responsive'tr><'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
      "oLanguage": {
        "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
        "sInfo": "Resultados del _START_ al _END_ de un total de _TOTAL_ registros",
        "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
        "sSearchPlaceholder": "Buscar...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sProcessing":     "Procesando...",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún resultado disponible en esta tabla",
        "sInfoEmpty":      "No hay resultados",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
      },
      "stripeClasses": [],
      "lengthMenu": [10, 20, 50, 100, 200, 500],
      "pageLength": 10
    });
  }

  if ($('.table-export').length) {
    $('.table-export').DataTable({
      dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
      buttons: {
        buttons: [
        { extend: 'copy', className: 'btn' },
        { extend: 'csv', className: 'btn' },
        { extend: 'excel', className: 'btn' },
        { extend: 'print', className: 'btn' }
        ]
      },
      "oLanguage": {
        "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
        "sInfo": "Resultados del _START_ al _END_ de un total de _TOTAL_ registros",
        "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
        "sSearchPlaceholder": "Buscar...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sProcessing":     "Procesando...",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún resultado disponible en esta tabla",
        "sInfoEmpty":      "No hay resultados",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        "buttons": {
          "copy": "Copiar",
          "print": "Imprimir"
        }
      },
      "stripeClasses": [],
      "lengthMenu": [10, 20, 50, 100, 200, 500],
      "pageLength": 10
    });
  }

  //dropify para input file más personalizado
  if ($('.dropify').length) {
    $('.dropify').dropify({
      messages: {
        default: 'Arrastre y suelte una imagen o da click para seleccionarla',
        replace: 'Arrastre y suelte una imagen o haga click para reemplazar',
        remove: 'Remover',
        error: 'Lo sentimos, el archivo es demasiado grande'
      },
      error: {
        'fileSize': 'El tamaño del archivo es demasiado grande ({{ value }} máximo).',
        'minWidth': 'El ancho de la imagen es demasiado pequeño ({{ value }}}px mínimo).',
        'maxWidth': 'El ancho de la imagen es demasiado grande ({{ value }}}px máximo).',
        'minHeight': 'La altura de la imagen es demasiado pequeña ({{ value }}}px mínimo).',
        'maxHeight': 'La altura de la imagen es demasiado grande ({{ value }}px máximo).',
        'imageFormat': 'El formato de imagen no está permitido (Debe ser {{ value }}).'
      }
    });
  }

  //datepicker material
  if ($('.dateMaterial').length) {
    $('.dateMaterial').bootstrapMaterialDatePicker({
      lang : 'es',
      time: false,
      cancelText: 'Cancelar',
      clearText: 'Limpiar',
      format: 'DD-MM-YYYY',
      maxDate : new Date()
    });
  }

  // flatpickr
  if ($('#flatpickr').length) {
    flatpickr(document.getElementById('flatpickr'), {
      locale: 'es',
      enableTime: false,
      dateFormat: "d-m-Y",
      maxDate : "today"
    });
  }

  if ($('#startDateSearchFlatpickr').length && $('#endDateSearchFlatpickr').length) {
    var startFlatpickr=flatpickr(document.getElementById('startDateSearchFlatpickr'), {
      locale: 'es',
      enableTime: false,
      dateFormat: "d-m-Y",
      time_24hr: false,
      onChange: function(selectedDates, dateStr, instance) {
        endFlatpickr.set("minDate", $("#startDateSearchFlatpickr").val());
      }
    });

    var endFlatpickr=flatpickr(document.getElementById('endDateSearchFlatpickr'), {
      locale: 'es',
      enableTime: false,
      dateFormat: "d-m-Y",
      time_24hr: false,
      onChange: function(selectedDates, dateStr, instance) {
        startFlatpickr.set("maxDate", $("#endDateSearchFlatpickr").val());
      }
    });
  }

  // Touchspin
  if ($('.decimal').length) {
    $(".decimal").TouchSpin({
      min: 0,
      max: 999999999,
      step: 0.50,
      decimals: 2,
      buttondown_class: 'btn btn-primary rounded-0 h-100 mr-0',
      buttonup_class: 'btn btn-primary rounded-0 h-100 mr-0'
    });
  }

  if ($('.min-decimal').length) {
    $(".min-decimal").TouchSpin({
      min: 0,
      max: 999999999,
      step: 0.01,
      decimals: 2,
      buttondown_class: 'btn btn-primary rounded-0 h-100 mr-0',
      buttonup_class: 'btn btn-primary rounded-0 h-100 mr-0'
    });
  }

  if ($('.conversion-rate-min-decimal').length) {
    $(".conversion-rate-min-decimal").TouchSpin({
      min: 0,
      max: 999999999,
      step: 0.000001,
      decimals: 6,
      buttondown_class: 'btn btn-primary rounded-0 h-100 mr-0',
      buttonup_class: 'btn btn-primary rounded-0 h-100 mr-0'
    });
  }

  if ($('.percentage-decimal').length) {
    $(".percentage-decimal").TouchSpin({
      min: 0,
      max: 100,
      step: 0.01,
      decimals: 2,
      buttondown_class: 'btn btn-primary rounded-0 h-100 mr-0',
      buttonup_class: 'btn btn-primary rounded-0 h-100 mr-0'
    });
  }
});

// funcion para cambiar el input hidden al cambiar el switch de estado
$('#stateCheckbox').change(function(event) {
  if ($(this).is(':checked')) {
    $('#stateHidden').val(1);
  } else {
    $('#stateHidden').val(0);
  }
});

// Funciones para desactivar y activar
function deactiveUser(slug) {
  $("#deactiveUser").modal();
  $('#formDeactiveUser').attr('action', '/admin/usuarios/' + slug + '/desactivar');
}

function activeUser(slug) {
  $("#activeUser").modal();
  $('#formActiveUser').attr('action', '/admin/usuarios/' + slug + '/activar');
}

function deactiveCustomer(slug) {
  $("#deactiveCustomer").modal();
  $('#formDeactiveCustomer').attr('action', '/admin/clientes/' + slug + '/desactivar');
}

function activeCustomer(slug) {
  $("#activeCustomer").modal();
  $('#formActiveCustomer').attr('action', '/admin/clientes/' + slug + '/activar');
}

function deactiveCurrency(slug) {
  $("#deactiveCurrency").modal();
  $('#formDeactiveCurrency').attr('action', '/admin/monedas/' + slug + '/desactivar');
}

function activeCurrency(slug) {
  $("#activeCurrency").modal();
  $('#formActiveCurrency').attr('action', '/admin/monedas/' + slug + '/activar');
}

// Funciones para preguntar al eliminar
function deleteUser(slug) {
  $("#deleteUser").modal();
  $('#formDeleteUser').attr('action', '/admin/usuarios/' + slug);
}

function deleteCustomer(slug) {
  $("#deleteCustomer").modal();
  $('#formDeleteCustomer').attr('action', '/admin/clientes/' + slug);
}

function deleteQuote(id) {
  $("#deleteQuote").modal();
  $('#formDeleteQuote').attr('action', '/admin/cotizaciones/' + id);
}

function deleteCurrency(slug) {
  $("#deleteCurrency").modal();
  $('#formDeleteCurrency').attr('action', '/admin/monedas/' + slug);
}

function deleteRole(id) {
  $("#deleteRole").modal();
  $('#formDeleteRole').attr('action', '/admin/roles/' + id);
}

// Funciones para preguntar
function contactCustomer(slug, name) {
  $("#contactCustomer input[name='name']").val(name);
  $("#contactCustomer").modal();
  $('#formContactCustomer').attr('action', '/admin/clientes/' + slug + '/contactos');
}

function accountCustomer(slug, name) {
  $("#accountCustomer input[name='name']").val(name);
  $("#accountCustomer").modal();
  $('#formAccountCustomer').attr('action', '/admin/clientes/' + slug + '/cuentas');
}

function accountCustomerEdit(slug_user, slug_account, name, bank, number) {
  $("#accountCustomerEdit input[name='name']").val(name);
  $("#accountCustomerEdit input[name='bank']").val(bank);
  $("#accountCustomerEdit input[name='number']").val(number);
  $("#accountCustomerEdit").modal();
  $('#formAccountCustomerEdit').attr('action', '/admin/clientes/' + slug_user + '/cuentas/' + slug_account);
}

// Function for toggle custom permissions
function toggleCustomPermissions() {
  if ($('#customPermissions').hasClass('d-none')) {
    $('input[name="custom_permissions"]').val('1');
    $('#customPermissions').removeClass('d-none');
  } else {
    $('#customPermissions').addClass('d-none');
    $('input[name="custom_permissions"]').val('0');
  }
}

// funcion para mostrar/ocultar campos al cambiar la opción
$('select[name="account_question"]').change(function(event) {
  if ($(this).val()=='1') {
    $('.account-data input').attr('disabled', false);
    $('.account-data').removeClass('d-none');
  } else {
    $('.account-data').addClass('d-none');
    $('.account-data input').attr('disabled', true);
  }
});

// Function for add accounts in select
$('select[name="customer_destination_id"]').change(function() {
  var customer_destination_id=$('select[name="customer_destination_id"]').val();
  $('select[name="account_destination_id"] option').remove();
  $('select[name="account_destination_id"]').append($('<option>', {
    value: '',
    text: 'Seleccione'
  }));
  if (customer_destination_id!="") {
    $.ajax({
      url: '/admin/clientes/cuentas/obtener',
      type: 'GET',
      dataType: 'json',
      data: {customer_id: customer_destination_id}
    })
    .done(function(obj) {
      if (obj.status) {
        $('select[name="account_destination_id"] option[value!=""]').remove();
        for (var i=obj.data.length-1; i>=0; i--) {
          $('select[name="account_destination_id"]').append($('<option>', {
            value: obj.data[i].slug,
            text: obj.data[i].bank+' ('+obj.data[i].number+')'
          }));
        }
      } else {
        errorNotification();
      }
    })
    .fail(function() {
      errorNotification();
    });
  }
});

// Funcion para calcular la cotización con Livewire
function calculateCuote() {
  var currencySource='', currencyDestination='', type='', amount=0.00;
  if ($('select[name="currency_source_id"]').val()!='') {
    currencySource=$('select[name="currency_source_id"]').val();
  }
  if ($('select[name="currency_destination_id"]').val()!='') {
    currencyDestination=$('select[name="currency_destination_id"]').val();
  }
  if ($('select[name="type_operation"]').val()!='') {
    type=$('select[name="type_operation"]').val();
  }
  if ($('input[name="amount"]').val()!='') {
    amount=$('input[name="amount"]').val();
  }
  var data={"currency_source": currencySource, "currency_destination": currencyDestination, "type": type, "amount": amount};
  Livewire.emit('calculateCuote', data);
}