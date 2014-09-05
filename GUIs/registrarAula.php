<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Registrar Aula</title>
<link rel="stylesheet" type="text/css" href="CSS/mynota.css">
<script type="text/javascript" src="../Ajax/jQuery.js"></script>
<script type="text/javascript">
	function listaAulas(turma) {				
	    $.ajax({			        
			type: "POST",
			//url: "../Controladores/controlador.php",
			//data: "acao=controlador&classe=Aluno&metodo=listarPorTurma&turma=" + turma,
			url: "constroiAulasTurma.php",
			data: { turma: turma },
			
			beforeSend: function() {
				// enquanto a função esta sendo processada, você
				// pode exibir na tela uma
				// msg de carregando						
				$( '#tabela' ).html('Carregando');
			},
			success: function(txt) {
				// pego o id da div que envolve o select com
				// name="id_modelo" e a substituiu
				// com o texto enviado pelo php, que é um novo
				//select com dados da marca x
				//$('#ajax_alunos').html(txt);				
				$( '#tabela' ).html(txt);						
			},
			error: function(txt) {				
				$( '#tabela' ).html('fudeu');
			}
	    });
	}

	function insereAula(classe, metodo) {
		var turma = document.getElementById("turma").options[document.getElementById("turma").selectedIndex].value;
		var conteudo = document.getElementById("conteudo").value;		
		/* Ajax para inserir a aula dada no banco de dados */
		$.ajax({			        
			type: "POST",
			url: "../Controladores/controlador.php",
			data: { 
				turma: turma,
				conteudo: conteudo,
				classe: classe,
				metodo: metodo 
			},
			
			beforeSend: function() {						
				
			},
			success: function(txt) {						
				listaAulas(turma);
				document.getElementById("conteudo").value = null;				
			},
			error: function(txt) {				
				
			}
	    });
		
	}

	function doPost(formName) {
		resposta = confirm("Tem certeza que deseja concluir o curso desta turma?");
		if (resposta) {
	    	var theForm = document.getElementById(formName);
			theForm.submit();
		}
	}
</script>
</head>

<body>

	<div id="principal">

		<div id="topo">
			Topo da página
		</div>
		
		<div id="barra">
			<ul>
				<li> <a href="JavaScript:doPost('aula')"> <img src="Imagens/ok.png"> </a></li>
				<li> <a href="JavaScript:insereAula('Aula','inserir')"> <img src="Imagens/save.png"> </a></li>  				       
			</ul>
		</div>
		
		<div id="menu">
			<?php include("mainMenu.php"); ?>
		</div>

		<div id="formulario">
			<form name ="aula" id="aula" action="../Controladores/controlador.php" method="get">
				<input type="hidden" name="classe" value="Turma">
				<input type="hidden" name="metodo" value="encerrar">
				<label>Turma </label><BR />
				<select name="turma" class="edits" id="turma" onChange="listaAulas(this.value);">
					<option value='null'> Selecione uma turma </option>
					<?php
						include_once("../Controladores/controladorTurma.php");
						$persistir = new ControladorTurma();
						$professor = $_SESSION["professor"];
						$lista = $persistir->listarMinhas($professor);
						for ($i = 0; $i < count($persistir->listarMinhas($professor)); $i++) {
							$id = $lista[$i]->getId();
							echo "<option value=$id> $id </option>";
						} 		
					?> 
				</select> <br>								
				<label> Conteúdo </label> <br>				
				<textarea rows="5" cols="70" name="conteudo" id="conteudo" class="edits"></textarea>							
			</form>			
			
			<table id="tabela" class="tabela"> </table>			
		</div>						
		<div class="clear"> </div>
		
		<div id="rodape">
			<p>I CS - Cisilio's Sistemas &copy;2014 - Todos os direitos reservados I <a href="#"></a> </p>
		</div>	
		
	</div>

</body>