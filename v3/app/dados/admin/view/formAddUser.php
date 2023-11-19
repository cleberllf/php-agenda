<?php
session_start('AgENdA');
if ( (isset($_SESSION['nivel'])) && ($_SESSION['nivel'] == 0) ) {
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Agenda 2.0</title>
	<link rel="stylesheet" type="text/css" charset="utf-8" href="../../css/estilo.css" />
	<link rel="icon" type="image/gif" href="../../favicon.gif" />
	<script charset="utf-8" type="text/javascript">
		function verificar () {
			var nome = document.getElementById("txtNome");
			var user = document.getElementById("txtUser");
			var pass = document.getElementById("txtPass");
			var nivel = document.getElementById("nivel");
			if (nome.value == "") {
				alert("Favor digitar um nome.");
				nome.focus();
				return(false);
			}
			if (user.value == "") {
				alert("Favor digitar um login.");
				user.focus();
				return(false);
			}
			if (pass.value == "") {
				alert("Favor digitar uma senha.");
				pass.focus();
				return(false);
			}
			if (nivel.selectedIndex == 0) {
				alert("Favor selecionar um nível.");
				nivel.focus();
				return(false);
			}
			if ( !confirm('Deseja adicionar o usuário: "' + nome.value + '" ?') ) {
				return(false);
			}
			return true;
		}
	</script>
</head>

<body>

<blockquote>
<h2>ADMINISTRAÇÃO</h2>
<h1>ADICIONAR USUÁRIO</h1>

<form action="../controller/addUser.php" method="post" id="formAdd">
<table id="form">
<tr>
	<th><label for="txtNome">Nome:</label></th>
	<td><input type="text" name="nome" id="txtNome" size="100" maxlength="100" /></td>
</tr>
<tr>
	<th><label for="txtUser">Login:</label></th>
	<td><input type="text" name="usuario" id="txtUser" size="10" maxlength="10" /></td>
</tr>
<tr>
	<th><label for="txtPass">Senha:</label></th>
	<td><input type="password" name="senha" id="txtPass" size="10" maxlength="10" /></td>
</tr>
<tr>
	<th><label for="nivel">Nível:</label></th>
	<td>
		<select size="1" name="nivel" id="nivel">
			<option selected="selected">&nbsp;</option>
			<option value="0">Administrador</option>
			<option value="1">Usuário Comum</option>
		</select>
	</td>
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
	<td><a href="../index.php">Voltar</a></td>
	<td class="right"><a href="../../controller/logout.php">Logout</a></td>
</tr>
</table>

</blockquote>
</body>
</html>
<?php
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