<?php
session_start('AgENdA');
if( isset($_SESSION['id']) ) {
	if ( isset($_GET['id']) ) {
		require('login.php');
		$login = new Autenticacao();
		$login->excluir($_GET['id'], "id", "agenda_contatos");
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