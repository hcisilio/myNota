//$("#aula div").children().each(function(){

function removeFalhaValidacao(idForm){
	$(idForm+" .erro").each(function(){
		$(this).removeClass("erro");
	});	
}
function nuloOUvazio(idForm){	
	contador = 0;
	$(idForm+" .nuloOUvazio").each(function(){
		if ($(this).val() == '' || $(this).val() == 'null' ){
			$(this).addClass("erro");
			contador++;
		}
	});
	if (contador > 0){
		alert('Favor preencher corretamente o(s) campo(s) indicado(s)');
		return false;
	}
	else {
		return true;
	}
}