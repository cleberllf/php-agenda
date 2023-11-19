<?php
session_start('AgENdA');
if ( isset($_SESSION['id']) ) {
	require('../controller/login.php');
	$login = new Autenticacao();
	$id = $_GET['id'];
	$parametro = $_GET['p'];
	$vetor = $login->selecionar("*", "agenda_contatos", " WHERE id = ".$_GET['id']);
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Agenda 2.0</title>
	<link rel="stylesheet" type="text/css" charset="utf-8" href="../css/estilo.css" />
	<link rel="icon" type="image/gif" href="../favicon.gif" />
	<script type="text/javascript">
		function verificar() {
<?php
	if ( $parametro == "nome" ) {
?>
			var nome = document.getElementById("txtNome");
			if (nome.value=="") {
				alert("Favor digitar um nome.");
				nome.focus();
				return(false);
			}
<?php
	}
?>
			if ( !confirm("Tem certeza que deseja alterar o contato?") ) {
				return(false);
			}
			return true;
		}
	</script>
</head>

<body>
<blockquote>
<h1>Editar Contato</h1>

<form action="../controller/editContato.php" method="post" name="formEdit">
	<input type="hidden" name="p" id="p" value="<?= $parametro ?>" />
	<input type="hidden" name="id" value="<?= $id ?>" />
<table id="form">
<?php
	switch ($parametro) {
		case "nome":
?>
<tr>
	<th><label for="txtNome">Nome:</label></th>
	<td><input type="text" name="nome" id="txtNome" value="<?= $vetor[0]['nome'] ?>" size="100" maxlength="100" /></td>
</tr>
<?php
			break;
		case "telefone":
?>
<tr>
	<th><label for="txtTel">Telefone:</label></th>
	<td><input type="text" name="telefone" id="txtTel" value="<?= $vetor[0]['telefone'] ?>" size="8" maxlength="8" /></td>
</tr>
<?php
			break;
		case "celular":
?>
<tr>
	<th><label for="txtCel">Celular:</label></th>
	<td><input type="text" name="celular" id="txtCel" value="<?= $vetor[0]['celular'] ?>" size="8" maxlength="8" /></td>
</tr>
<?php
			break;
	}
?>
<tr>
	<td>&nbsp;</td>
	<td><input type="submit" value="ALTERAR" onclick="return verificar();" /></td>
</tr>
</table>

</form>
	
<table id="barraNavegacao">
<tr>
	<td><a href="listar.php">Voltar</a></td>
	<td class="right"><a href="../controller/logout.php">Logout</a></td>
</tr>
</table>

</blockquote>

</body>
</html>
<?php
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