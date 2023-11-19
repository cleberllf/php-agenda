<?php
session_start('AgENdA');
if( isset($_SESSION['id']) ) {
	if ( isset($_POST['nome']) && isset($_POST['telefone']) && isset($_POST['celular']) ) {
		require('login.php');
		$login = new Autenticacao();
		$valores = array("",$_SESSION['id'],$_POST['nome'],$_POST['telefone'],$_POST['celular']);
		$login->inserir($valores, "agenda_contatos");
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../view/listar.php'>";
	}
	else {
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../view/listar.php'>";
	}
}
else {
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../index.php'>";
}
?>