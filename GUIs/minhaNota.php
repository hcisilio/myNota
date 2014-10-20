<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Consulta de nota individual</title>
	<link rel="stylesheet" type="text/css" href="CSS/estilos.css">
	<link href="CSS/bootstrap.css" rel="stylesheet">	
	<script src="../Ajax/jQuery.js"></script>
	<script type="text/javascript" src="../Ajax/validacoes.js"></script>
	<script src="js/bootstrap.min.js"></script>	
	<script>
		function listarTurmas() {		
			$.ajax({			        
				type: "POST",
				url: "../Controladores/controlador.php",
				data: { 
					aluno: $("#aluno").val(),					
					tipo: "porAluno",					
					classe: "Turma",
					metodo: "criarCombo"
				},
				
				beforeSend: function() {
					$("#turma").empty();				
					$("#turma").append('<option>Carregando...</option>');					
				},
				success: function(combo) {
					if (combo!= 0){
						$("#turma").empty();				
						$("#turma").append(combo);
						$('#aluno').prop('readonly', true);
					}
					else {
						$("#turma").empty();				
						$("#turma").append("<option value='null'>Matrícula informada não existe</option>");						
					}	
				},
				error: function(combo) {				
				}
			});
		}

		function consultarNotas() {
			if ($("#turma").val() != "null"){
				$.ajax({			        
					type: "POST",
					url: "constroiNotasAluno.php",
					data: { 
						aluno: $("#aluno").val(),					
						turma: $("#turma").val()
					},
					
					beforeSend: function() {
						$("#notas").html("<img src='Imagens/carregando.gif'/>");				
					},
					success: function(txt) {				
						$("#notas").html(txt);	
					},
					error: function(txt) {	
						$("#notas").html("fudeu");			
					}
				});
			}
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
					<li> <a href="home.php"> <img src="Imagens/home.png"> </a></li>				         
				</ul>
			</div>
		</div>
	</nav>
	
	<div id="row">
		<!-- espaçamento -->
		<div class="col-md-3">
		</div>
		<!-- conteúdo -->
		<div class="abaixo col-md-6">			
			<form class="form-inline" action="../Controladores/controlador.php" method="post">
				<div class="input-group abaixo">			 				 	
					<input class="form-control edits" name="aluno" id="aluno" type="text" placeholder="Matrícula" maxlength="10">
					<span class="input-group-btn">
				    	<button class="btn btn-default edits" type="button" OnClick="listarTurmas()">OK</button>
				    </span>
			  	</div>
			  	<div class="input-group abaixo">
			 		<span class="input-group-addon edits"><span class="glyphicon glyphicon-barcode"></span></span>			 		
					<select class="form-control edits" name="turma" id="turma" onChange="consultarNotas()">
						<option value="null"> Informe a matrícula do aluno </option>
					</select>
			  	</div>
			</form>	
			<div id="notas"></div>	
		</div>
		<!-- sobra -->
		<div class="col-md-3">
		</div>		
	</div>
	
	<!-- rodapé -->
	<?php include ("rodape.php") ?>

</body>