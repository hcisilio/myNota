$(function () {
	$("td.editavel").dblclick(function () { 
		var conteudoOriginal = $(this).text();
		$(this).addClass("celulaEmEdicao");
		$(this).html("<input type='text' size='3' value='" + conteudoOriginal + "' />");
		$(this).children().first().select();
		//$(this).children().first().focus();	
		$(this).children().first().keypress(function (e) {
			if (e.which == 13) {
				var conteudoNovo = $(this).val();
				if ( conteudoNovo != "" && conteudoNovo != conteudoOriginal && conteudoNovo <= 10 ) {				
					var objeto = $(this);
					$.ajax ({
						type:"POST",
						url:"../Controladores/controlador.php",
						data:{
							classe: "Nota",
							metodo: "alterar",
							aluno: $(this).parents('tr').children().first().text(),
							modulo: $(this).parent().attr('title'),
							valor: conteudoNovo
						},
						success:function(result){
							objeto.parent().html(conteudoNovo);
							$('body').append(result);
						}
					});
				}
				else {
					$(this).parent().html(conteudoOriginal);
				};
			}
		
		});
		$(this).children().first().blur(function(){
			$(this).parent().text(conteudoOriginal);
			$(this).parent().removeClass("celulaEmEdicao");
		});
	});
});