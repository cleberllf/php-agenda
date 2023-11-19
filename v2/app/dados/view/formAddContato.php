<?php
session_start('AgENdA');
if ( isset($_SESSION['id']) ) {
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Agenda 2.0</title>
	<link rel="stylesheet" type="text/css" charset="utf-8" href="../css/estilo.css" />
	<link rel="icon" type="image/gif" href="../favicon.gif" />
	<script charset="utf-8" type="text/javascript">
		function verificar() {
			var nome = document.getElementById("txtNome");
			var telefone = document.getElementById("txtTel");
			var celular = document.getElementById("txtCel");
			if (nome.value=="") {
				alert("Favor digitar um nome.");
				nome.focus();
				return(false);
			}
			if ((telefone.value=="") && (celular.value=="")) {
				alert("Favor digitar um número de telefone ou celular.");
				telefone.focus();
				return(false);
			}
			if ( !confirm('Deseja adicionar o contato: "' + nome.value + '" ?') ) {
				return(false);
			}
			return true;
		}
	</script>
</head>

<body>
<blockquote>
<h2>Adicionar Contato</h2>

<form action="../controller/addContato.php" method="post" name="formAdd">
<table id="form">
<tr>
	<th><label for="txtNome">Nome:</label></th>
	<td><input type="text" name="nome" id="txtNome" size="100" maxlength="100" /></td>
</tr>
<tr>
	<th><label for="txtTel">Telefone:</label></th>
	<td><input type="text" name="telefone" id="txtTel" size="8" maxlength="8" /></td>
</tr>
<tr>
	<th><label for="txtCel">Celular:</label></th>
	<td><input type="text" name="celular" id="txtCel" size="8" maxlength="8" /></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
		<input type="reset" value="LIMPAR" />
		<input type="submit" value="ADICIONAR" onclick="return verificar();" />
	</td>
</tr>
</table>
</form>

<table id="barraNavegacao">
<tr>
	<td><a href="listar.php">Voltar</a></td>
	<td class="center"><a href="formImport.php">Importar Contatos</a></td>
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