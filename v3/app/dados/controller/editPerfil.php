<?php
session_start('AgENdA');
if ( isset($_SESSION['id']) ) {
	if ( isset($_POST['nome']) && isset($_POST['nivel']) ) {
		include("login.php");
		$login = new Autenticacao();
		if ( isset($_POST['senha']) && isset($_POST['senha2']) && ($_POST['senha'] != "") && ($_POST['senha'] == $_POST['senha2']) ) {
			$campos = array("nome", "senha");
			$valores = array($_POST['nome'], md5($_POST['senha']));
		}
		else {
			$campos = array("nome");
			$valores = array($_POST['nome']);
		}
		$login->atualizar($_SESSION['id'], $campos, $valores, "agenda_usuarios");
		$_SESSION['nome'] = $_POST['nome'];
		$_SESSION['nivel'] = $_POST['nivel'];
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../view/listar.php'>";
	}
	else {
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../view/listar.php'>";
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