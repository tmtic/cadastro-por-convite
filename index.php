<?php
session_start();
require 'config.php';

if(empty($_SESSION['logado'])) {
	header("Location: login.php");
	exit;
}

$email = '';
$codigo = '';

$sql = "SELECT email, codigo, limite_convite FROM usuarios WHERE id = '".addslashes($_SESSION['logado'])."'";
$sql = $pdo->query($sql);
if($sql->rowCount() > 0) {
	$info = $sql->fetch();
	$email = $info['email'];
	$codigo = $info['codigo'];
	$limite_convite = $info['limite_convite'];
}

?>

<h1>Área interna do sistema</h1>
<p>Usuário: <?php echo $email; ?> - <a href="sair.php">Sair</a></p>
<?php if ($limite_convite < 3 && $limite_convite >= 0): ?>
	<p>Link: http://localhost/projeto_registroporconvite/cadastrar.php?codigo=<?php echo $codigo; ?></p>
<?php else: ?>
	<p>Todos os convites foram utilizados</p>
<?php	endif;?>