<?php
	session_start("mynota");
	//$permissao=$_SESSION["permissao"];
	// SQLs
	/*
	select * from alunos where id in (select aluno from aluno_turma where turma = "Familia")
	select * from modulos where id in ( select modulo from curso_modulo where curso in ( select curso from turmas where id = "Familia " ))
	select * from notas where aluno in ( select aluno from aluno_turma where turma in ( select turma from turmas where id = "Familia" ))
	*/
	
?>
<html>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
	<link rel="stylesheet" media="screen" type="text/css" title="style" href="CSS/mynota.css" />	
	<title>Lançar notas</title>
	<script type="text/javascript" src="../Ajax/jQuery.js"></script>
	<!--  <script type="text/javascript" src="../Ajax/tabelaEditavel.js"></script> -->
	<script type="text/javascript">
	function listaAlunos(turma) {		
	    $.ajax({	    
			type: "GET",
			url: "constroiNotasTurma.php",
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
	</script>
</head>

<body>

	<div id="principal">

		<div id="topo">
			Topo da página
		</div>
		
		<div id="barra">
			<ul>
				<li>  </li>           
			</ul>
		</div>
		
		<div id="menu">
			<?php include("mainMenu.php"); ?>
		</div>

		<div id="formulario">  
			<label>Turma </label><BR />
			<select name="turma" class="edits" id="turma" onChange="listaAlunos(this.value);">
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
			
			<table id="tabela">
			</table>
		</div>
		<div class="clear">  </div>
		
		<div id="rodape">
			<p>I CS - Cisilio's Sistemas &copy;2014 - Todos os direitos reservados I <a href="#"></a> </p>
		</div>	
		
	</div>
	
  
</body>
</html>
