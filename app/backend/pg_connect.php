<?php
// Carregar variáveis de ambiente manualmente
$host = getenv('PGHOST') ?: 'localhost';
$dbname = getenv('PGDATABASE') ?: 'railway';
$user = getenv('PGUSER') ?: 'postgres';
$pass = getenv('PGPASSWORD') ?: 'sua_senha_aqui';

try {
    // Cria a conexão usando PDO
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);
    // Define o modo de erro do PDO para exceção
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL para criar a tabela 'usuarios'
    $sql_usuarios = "CREATE TABLE IF NOT EXISTS usuarios (
        id SERIAL PRIMARY KEY,
        nome VARCHAR(255),
        senha VARCHAR(255),
        createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    $conn->exec($sql_usuarios);
    echo "Tabela 'usuarios' criada com sucesso.<br>";

    // SQL para criar a tabela 'avaliacoes'
    $sql_avaliacoes = "CREATE TABLE IF NOT EXISTS avaliacoes (
        id SERIAL PRIMARY KEY,
        codigo INT,
        nota VARCHAR(255),
        comentario VARCHAR(255),
        projeto_id INT NOT NULL,
        usuario_id INT NOT NULL,
        createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (projeto_id) REFERENCES projetos(id),
        FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
    )";

    $conn->exec($sql_avaliacoes);
    echo "Tabela 'avaliacoes' criada com sucesso.<br>";

    // Repita para as outras tabelas...

} catch (PDOException $e) {
    die("Conexão falhou: " . $e->getMessage());
}
?>