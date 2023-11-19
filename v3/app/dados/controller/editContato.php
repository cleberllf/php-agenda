<?php
session_start('AgENdA');
if( isset($_SESSION['id']) ) {
	if ( isset($_POST['id']) && isset($_POST['p']) && isset($_POST[$_POST['p']]) ) {
		require('login.php');
		$login = new Autenticacao();
		$campo = array($_POST['p']);
		$valor = array($_POST[$campo[0]]);
		$login->atualizar($_POST['id'], $campo, $valor, "agenda_contatos");
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