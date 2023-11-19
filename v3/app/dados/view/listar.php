<?php
session_start('AgENdA');
if( isset($_SESSION['id']) ) {
	require('../controller/login.php');
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
<h1>CONTATOS CADASTRADOS</h1>
<h4>Usuário: <?php echo $_SESSION['nome']; ?></h4>
    
<table id="barraNavegacao">
<tr>
	<td><a href="./formAddContato.php">Adicionar Contato</a></td>
<?php
	if ( isset($_SESSION['nivel']) && $_SESSION['nivel'] == 0 ) {
?>
	<td><a href='../admin/index.php'>Administração</a></td>
<?php
	}
?>
	<td><a href="./formPerfil.php">Configurar Conta</a></td>
	<td class="right"><a href="../controller/logout.php">Logout</a></td>
</tr>
</table>

<br/>
<table id="listaDados">
<thead>
<tr>
	<th>Nome</th>
	<th>Telefone</th>
	<th>Celular</th>
	<th>Opção</th>
</tr>
</thead>
<tbody>
<?php
	$vetor = $login->selecionar( "*", "agenda_contatos", "WHERE usuario_id = ".$_SESSION['id'], "ORDER BY nome" );
	//$vetor = $login->selecionar( "*", "agenda_contatos", "WHERE usuario_id = ".$_SESSION['id'], "ORDER BY nome", "LIMIT 0, 100" );
	for($i=0; $i<count($vetor); $i++) {
		$id = $vetor[$i]['id'];
		$nome = $vetor[$i]['nome'];
		$telefone = "";
		$celular = "";
		if (!empty($vetor[$i]['telefone'])) {
			$telefone = $vetor[$i]['telefone'];
		}	else {
			$telefone = "+";
		}
		if (!empty($vetor[$i]['celular'])) {
			$celular = $vetor[$i]['celular'];
		}	else {
			$celular = "+";
		}
?>
<tr>
	<td><a href="./formEditContato.php?p=nome&amp;id=<?php echo $id; ?>"><?php echo $nome; ?></a></td>
	<td><a href="./formEditContato.php?p=telefone&amp;id=<?php echo $id; ?>"><?php echo $telefone; ?></a></td>
	<td><a href="./formEditContato.php?p=celular&amp;id=<?php echo $id; ?>"><?php echo $celular; ?></a></td>
	<td><a class="red" href="javascript:confirma('excluir o contato', '<?php echo $nome; ?>', '../controller/delContato.php?id=<?php echo $id; ?>', '')">Excluir</a></td>
</tr>
<?php
	}
?>
</tbody>
</table>

</blockquote>
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
</body>
</html>