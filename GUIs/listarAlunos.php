<?php
	session_start("mynota");
	$link = $_SESSION["permissao"];
	$ids = $_SESSION["ids"];		
	$nomes = $_SESSION["nomes"];
	$total = $_SESSION["total"];
	//Liberando as variáveis de sessão
	unset ($_SESSION["ids"]);	
	unset ($_SESSION["nomes"]);
	unset ($_SESSION["total"]);
?>
<html>
<head>
<title>Selecionar Aluno</title>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<link rel="stylesheet" media="screen" type="text/css" title="style" href="CSS/style-popup.css" />
<script>
	function enviarDados(aluno, nome){	
		window.opener.document.getElementById('aluno').value = aluno;
		window.opener.document.getElementById('nome').value = nome;
		window.close();
	}
</script>
</head>

<body>
<div id="shadow">
	<ul id="menu"> 				
		<a href='javascript:window.history.go(-1)'> <img src='Imagens/go-back-button.png'> </a>
	</ul>	
	<div id="conteudo">
		<table class="tabela">
			<tr>
				<td colspan ="2"> Seleção de Aluno</td> 
			</tr>
			<tr>
				<td colspan = '2'>  </td>
			</tr>
			<tr>
				<td> Matrícula </td> 
				<td> Nome </td>				
			</tr>
			<?php
			for ($i=0; $i<$total; $i++){			
				$id = $ids["$i"];
				$nome = $nomes["$i"];				
				echo "
					<tr>
					<td><a href=\"javaScript:enviarDados('$id','$nome');\">$id</a></td>
					<td>$nome</td>					
					</tr>
				";
			}
			?>
		</table>
	</div>
	<div class="clear"></div>
</div> 
<div id="footer">
  <p>I CS - Cisilio's Sistemas &copy;2013 - Todos os direitos reservados I <a href="#"></a> </p>
</div>
</body>
</html>