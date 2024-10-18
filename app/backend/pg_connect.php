<?php
// Carregar variáveis de ambiente manualmente
$host = getenv('PGHOST') ?: 'postgres.railway.internal';
$db = getenv('PGDATABASE') ?: 'railway';
$user = getenv('PGUSER') ?: 'postgres';
$pass = getenv('PGPASSWORD') ?: 'eoHLxHGzNMJvnEkdwKVYieTvQaaCBjjY';

// Criar a conexão
$conn_string = "host=$host dbname=$db user=$user password=$pass";
$conn = pg_connect($conn_string);

if (!$conn) {
    die("Erro de conexão: " . pg_last_error());
}
echo "Conexão bem-sucedida!";

// Criar tabela
$sql = "CREATE TABLE IF NOT EXISTS usuarios (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(255),
    senha VARCHAR(255),
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$result = pg_query($conn, $sql);
if (!$result) {
    echo "Erro ao criar tabela: " . pg_last_error();
} else {
    echo "Tabela 'usuarios' criada com sucesso!";
}

// Inserir dados
$sql = "INSERT INTO usuarios (nome, senha) VALUES ('João', 'senha123')";
$result = pg_query($conn, $sql);
if (!$result) {
    echo "Erro ao inserir dados: " . pg_last_error();
} else {
    echo "Dados inseridos com sucesso!";
}

// Fechar a conexão
pg_close($conn);
?>
