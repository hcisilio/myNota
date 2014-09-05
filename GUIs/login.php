<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>CS MyNota - Login</title>
	<link rel="stylesheet" type="text/css" href="CSS/mynota.css">
	<script>
		function limpar(texto){
			var txt = texto;
			if (txt == "Login"){
				document.getElementById("id").value = "";
			}
			if (txt=="Senha"){
				document.getElementById("senha").value = "";
			}
		}
		
		function preencher(texto){
			var txt = texto;
			if (txt == ""){
				document.getElementById("id").value = "Login";
			}
			if (txt==""){
				document.getElementById("senha").value = "Senha";
			}
		}
		
		function viraSenha(elemento) {
			elemento.type = "password";
		}
		
		function viraText(elemento){
			if (elemento.value == "") {
				elemento.type = "text";
			}
		}
	</script>
</head>
<body>
	<div id="principal">
		<div id="topo"> <a href="index.html"> <img src="Imagens/logo.png" alt="logo" width="273" height="103"/> </a> </div>
		
			<form action="../Controladores/controlador.php" method="post">  
				<ul id="barra"> 
					<li></li>
				</ul>
				
				<div align="center" id="login">
					<input type="hidden" name="classe" value="Professor">
					<input type="hidden" name="metodo" value="login"> 
					<p> <input name="id" type="text" size="15" class="edits" id ="id" value="Login" onFocus="JavaScript:limpar(this.value)" onBlur="JavaScript:preencher(this.value)"></p>
					<p> <input name="senha" type="text" size="15" class="edits" id="senha" value="Senha" onFocus="JavaScript:viraSenha(this); JavaScript:limpar(this.value)" onBlur="JavaScript:viraText(this); JavaScript:preencher(this.value)"></p>     
					<p><input name="btnLogin" type="submit" class="botaoReal" id="botao" style="botao" value="Login"></p> 					
				</div> 
			    
		    </form>
		<div id="rodape">
			<p>I CS - Cisilio's Sistemas &copy;2014 - Todos os direitos reservados I <a href="#"></a> </p>
		</div>
	</div>
</body>
</html>