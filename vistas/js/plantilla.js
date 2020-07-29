/*=============================================
SideBar Menu
=============================================*/

$('.sidebar-menu').tree()

/*=============================================
                Data Table
=============================================*/
$(".tablas").DataTable({

    "language": {

		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}

	}
});
//----------------------------------------------------------------------------------------------------------------------------------
/*=============================================
 //iCheck for checkbox and radio inputs
=============================================*/

$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
	checkboxClass: 'icheckbox_minimal-blue',
	radioClass   : 'iradio_minimal-blue'
})
//----------------------------------------------------------------------------------------------------------------------------------
/*=============================================
 //input Mask
=============================================*/

//Datemask dd/mm/yyyy
$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
//Money Euro
$('[data-mask]').inputmask()


/*LOGIN PREVENIR RECARGAR */
$(".verificarCorreo").on("click", function (event) {
	event.preventDefault();
});
$(".verificarPreguntas").on("click", function (event) {
	event.preventDefault();
});
//--------------------------------------------
//Switch

const btnSwitch = document.querySelector('#switch');

btnSwitch.addEventListener('click', () => {

	if(document.body.classList.contains('skin-black')){
		document.body.classList.toggle('skin-white');
		document.body.classList.remove('skin-black');

	} else {
		document.body.classList.toggle('skin-black');
		document.body.classList.remove('skin-white');
	}
	
    btnSwitch.classList.toggle('active');

    //Guardamos el modo en LocalStorage
    if(document.body.classList.contains('skin-white')){
        localStorage.setItem('skin-white-mode', 'true');
    } else {
        localStorage.setItem('skin-white-mode', 'false');
    }
});

//Obtenemos el modo actual
if(localStorage.getItem('skin-white-mode') === 'true'){


    document.body.classList.remove('skin-black');
    document.body.classList.add('skin-white');
    btnSwitch.classList.add('active');

} else {
	document.body.classList.remove('skin-white');
    document.body.classList.add('skin-black');
    btnSwitch.classList.remove('active');

}