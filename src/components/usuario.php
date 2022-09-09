<?php include('./biblioteca.php');

	if($_POST){
		if(isset($_POST['cadastro'])){
			CadastrarUsuario($_POST['rm'],$_POST['nome'],$_POST['email'],$_POST['senha'], $_POST['userstatus'],$_POST['adm']);
		}else if(isset($_POST['atualizar'])){
			AtualizarUsuario($_POST['rm'],$_POST['nome'],$_POST['nasc'],$_POST['genero'],$_POST['tel']);
		}else if(isset($_FILES['foto'])){
			TrocarFoto($_POST['rm'],$_FILES['foto']);
		}else if(isset($_POST['trocarSenha'])){
			TrocarSenha($_POST['rm']);
		}else if(isset($_POST['login']) && isset($_POST['senha'])){
			Login($_POST['login'],$_POST['senha'], 'json');
		}
	}else if($_GET){
		if(isset($_GET['excluir'])){
			ExcluirUsuario($_GET['excluir']);
		}
	}
?>