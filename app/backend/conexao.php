<?php
$servername = "db"; // seu servidor, por exemplo 'localhost'
$username = "user"; // seu usuário do banco de dados
$password = "root"; // a sua senha do banco de dados
$dbname = "projetofeiraciencias"; // nome do banco de dados que você deseja usar

try {
    // Cria a conexão usando PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    // Define o modo de erro do PDO para exceção
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL para criar a tabela 'usuarios'
    $sql_usuarios = "CREATE TABLE IF NOT EXISTS usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(255),
        senha VARCHAR(255),
        createdAt DATETIME NOT NULL,
        updatedAt DATETIME NOT NULL
    )";

    $conn->exec($sql_usuarios);
    echo "Tabela 'usuarios' criada com sucesso.<br>";

    // SQL para criar outras tabelas (exemplo para 'avaliacoes')
    $sql_avaliacoes = "CREATE TABLE IF NOT EXISTS avaliacoes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        codigo INT,
        nota VARCHAR(255),
        comentario VARCHAR(255),
        projeto_id INT NOT NULL,
        usuario_id INT NOT NULL,
        createdAt DATETIME NOT NULL,
        updatedAt DATETIME NOT NULL,
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
