<?php
// Carregar variáveis de ambiente manualmente
$host = getenv('PGHOST');
$db = getenv('PGDATABASE');
$user = getenv('PGUSER');
$pass = getenv('PGPASSWORD');

try {
    $conn = new PDO("pgsql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Conexão bem-sucedida!<br>";

    // Criar tabela 'usuarios'
    $sql = "CREATE TABLE IF NOT EXISTS usuarios (
        id SERIAL PRIMARY KEY,
        nome VARCHAR(255),
        senha VARCHAR(255),
        createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    $conn->exec($sql);
    echo "Tabela 'usuarios' criada com sucesso!<br>";

    // Inserir dados
    $sql = "INSERT INTO usuarios (nome, senha) VALUES (:nome, :senha)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['nome' => 'João', 'senha' => 'senha123']);
    echo "Dados inseridos com sucesso!<br>";

} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
} finally {
    $conn = null;
}
?>