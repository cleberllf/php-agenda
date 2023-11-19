<?php
session_start('AgENdA');
if ( (isset($_SESSION['nivel'])) && ($_SESSION['nivel'] == 0) ){
	include("../controller/login.php");
	$login = new Autenticacao();
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Agenda 2.0</title>
	<link rel="stylesheet" type="text/css" charset="utf-8" href="../css/estilo.css" />
	<link rel="icon" type="image/gif" href="../favicon.gif" />
	<script type="text/javascript" charset="utf-8" src="../js/confirma.js"></script>
</head>
<body>

<blockquote>
<h2>ADMINISTRAÇÃO</h2>
<h1>USUÁRIOS CADASTRADOS</h1>
<h4>Usuário: <?php echo $_SESSION['nome']; ?></h4>

<table id="barraNavegacao">
<tr>
	<td><a href="./view/formAddUser.php">Adicionar Usuário</a></td>
	<td><a href="../view/listar.php">Listar Contatos</a></td>
	<td class="right">
		<a href="../controller/logout.php">Logout</a>
	</td>
</tr>
</table>
<br/>
<table id="listaDados">
<thead>
<tr>
	<th>Nome</th>
	<th>Login</th>
	<th>Nível</th>
	<th>Senha</th>
	<th>Opção</th>
</tr>
</thead>
<?php
	$vetor = $login->selecionar("*", "agenda_usuarios"," WHERE id <> ".$_SESSION['id'], " ORDER BY nome, usuario");
	for ($i=0; $i<count($vetor); $i++) {
		$id = $vetor[$i]['id'];
		$nome = $vetor[$i]['nome'];
		$usuario = $vetor[$i]['usuario'];
		$nivel_id = $vetor[$i]['nivel'];
		switch ($nivel_id) {
			case 0: $nivel = "Administrador";
				break;
			case 1: $nivel = "Usuário Comum";
				break;
		}
?>
<tbody>
<tr>
	<td><a href="./view/formEditUser.php?p=nome&amp;id=<?php echo $id; ?>"><?php echo $nome; ?></a></td>
	<td><a href="./view/formEditUser.php?p=usuario&amp;id=<?php echo $id; ?>"><?php echo $usuario; ?></a></td>
	<td><a href="./view/formEditUser.php?p=nivel&amp;id=<?php echo $id; ?>"><?php echo $nivel; ?></a></td>
	<td><a href="./view/formEditUser.php?p=senha&amp;id=<?php echo $id; ?>"><?php echo "Alterar Senha"; ?></a></td>
	<td><a class="red" href="javascript:confirma('excluir o usuário', '<?php echo $nome; ?>', './controller/delUser.php?id=<?php echo $id; ?>', '')">Excluir</a></td>
</tr>
</tbody>
<?php
	}
?>
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
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../view/listar.php'>";
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