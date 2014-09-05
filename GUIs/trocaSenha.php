<?php 
	session_start("mynota");
	if ($_SESSION["logado"] == "true"){
		$id = $_SESSION["id"];
	}
	else {
		header("Location: ../GUIs/login.php");
	}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Trocar Senha</title>
<link rel="stylesheet" type="text/css" href="CSS/mynota.css">
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
	
	<div id="principal">

		<div id="topo">
			Topo da página
		</div>
		
		<div id="barra">
			<ul>
				<li> <a href="JavaScript:doPost('Professor','alterar')"> <img src="Imagens/save.png"> </a></li>           
			</ul>
		</div>
		
		<div id="menu">
			<?php include("mainMenu.php"); ?>
		</div>

		<div id="formulario">
			<form action="../Controladores/controlador.php" method="post">
				<label> Login </label> <br>
				<input type="text" name="id" id="id" class="edits" size="21" readonly="readonly" value="<?php echo $id; ?>"> <br/>
				<label>Nova Senha</label> <br>
				<input type="password" name="senha" id="senha" class="edits" size="21" /> <br>
				<label>Confirma Nova Senha</label> <br>
				<input type="password" name="confirmaSenha" id="confirmaSenha" class="edits" size="21" /> <br>				
			</form>
		</div>		
		<div class="clear">  </div>
		
		<div id="rodape">
			<p>I CS - Cisilio's Sistemas &copy;2014 - Todos os direitos reservados I <a href="#"></a> </p>
		</div>	
		
	</div>
	
</body>