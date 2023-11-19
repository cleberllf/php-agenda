<?php
session_start('AgENdA');
if ( isset($_SESSION['nivel']) && ($_SESSION['nivel'] == 0) ){
	if ( isset($_POST['p']) && isset($_POST[$_POST['p']]) ) {
		include("../../controller/login.php");
		$login = new Autenticacao();
		$campo = array($_POST['p']);
		if ($campo[0] == "senha") {
			$valor = array(md5($_POST[$campo[0]]));
		}
		else {
			$valor = array($_POST[$campo[0]]);
		}
		$login->atualizar($_POST['id'], $campo, $valor, "agenda_usuarios");
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