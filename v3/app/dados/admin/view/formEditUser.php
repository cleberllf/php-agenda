<?php
session_start('AgENdA');
if ( (isset($_SESSION['nivel'])) && ($_SESSION['nivel'] == 0) ){
	include("../../controller/login.php");
	$login = new Autenticacao();
	$id = $_GET['id'];
	$parametro = $_GET['p'];
	$vetor = $login->selecionar("*", "agenda_usuarios", " WHERE id = '".$id."'");
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
<?php
	switch ($parametro) {
		case "nome":
?>
			var nome = document.getElementById("txtNome");
			if (nome.value=="") {
				alert("Favor digitar um nome");
				nome.focus();
				return(false);
			}
<?php
		break;
		case "usuario":
?>
			var login = document.getElementById("txtLogin");
			if (login.value=="") {
				alert("Favor digitar um login");
				login.focus();
				return(false);
			}
<?php
		break;
		case "senha":
?>
			var pass = document.getElementById("txtPass");
			if (pass.value=="") {
				alert("Favor digitar uma senha");
				pass.focus();
				return(false);
			}
<?php
		break;
	}
?>
			if ( !confirm("Tem certeza que deseja alterar o usuário?") ) {
				return(false);
			}
			return true;
		}
	</script>
</head>
<body>

<blockquote>
<h2>ADMINISTRAÇÃO</h2>
<h1>EDITAR USUÁRIO</h1>

<form action="../controller/editUser.php" method="post" id="formEdit">
<input type="hidden" name="p" value="<?php echo $parametro; ?>" />
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<table id="form">
<?php
	switch ($parametro) {
		case "nome":
?>
<tr>
	<th><label for="txtNome">Nome:</label></th>
	<td><input type="text" name="nome" id="txtNome" value="<?php echo $vetor[0]['nome']; ?>" size="100" maxlength="100" /></td>
</tr>
<?php
		break;
		case "usuario":
?>
<tr>
	<th><label for="txtLogin">Login:</label></th>
	<td><input type="text" name="usuario" id="txtLogin" value="<?php echo $vetor[0]['usuario']; ?>" size="10" maxlength="10" /></td>
</tr>
<?php
		break;
		case "senha":
?>
<tr>
	<th><label for="txtPass">Nova Senha:</label></th>
	<td><input type="password" name="senha" id="txtPass" size="10" maxlength="10" /></td>
</tr>
<?php
		break;
		case "nivel":
?>
<tr>
	<th><label for="nivel">Nível:</label></th>
	<td>
		<select size="1" name="nivel" id="nivel">
<?php
			$nivel = $vetor[0]['nivel'];
			if($nivel==0) {
?>
			<option selected="selected" value="0">Administrador</option>
			<option value="1">Usuário Comum</option>
<?php
			}
			else if ($nivel==1) {
?>
			<option value="0">Administrador</option>
			<option selected="selected" value="1">Usuário Comum</option>
<?php
			}
?>
		</select>
	</td>
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