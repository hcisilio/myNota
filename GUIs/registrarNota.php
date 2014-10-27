<?php
	include ("../permissao.php");	
?>
<html>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
	<title>Lançar notas</title>
	<link rel="stylesheet" type="text/css" href="CSS/estilos.css">
	<link href="CSS/bootstrap.css" rel="stylesheet">	
	<script src="js/bootstrap.min.js"></script>	
	<script type="text/javascript" src="../Ajax/jQuery.js"></script>
	<!--  <script type="text/javascript" src="../Ajax/tabelaEditavel.js"></script> -->
	<script type="text/javascript">
	function listaAlunos(turma) {		
	    $.ajax({	    
			type: "GET",
			url: "constroiNotasTurma.php",
			data: { turma: turma },
			
			beforeSend: function() {
				$("#tabela").html("<img src='Imagens/carregando.gif'/>");
			},
			success: function(txt) {
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

	<!-- NavBar -->
	<nav class="navbar navbar-default" role="navigation" id="barra">
		<div class="container-fluid">
			<div class="navbar-header">
				<!-- colocar alguma imagem mynota -->
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">	
					<li> </li>				         
				</ul>
			</div>
		</div>
	</nav>

	<div id="row">
		<!-- menu lateral -->
		<div class="col-md-3 menuLateral">
			<?php include("opcoes".$_SESSION["acesso"].".php"); ?>
		</div>
		<!-- espaçamento -->
		<div class="col-md-1">
		</div>
		<!-- conteúdo -->
		<div id="principal" class="abaixo col-md-7">			
			<div class="input-group abaixo">
				<span class="input-group-addon edits"><span class="glyphicon glyphicon-barcode"></span></span>			 		
				<select name="turma" class="form-control edits" id="turma" onChange="listaAlunos(this.value);">
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
				</select>
			</div>
			
			<div id="tabela" class="abaixo"
			</div>
			
		</div>	
		<!-- sobra -->
		<div class="col-md-1">
		</div>
		
	</div>
		
	
	<!-- rodapé -->
	<?php include ("rodape.php") ?>
	
  
</body>
</html>
