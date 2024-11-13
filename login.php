<?php
ini_set('display_errors', 1); // Habilita a exibição de erros
error_reporting(E_ALL);       // Exibe todos os tipos de erros
?>


<?php


$titulo = "Login";
session_start();

$erro = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'], $_POST['senha'])) {
    $login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
    $senha = $_POST['senha'];

    include 'Config/db.php';

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE login = :login");
    $stmt->bindParam(":login", $login);
    $stmt->execute();
    $row = $stmt->fetch();

    if ($row && password_verify($senha, $row['senha'])) {
        $_SESSION['logado'] = true;
        $_SESSION['usuario'] = $row;
        header("Location: dashboard.php");
        exit;
    } else {
        $erro = "Usuário ou senha incorretos.";
    }
}

include 'header.php';
?>

<section>
    <div class="form-box-login">
        <div class="form-value">
            <form action="" method="POST">
                <h2>Login</h2>
                <div class="inputbox">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="text" name="login" required>
                    <label for="">Usuário</label>
                </div>
                <div class="inputbox">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" name="senha" required>
                    <label for="">Senha</label>
                </div>
                <button type="submit">Entrar</button>
                <?php if ($erro): ?>
                    <div class="error"><?php echo htmlspecialchars($erro); ?></div>
                <?php endif; ?>
                <div class="register">
                    <p>Não tenho uma conta <a href="cadastro.php">Registrar-se</a></p>
                </div>
            </form>
        </div>
    </div>
</section>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<?php
include 'footer.php';
?>
