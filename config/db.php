<?php
// Configuração do banco de dados
$host = '127.0.0.1';       // Endereço do servidor MySQL
$db = 'projetologin';       // Nome do banco de dados
$user = 'root';             // Usuário do banco de dados (geralmente 'root' para XAMPP)
$pass = '';                 // Senha do banco de dados (geralmente vazio no XAMPP)
$charset = 'utf8mb4';       // Codificação do banco de dados (UTF-8)

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";  // String de conexão
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Exibição de erros
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Formato de retorno como array associativo
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Desabilita o uso de emulação de prepared statements
];

try {
    // Tentativa de conexão ao banco de dados
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Em caso de erro de conexão, exibe uma mensagem de erro
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

?>
