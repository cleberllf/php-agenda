<?php
session_start('AgENdA');
if( isset($_SESSION['id']) ) {
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../view/listar.php'>";
}
else if( isset($_POST['usuario']) && isset($_POST['senha'])){
	require('login.php');
	$login = new Autenticacao();

	$usuario = $_POST['usuario'];
	$senha   = $_POST['senha'];

	$login->set("usuario", $usuario);
	$login->set("senha", $senha);
        
	if ( $login->autenticar('AgENdA') ) {
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../view/listar.php'>";
	}
	else {
?>
<script charset="utf-8" type="text/javascript">
	alert('Usuário e/ou senha incorreto(s)');
</script>
<?php
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../index.php'>";
	}
}
else {
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../index.php'>";
}
?>