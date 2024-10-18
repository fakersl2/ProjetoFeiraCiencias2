<?php
session_start();
include '../../../backend/conexao.php'; // Inclui o arquivo de conexão

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = $_POST['codigo']; // Recebe o código de identificação do formulário

    // Verifica se o código foi informado
    if (empty($codigo)) {
        echo "<script>alert('O código de identificação é obrigatório!');</script>";
    } else {
        // Prepara e executa a consulta para verificar se o usuário existe
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE senha = ?");
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verifica se o usuário foi encontrado
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['userId'] = $row['id']; // Armazena o ID do usuário na sessão
            header('Location: /inicio.php'); // Redireciona para a página inicial
            exit();
        } else {
            echo "<script>alert('Código de identificação inválido!');</script>";
        }

        // Fecha a declaração
        $stmt->close();
    }
}

// Fecha a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Login</title>
</head>
<body class="flex items-center justify-center min-h-screen mx-2 bg-gray-100 select-none">
    <div class="flex flex-col w-full max-w-4xl overflow-hidden bg-white rounded-lg shadow-md md:flex-row">
        <div class="w-full p-8 mt-12 md:w-1/2">
            <div class="flex justify-center mb-8">
                <h2 class="mb-4 text-2xl font-bold text-gray-700 md:text-3xl">Logar</h2>
            </div>
            <p class="mb-6 text-sm text-gray-600 md:text-base">Não possui conta? <a href="/cadastro.php" class="text-green-600 hover:underline">Cadastrar</a></p>

            <form method="POST" action="" class="bg-white">
                <div class="mb-4">
                    <label for="codigo" class="block text-sm font-medium text-gray-700 md:text-base">Identificação:</label>
                    <input
                        type="password" // Campo para senha (código de identificação)
                        id="codigo" // ID do campo
                        name="codigo" // Nome do campo
                        class="w-full px-4 py-2 leading-tight transition-all bg-white border-2 border-gray-200 rounded-lg focus:outline-none focus:bg-white focus:border-green-600 focus:mt-2"
                        placeholder="Código de identificação" // Placeholder do campo
                        required // Campo obrigatório
                    />
                </div>

                <div class="mb-6">
                    <button type="submit" class="flex items-center justify-center w-full px-4 py-2 text-white transition duration-300 ease-in-out bg-green-500 border-2 border-gray-200 rounded-lg hover:bg-green-600">
                        Entrar
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Espaço para Imagem -->
        <div class="hidden md:block md:w-1/2">
            <div class="object-cover w-full h-full bg-green-500">
                <img src="../../public/logo.png" alt="Logo" class="relative mx-auto h-2/3" style="transform: translateY(-50%);" />
                <!-- Exibe o logo do colégio, centralizado verticalmente -->
            </div>
        </div>
    </div>
</body>
</html>
