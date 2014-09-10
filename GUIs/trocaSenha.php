<?php 
	session_start("mynota");
	if ($_SESSION["logado"] == "true"){
		$id = $_SESSION["id"];
		$acesso = $_SESSION["acesso"];
	}
	else {
		header("Location: ../GUIs/login.php");
	}
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
					
					beforeSend: function() {						
						//$( '#ajax' ).html('Carregando');
					},
					success: function(txt) {			
						//$( '#ajax' ).html(txt);
						document.getElementById("senha").value = null;
						document.getElementById("confirmaSenha").value = null;
						alert(txt);				
					},
					error: function(txt) {				
						//$( '#ajax' ).html('fudeu');
						alert(txt);
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
					<li> <a href="JavaScript:doPost('Professor','alterar')"> <img src="Imagens/save.png"> </a></li>				         
				</ul>
			</div>
		</div>
	</nav>
	
	<div id="row">
		<!-- menu lateral -->
		<div class="col-md-3 menuLateral">
			<?php include("opcoes$acesso.php"); ?>
		</div>
		<!-- espaçamento -->
		<div class="col-md-1">
		</div>
		<!-- conteúdo -->
		<div class="col-md-7">			
			<form id="professor" action="../Controladores/controlador.php" method="post">
				<div class="input-group abaixo">
			 		<span class="input-group-addon edits"><span class="glyphicon glyphicon-barcode"></span></span>	
			 		<input type="text" name="id" id="id" class="form-control edits" size="21" readonly="readonly" value="<?php echo $id; ?>">					
			  	</div>
			  	<div class="input-group abaixo">
			 		<span class="input-group-addon"><span class="glyphicon"><img src="Imagens/glyphicons_044_keys.png" style="width: 14px; height: 14px;"></span></span>	
			 		<input type="password" name="senha" id="senha" class=" form-control edits" size="21" placeholder="Senha" />				
			  	</div>
				<div class="input-group abaixo">
			 		<span class="input-group-addon"><span class="glyphicon"><img src="Imagens/glyphicons_044_keys.png" style="width: 14px; height: 14px;"></span></span>	
			 		<input type="password" name="confirmaSenha" id="confirmaSenha" class=" form-control edits" size="21" placeholder="Nova Senha" />				
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