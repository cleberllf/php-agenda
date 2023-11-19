<?php
session_start('AgENdA');
if ( isset($_SESSION['nivel']) && ($_SESSION['nivel'] == 0) ){
	if ( isset($_GET['id']) ) {
		include("../../controller/login.php");
		$login = new Autenticacao();
		$login->excluir($_GET['id'], "usuario_id", "agenda_contatos");
		$login->excluir($_GET['id'], "id", "agenda_usuarios");
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../index.php'>";
	}
	else {
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../index.php'>";
	}
}
else if( isset($_SESSION['id']) ) {
?>	
<script charset="utf-8" type="text/javascript">
	alert('Você não é administrador.');
</script>
<?php
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../../view/listar.php'>";
}
else {
?>	
<script charset="utf-8" type="text/javascript">
	alert('Necessário login para acessar esta página.');
</script>
<?php
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../../index.php'>";
}
?>