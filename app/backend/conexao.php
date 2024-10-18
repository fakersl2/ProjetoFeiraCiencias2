<?php
$servername = "db"; // seu servidor, por exemplo 'localhost'
$username = "user"; // seu usuário do banco de dados
$password = "root"; // sua senha do banco de dados
$dbname = "projetofeiraciencias"; // nome do banco de dados que você deseja usar

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// SQL para criar a tabela 'usuarios'
$sql_usuarios = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255),
    senha VARCHAR(255),
    createdAt DATETIME NOT NULL,
    updatedAt DATETIME NOT NULL
)";

if ($conn->query($sql_usuarios) === TRUE) {
    echo "Tabela 'usuarios' criada com sucesso.<br>";
} else {
    echo "Erro ao criar tabela 'usuarios': " . $conn->error . "<br>";
}

// SQL para criar a tabela 'avaliacoes'
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

if ($conn->query($sql_avaliacoes) === TRUE) {
    echo "Tabela 'avaliacoes' criada com sucesso.<br>";
} else {
    echo "Erro ao criar tabela 'avaliacoes': " . $conn->error . "<br>";
}

// SQL para criar a tabela 'projetos'
$sql_projetos = "CREATE TABLE IF NOT EXISTS projetos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255),
    descricao VARCHAR(255),
    categoria_id INT NOT NULL,
    turma_id INT NOT NULL,
    createdAt DATETIME NOT NULL,
    updatedAt DATETIME NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id),
    FOREIGN KEY (turma_id) REFERENCES turmas(id)
)";

if ($conn->query($sql_projetos) === TRUE) {
    echo "Tabela 'projetos' criada com sucesso.<br>";
} else {
    echo "Erro ao criar tabela 'projetos': " . $conn->error . "<br>";
}

// SQL para criar a tabela 'projetosXcategorias'
$sql_projetos_x_categorias = "CREATE TABLE IF NOT EXISTS projetosXcategorias (
    projeto_id INT NOT NULL,
    categoria_id INT NOT NULL,
    createdAt DATETIME NOT NULL,
    updatedAt DATETIME NOT NULL,
    PRIMARY KEY (projeto_id, categoria_id),
    FOREIGN KEY (projeto_id) REFERENCES projetos(id),
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
)";

if ($conn->query($sql_projetos_x_categorias) === TRUE) {
    echo "Tabela 'projetosXcategorias' criada com sucesso.<br>";
} else {
    echo "Erro ao criar tabela 'projetosXcategorias': " . $conn->error . "<br>";
}

// SQL para criar a tabela 'categorias'
$sql_categorias = "CREATE TABLE IF NOT EXISTS categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255),
    createdAt DATETIME NOT NULL,
    updatedAt DATETIME NOT NULL
)";

if ($conn->query($sql_categorias) === TRUE) {
    echo "Tabela 'categorias' criada com sucesso.<br>";
} else {
    echo "Erro ao criar tabela 'categorias': " . $conn->error . "<br>";
}

// SQL para criar a tabela 'turmas'
$sql_turmas = "CREATE TABLE IF NOT EXISTS turmas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255),
    createdAt DATETIME NOT NULL,
    updatedAt DATETIME NOT NULL
)";

if ($conn->query($sql_turmas) === TRUE) {
    echo "Tabela 'turmas' criada com sucesso.<br>";
} else {
    echo "Erro ao criar tabela 'turmas': " . $conn->error . "<br>";
}

// SQL para criar a tabela 'projetosXturmas'
$sql_projetos_x_turmas = "CREATE TABLE IF NOT EXISTS projetosXturmas (
    projeto_id INT NOT NULL,
    turma_id INT NOT NULL,
    createdAt DATETIME NOT NULL,
    updatedAt DATETIME NOT NULL,
    PRIMARY KEY (projeto_id, turma_id),
    FOREIGN KEY (projeto_id) REFERENCES projetos(id),
    FOREIGN KEY (turma_id) REFERENCES turmas(id)
)";

if ($conn->query($sql_projetos_x_turmas) === TRUE) {
    echo "Tabela 'projetosXturmas' criada com sucesso.<br>";
} else {
    echo "Erro ao criar tabela 'projetosXturmas': " . $conn->error . "<br>";
}

// Fecha a conexão
$conn->close();
?>