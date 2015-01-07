<?php 
	include_once ("../Controladores/controladorPermissao.php");
	$persistir = new ControladorPermissao();
	$persistir->autorizarAcesso( end(explode("/", $_SERVER['PHP_SELF'])) );	
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Trocar Senha</title>
	<link rel="stylesheet" type="text/css" href="CSS/estilos.css">
	<link href="CSS/bootstrap.css" rel="stylesheet">	
	<script type="text/javascript" src="../Ajax/jQuery.js"></script>
	<script type="text/javascript">
		function doPost(classe, metodo) {		
			var id = document.getElementById("id").value;
			var senha = document.getElementById("senha").value;	
			var confirmaSenha = document.getElementById("confirmaSenha").value;
			if (senha != confirmaSenha) {
				alert ("Campos Nova Senha e Confirma Nova Senha possuem valores diferentes");
				document.getElementById("senha").value = null;
				document.getElementById("confirmaSenha").value = null;
			}
			else {
				$.ajax({			        
					type: "POST",
					url: "../Controladores/controlador.php",
					data: { 
						id: id,
						senha: senha,
						classe: classe,
						metodo: metodo 
					},				
					success: function(resultado) {			
						$('#principal').hide();				
						$('#principal').html(resultado);
						$('#principal').show("slow");				
					},
					error: function(resulatdo) {				
						//$( '#ajax' ).html('fudeu');
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
				<a class="navbar-brand" href="../GUIs/home.php"> <img alt="Brand" src="Imagens/sublogo_branco.png"> </a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">	
					<li> <a href="JavaScript:doPost('Professor','alterar')"> <img src="Imagens/save.png"> </a></li>				         
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
			<form id="professor" action="../Controladores/controlador.php" method="post">
				<div class="input-group abaixo">
			 		<span class="input-group-addon edits"><span class="glyphicon glyphicon-barcode"></span></span>	
			 		<input type="text" name="id" id="id" class="form-control edits" size="21" readonly="readonly" value="<?php echo $_SESSION["id"]; ?>">					
			  	</div>
			  	<div class="input-group abaixo">
			 		<span class="input-group-addon"><span class="glyphicon"><img src="Imagens/glyphicons_044_keys.png" style="width: 14px; height: 14px;"></span></span>	
			 		<input type="password" name="senha" id="senha" class=" form-control edits" size="21" placeholder="Nova Senha" />				
			  	</div>
				<div class="input-group abaixo">
			 		<span class="input-group-addon"><span class="glyphicon"><img src="Imagens/glyphicons_044_keys.png" style="width: 14px; height: 14px;"></span></span>	
			 		<input type="password" name="confirmaSenha" id="confirmaSenha" class=" form-control edits" size="21" placeholder="Repetir Nova Senha" />				
			  	</div>
			</form>			
		</div>
		<!-- sobra -->
		<div class="col-md-1">
		</div>
		
	</div>
	
	<!-- rodapé -->
	<?php include ("rodape.php") ?>
		
</body>