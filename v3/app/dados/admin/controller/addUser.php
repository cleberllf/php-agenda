<?php
session_start('AgENdA');
if ( isset($_SESSION['nivel']) && ($_SESSION['nivel'] == 0) ) {
	if ( isset($_POST['nome']) && isset($_POST['usuario']) && isset($_POST['senha']) && isset($_POST['nivel']) ) {
		include("../../controller/login.php");
		$login = new Autenticacao();
		$valores = array("", $_POST['nome'], $_POST['usuario'], md5($_POST['senha']), $_POST['nivel']);
		$login->inserir($valores, "agenda_usuarios");
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