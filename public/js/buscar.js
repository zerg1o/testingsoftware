
var url = "http://localhost/testing/public";

// document.onRead

// $('#buscador').on('submit',(function(e){
//     e.preventDefault();
//     $(this).attr('action',url+'/users/'+$('#buscador #user').val());

// }));

window.addEventListener("load", function(){
	
	
	// BUSCADOR
	$('#buscador').submit(function(e){
		$(this).attr('action',url+'/users/'+$('#buscador #user').val());
	});
	
});