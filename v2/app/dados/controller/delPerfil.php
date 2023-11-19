<?php
session_start('AgENdA');
if ( isset($_SESSION['id']) ) {
	if ( (isset($_GET['p'])) && ($_GET['p'] == "del") ) {
		include("login.php");
		$login = new Autenticacao();
		$login->excluir($_SESSION['id'], "usuario_id", "agenda_contatos");
		$login->excluir($_SESSION['id'], "id", "agenda_usuarios");
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=./logout.php'>";
	}
	else {
		echo "listar";
		//echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../view/listar.php'>";
	}
}
else {
?>	
<script charset="utf-8" type="text/javascript">
	alert('Necessário login para acessar esta página.');
</script>
<?php
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../index.php'>";
}
?>