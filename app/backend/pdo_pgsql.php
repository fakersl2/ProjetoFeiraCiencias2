<?php
// Carregar variáveis de ambiente manualmente
$host = getenv('PGHOST') ?: 'postgres.railway.internal';
$db = getenv('PGDATABASE') ?: 'railway';
$user = getenv('PGUSER') ?: 'postgres';
$pass = getenv('PGPASSWORD') ?: 'eoHLxHGzNMJvnEkdwKVYieTvQaaCBjjY';

try {
    // Criar a conexão usando PDO
    $conn = new PDO("pgsql:host=$host;dbname=$db", $user, $pass);
    // Definir o modo de erro do PDO para exceção
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Conexão bem-sucedida!<br>";

    // Criar tabela
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
    // Fechar a conexão
    $conn = null;
}
?>