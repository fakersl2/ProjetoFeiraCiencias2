<?php
include '../../../backend/conexao.php';

// Inicia a sessão para usar a autenticação
session_start();

// Função para buscar todos os projetos
function buscarProjetos($conn, $searchTerm = "") {
    $sql = "SELECT * FROM projetos";
    if ($searchTerm) {
        $sql .= " WHERE nome LIKE '%" . $conn->real_escape_string($searchTerm) . "%'";
    }
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Função para buscar categorias
function buscarCategorias($conn) {
    $sql = "SELECT * FROM categorias";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Função para buscar turmas
function buscarTurmas($conn) {
    $sql = "SELECT * FROM turmas";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Recebe o termo de busca do formulário
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Busca projetos, turmas e categorias
$projetos = buscarProjetos($conn, $searchTerm);
$turmas = buscarTurmas($conn);
$categorias = buscarCategorias($conn);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Projetos</title>
</head>
<body class="bg-white">
    <div class="container px-4 py-8 mx-auto">
        <h1 class="text-3xl font-bold text-black">Projetos</h1>
        <div class="flex flex-col gap-8 md:flex-row">
            <aside class="w-full pt-8 md:w-3/4">
                <form class="flex items-center mx-auto" method="GET" action="">
                    <label for="default-search" class="sr-only">Pesquisar</label>
                    <div class="relative w-full">
                        <input
                            type="search"
                            id="default-search"
                            name="search"
                            class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-500 focus:border-green-500"
                            placeholder="Buscar..."
                            required
                        />
                        <button
                            type="submit"
                            class="absolute inset-y-0 right-0 flex items-center px-4 text-sm text-gray-500 hover:text-gray-900">
                            <svg
                                class="w-5 h-5"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 20 20"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                                />
                            </svg>
                        </button>
                    </div>
                </form>

                <div class="pt-4">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <?php foreach ($projetos as $projeto): ?>
                            <div class="flex items-center justify-between w-full p-4 bg-gray-100 border border-gray-200 rounded-lg shadow-md">
                                <div>
                                    <h2 class="text-lg font-medium text-gray-800">
                                        <a href="/projeto/<?= $projeto['id'] ?>" class="cursor-pointer">
                                            <?= htmlspecialchars($projeto['nome']) ?>
                                        </a>
                                    </h2>
                                    <div class="space-x-4 text-sm text-gray-500">
                                        <span>
                                            <?= htmlspecialchars(
                                                array_search($projeto['categoria_id'], array_column($categorias, 'id')) !== false ? $categorias[array_search($projeto['categoria_id'], array_column($categorias, 'id'))]['nome'] : 'N/A'
                                            ) ?>
                                        </span>
                                        <span>
                                            <?= htmlspecialchars(
                                                array_search($projeto['turma_id'], array_column($turmas, 'id')) !== false ? $turmas[array_search($projeto['turma_id'], array_column($turmas, 'id'))]['nome'] : 'N/A'
                                            ) ?>
                                        </span>
                                    </div>
                                </div>
                                <button class="relative flex items-center justify-center w-10 h-10 text-2xl font-bold text-gray-800 transition-all duration-300 ease-in-out rounded-full hover:bg-gray-200">+</button>
                            </div>
                        <?php endforeach; ?>

                        <div class="flex items-center justify-between w-full p-4 bg-gray-100 border-2 border-gray-200 border-dashed rounded-lg shadow-md hover:shadow-lg">
                            <div>
                                <h2 class="text-lg font-medium text-gray-800">Adicionar Novo Projeto</h2>
                                <div class="space-x-4 text-sm text-gray-500">
                                    <span>Disciplinas</span>
                                    <span>Salas</span>
                                </div>
                            </div>
                            <button class="relative flex items-center justify-center w-10 h-10 text-2xl font-bold text-gray-800 transition-all duration-300 ease-in-out rounded-full hover:bg-gray-200">
                                <img src="../../../assets/img/addicon.svg" alt="Adicionar">
                            </button>
                        </div>
                    </div>
                </div>
            </aside>

            <aside class="w-full pt-8 md:w-1/4">
                <div class="mt-4">
                    <h2 class="py-1 pl-3 text-2xl text-white rounded-md bg-gradient-to-r from-green-400 via-green-500 to-green-600">Filtrar por Disciplina</h2>
                </div>
                <ul class="p-4 space-y-2">
                    <?php foreach ($categorias as $categoria): ?>
                        <li class="flex items-center">
                            <input id="<?= $categoria['id'] ?>" type="checkbox" value="<?= $categoria['id'] ?>" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 focus:ring-2" />
                            <label for="<?= $categoria['id'] ?>" class="ml-2 text-sm font-medium text-gray-900"><?= htmlspecialchars($categoria['nome']) ?></label>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="mt-4">
                    <h2 class="py-1 pl-3 text-2xl text-white rounded-md bg-gradient-to-r from-green-400 via-green-500 to-green-600">Filtrar por Turma</h2>
                </div>
                <ul class="p-4 space-y-2">
                    <?php foreach ($turmas as $turma): ?>
                        <li class="flex items-center">
                            <input id="<?= $turma['id'] ?>" type="checkbox" value="<?= $turma['id'] ?>" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 focus:ring-2" />
                            <label for="<?= $turma['id'] ?>" class="ml-2 text-sm font-medium text-gray-900"><?= htmlspecialchars($turma['nome']) ?></label>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </aside>
        </div>
    </div>
</body>
</html>