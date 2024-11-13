<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['usuario'];

include 'header.php';
?>

<div class="sidebar">
    <div class="user-info">
        <img src="<?php echo htmlspecialchars($usuario['foto']); ?>" alt="Foto do usuário">
        <h3><?php echo htmlspecialchars($usuario['nome']); ?></h3>
        <p><?php echo htmlspecialchars($usuario['email']); ?></p>
    </div>
</div>

<div class="content">
    <h4>PARABÉNS VOCÊ ESTÁ CONECTADO</h4>
</div>

<?php
include 'footer.php';
?>
