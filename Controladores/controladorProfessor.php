<?php
session_start("mynota");
include ("../ClassesSQL/classeProfessorSQL.php");


class ControladorProfessor {
	
	function inserir(){
		$professor = new professor();
		$professor->setNome($_REQUEST["nome"]);
		$professor->setId($_REQUEST["id"]);
		$professor->setComentario($_REQUEST["comentario"]);
		$professor->setSenha(md5($_REQUEST["senha"]));
		$professor->setAcesso($_REQUEST["acesso"]);
		$persistir = new ProfessorSQL();
		$ok = $persistir->inserir($professor);
		if ($ok == true){
			$resultado = "
				<div class='alert alert-success' role='alert'>
					Professor registrado no sistema!
				</div>
			";
		}
		else{
			$resultado = "
				<div class='alert alert-danger' role='alert'>
					Ops! Cadastro de professor não efetuado. <BR />".mysql_error()."
				</div>
			";
		}
		echo $resultado;
	}
	
	function alterar(){
		$persistir = new ProfessorSQL();
		$professor = $persistir->listar($_REQUEST["id"]);
		$n = 0;
		if (isset($_REQUEST["nome"])) {
			$professor->setNome($_REQUEST["nome"]);
			$msgOk = "Nome do professor alterado com sucesso!";
			$n++;
		}
		if (isset($_REQUEST["comentario"])) {
			$professor->setComentario($_REQUEST["comentario"]);
			$msgOk = "Comentário do professor alterado com sucesso!";
			$n++;
		}
		if (isset($_REQUEST["acesso"])) {
			$professor->setAcesso($_REQUEST["acesso"]);
			$msgOk = "Acesso do professor alterado com sucesso!";
			$n++;
		}
		if (isset($_REQUEST["ativo"])) {
			$professor->setAtivo($_REQUEST["ativo"]);
			if ($_REQUEST["ativo"] == 'Ativo') {
				$msgOk = "Professor reativado com sucesso!";
			}
			else if ($_REQUEST["ativo"] == 'Inativo') {
				$msgOk = "Professor desativado com sucesso!";
			}
			$n++;
		}
		if (isset($_REQUEST["senha"])){
			$professor->setSenha(md5($_REQUEST["senha"]));
			$msgOk = "Troca de senha realizada com sucesso!";
			$n++;
		}
		if ($persistir->alterar($professor)){
			if ($n > 1) {
				$msgOk = "Alterações no cadastro do professor realizadas com sucesso!";
			}
			$resultado = "
				<div class='alert alert-success' role='alert'>
					$msgOk
				</div>
			";
		}
		else {
			$resultado = "
				<div class='alert alert-danger' role='alert'>
					Ops! A alteração falhou!. <BR />".mysql_error()."
				</div>
			";
		}
		echo $resultado;
	}

	function deletar(){
		
	}
	
	function listar(){
		$persistir = new ProfessorSQL;
		return $persistir->listar($_REQUEST["id"]);
	}
	
	function listarTodos(){
		$persistir = new ProfessorSQL();
		$parametros = False;
		return $persistir->listarMuitos($parametros);
	}
	
	function listarPorStatus($tipo){
		$persistir = new ProfessorSQL();
		$parametros = array("ativo" => $tipo);
		return $persistir->listarMuitos($parametros);
	}

	function preparaEdicao(){
		$professor = $this->listar();
		$admin = Null;
		$dir = Null;
		$prof = Null;
		if ($professor->getAcesso() == 'Administrador') {
			$admin = 'selected';
		}
		else if ($professor->getAcesso() == 'Diretor') {
			$dir = 'selected';
		}
		else if ($professor->getAcesso() == 'Professor') {
			$prof = 'selected';
		}
		$formulario = "
			<form id='editarProfessor' action='../Controladores/controlador.php' method='post'>
				<div class='input-group abaixo'>
			 		<span class='input-group-addon edits'><span class='glyphicon glyphicon-user'></span></span>			 		
					<input class='form-control edits nuloOUvazio' name='id' id='id' type='text' placeholder='Login' readonly='True' value='".$professor->getId()."'>
			  	</div>
				<div class='input-group abaixo'>
			 		<span class='input-group-addon edits'><span class='glyphicon glyphicon-pencil'></span></span>			 		
					<input class='form-control edits nuloOUvazio' name='nome' id='nome' type='text' placeholder='Nome Completo' value='".$professor->getNome()."'>
			  	</div>
			  	<div class='input-group abaixo'>
			  		<span class='input-group-addon edits'><span class='glyphicon glyphicon-tags'></span></span>		
					<select id='acesso' name='acesso' class='form-control edits'>
						<option value='Professor' $prof> Professor </option>
						<option value='Diretor' $dir> Diretor </option>
						<option value='Administrador' $admin> Administrador </option>
					</select>
				</div>
				<div class='input-group abaixo'>
					<textarea name='comentario' id='comentario' cols='200%' rows='5' class='form-control edits' placeholder='Comentários'>".$professor->getComentario()."</textarea>
				</div>
				<div align='right'>
					<input type='button' class='btn btn-primary' value='Salvar' onclick='JavaScript:editarProfessor()'>						
				</div>
			</form>
		";
		echo $formulario;
	}

