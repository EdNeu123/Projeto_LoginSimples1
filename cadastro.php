<?php
$titulo = "Cadastro";
session_start();

$erro = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome'], $_POST['login'], $_POST['senha'], $_POST['email'])) {
    $nome = filter_var($_POST['nome'], FILTER_SANITIZE_STRING);
    $login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $foto = '';

    if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fotoTmpPath = $_FILES['foto']['tmp_name'];
        $fotoName = $_FILES['foto']['name'];
        $fotoExtension = strtolower(pathinfo($fotoName, PATHINFO_EXTENSION));
        $allowedExtensions = array("jpg", "jpeg", "png");

        if (in_array($fotoExtension, $allowedExtensions)) {
            $uploadDir = 'uploads/';
            $foto = $uploadDir . uniqid() . '.' . $fotoExtension;
            move_uploaded_file($fotoTmpPath, $foto);
        }
    }

    include 'Config/db.php';

    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, login, senha, email, foto) VALUES (:nome, :login, :senha, :email, :foto)");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':foto', $foto);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit;
    } else {
        $erro = "Erro ao cadastrar usuário.";
    }
}

include 'header.php';
?>

<section>
    <div class="form-box-cadastro">
        <div class="form-value">
            <form action="" method="POST" enctype="multipart/form-data">
                <h2>Cadastro</h2>
                <div class="inputbox">
                    <input type="text" name="nome" required>
                    <label for="">Nome</label>
                </div>
                <div class="inputbox">
                    <input type="text" name="login" required>
                    <label for="">Login</label>
                </div>
                <div class="inputbox">
                    <input type="password" name="senha" required minlength="6">
                    <label for="">Senha</label>
                </div>
                <div class="inputbox">
                    <input type="email" name="email" required>
                    <label for="">Email</label>
                </div>
                <div class="inputbox">
                    <input type="file" name="foto" accept="image/*">
                    <label for="">Upload de foto</label>
                </div>
                <button type="submit">Salvar</button>
                <a href="login.php">Voltar</a>
                <?php if ($erro): ?>
                    <div class="error"><?php echo htmlspecialchars($erro); ?></div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</section>

<?php
include 'footer.php';
?>
