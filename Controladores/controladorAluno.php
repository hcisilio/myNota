<?php
session_start("mynota");
include ("../ClassesSQL/classeAlunoSQL.php");
//include ("controladorTurma.php");
//include ("controladorModulo.php");

class ControladorAluno {
	
	function inserir(){
		$aluno = new Aluno();
		$aluno->setNome($_REQUEST["nome"]);
		$aluno->setId($_REQUEST["id"]);
		$persistir = new AlunoSQL();
		$ok = $persistir->inserir($aluno);
		if ($ok == true){
			$_SESSION["msg"] = "
			Aluno $id - $nome registrado no sistema!
			";
			header ("location: ../GUIs/sucesso.php");
		}
		else{
			$_SESSION["msg"] = "Ops! Cadastro de aluno não efetuado.";
			$_SESSION["erro"] = mysql_error();
			header ("location: ../GUIs/erro.php");
		}
	}
	
	
	### outras funções
	
	function buscar(){
		$q = $_REQUEST["q"];
		$persistir = new AlunoSQL();
		$alunos = $persistir->buscar($q);
		if ($alunos == false){
			$_SESSION["msg"] = "Ops! Não foram localizados clientes com o nome informado.";
			header("location: ../GUIs/notFound.php");
		}
		else {
			$total = count($alunos);
			for($i=0; $i<$total; $i++) {
				$ids[] = $alunos[$i]->getId();
				$nomes[] = $alunos[$i]->getNome();				
			}
			$_SESSION["ids"] = $ids;			
			$_SESSION["nomes"] = $nomes;	
			$_SESSION["total"] = $total;		
			header("location: ../GUIs/listarAlunos.php");
		}
	}
	
	function listarPorTurma(){
		$id = $_REQUEST["turma"];
		//$id = "Familia";
		$persistir = new ControladorTurma();
		$turma = $persistir->listar($id);
		$persistir = new AlunoSQL();
		$alunos = $persistir->listarPorTurma($turma);
		return $alunos;
	}
	/*function listarPorTurma(){				
		$id = $_REQUEST["turma"];
		
		$persistir = new controladorNota();
		$notas = $persistir->listarPorTurma();		
		
		$persistir = new ControladorTurma();
		$turma = $persistir->listar($id);
		$persistir = new AlunoSQL();
		$alunos = $persistir->listarPorTurma($turma);
		$total = count($alunos);		
		if ($total==0){
			$txt .= "<td colspan='2'> Não há alunos matriculados nesta turma </td>";
		}	
		else {				
			$txt = "<script type=\"text/javascript\" src=\"../Ajax/tabelaEditavel.js\"></script>";
			$txt .= "<table>";
			$txt .= "<tr> <td colspan='2'> Notas da Turma </td> </tr>";
			for($i=0; $i<$total; $i++) {
				$id = $alunos[$i]->getId();
				$nome = $alunos[$i]->getNome();
				$txt .= "<tr> <td> $id </td> <td> $nome </td>";
				//$txt .= "<tr> <td> $id </td> <td title\"nome\" class='editavel'> $nome </td> </tr>";
				for ($j=0; $j<$qtdModulos; $j++) {
					$idm = $modulos[$j]->getId();
					$nomem = $modulos[$j]->getNome();
					$txt .= "<td class='editavel'> $idm </td> <td class='editavel'> $nomem </td>";
				}
				$txt .= "</tr>";
			}
			$txt .= "</table>";
		}		
		echo $txt;
	}*/
}
?>