	function criarTabela(){
		$tabela = "<table border='1' id='professores' class='table table-striped tabela-consulta'>";
		$tabela .= "<tr> <th> Login </th> <th> Nome Completo </th> <th> Comentário </th> <th> Acesso </th> <th> Controle </th> </tr>";
		$professores = $this->listarPorStatus($_REQUEST['tipo']);
		if ($_REQUEST['tipo'] == 'Ativo' ) {
			$linha = "<td> 
				<p> <a href='' onClick=\"preparaEdicao()\" data-toggle='modal' data-target='#editarProfessorModal' class='btn btn-warning'> <span class='glyphicon glyphicon-edit'> </span> </a> </p>
				<p> <a href='#' onClick=\"restaurarSenha('0000')\" class='btn btn-warning'> <span class='glyphicon glyphicon-repeat' </span> </a> </p>
				<p> <a href='#' onClick=\"alterarStatus('Inativo')\" class='btn btn-danger'> <span class='glyphicon glyphicon-log-out'> </a> </p>
			</td>";
		}
		else if ($_REQUEST['tipo'] == 'Inativo'){
			$linha = "<td> <p> <a href='#' onClick=\"alterarStatus('Ativo')\" class='btn btn-success'> <span class='glyphicon glyphicon-log-in'> </a> </p> </td>";
		}

		if ($professores){
			foreach ($professores as $professor){
				$tabela .= "<tr> 
					<td align='left'>".$professor->getId()."</td>
					<td align='left' width = '30%'>".$professor->getNome()."</td>
					<td align='left' width = '40%'>".$professor->getComentario()."</td>
					<td align='left'>".$professor->getAcesso()."</td>
					$linha
				</tr>";
			}
		}
		else {
			$tabela = "<div class='alert alert-danger' role='alert'> Sem professores para exibir </div>";
		}

		echo $tabela;
	}
	
	function criarCombo(){
		$combo = "<option value='null'> Selecione um Professor </option>";
		if ($_REQUEST["tipo"] == "todos"){
			$professores = $this->listarTodos();
		}
		else {
			$professores = $this->listarPorStatus($_REQUEST['tipo']);
		}
		foreach ($professores as $professor) {
			$combo .= "<option value=".$professor->getId()."> ".$professor->getNome()." </option>";
		}
		echo $combo;
	}
	
	function login(){
		$login = $_REQUEST["id"];
		$senha = md5($_REQUEST["senha"]);
		$persistir = new ProfessorSQL();
		$professor = $persistir->listar($login);
		if (!$professor->getId()) {
			//Professor não cadastrado
			$saida = 0;
			echo $saida;
		}
		else if ($professor->getAtivo() <> 'Ativo'){
			//Professor inativo
			$saida = 1;
			echo $saida;
		}
		else {
			if ($senha != $professor->getSenha()){				
				//senha incorreta
				$saida = 2;
				echo $saida;
			} 
			else {
				$_SESSION["logado"] = "true";
				$_SESSION["id"] = $login;
				$_SESSION["senha"] = $senha;
				$_SESSION["nome"] = $professor->getNome();
				$_SESSION["acesso"] = $professor->getAcesso();
				echo "home.php";
			}
		}
	}
	
	function logout(){
		$_SESSION['logado'] = "false";
		session_destroy();
		header("Location: ../GUIs/login.php");
	}
}
?>