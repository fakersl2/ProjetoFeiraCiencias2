<?php
require 'conexao.php'; // Conexão com o banco 'BancoProjetoFeiraCiencias'

// Inicializa variáveis
$nomeProjeto = $descricaoProjeto = $categoria = $turma = $errorMessage = "";
$categorias = $turmas = [];

// Busca categorias
$resultCategorias = $conexao->query("SELECT id, nome FROM Categorias");
if ($resultCategorias) {
    $categorias = $resultCategorias->fetch_all(MYSQLI_ASSOC);
}

// Busca turmas
$resultTurmas = $conexao->query("SELECT id, nome FROM Turmas");
if ($resultTurmas) {
    $turmas = $resultTurmas->fetch_all(MYSQLI_ASSOC);
}

// Lógica para salvar o projeto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomeProjeto = $_POST['nome'];
    $descricaoProjeto = $_POST['descricao'] ?? '';
    $categoria = $_POST['categoria'];
    $turma = $_POST['turma'];

    $sql = "INSERT INTO Projetos (nome, descricao, categoria_id, turma_id) 
            VALUES (?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('ssii', $nomeProjeto, $descricaoProjeto, $categoria, $turma);

    if ($stmt->execute()) {
        echo "<script>alert('Projeto salvo com sucesso!'); window.location.reload();</script>";
    } else {
        $errorMessage = "Erro ao salvar projeto: " . $conexao->error;
    }
}
?>

<!-- Modal HTML -->
<div class="fixed inset-0 z-50 flex items-center justify-center overflow-hidden">
    <div class="fixed inset-0 bg-black opacity-50" onclick="fecharModal()"></div>
    <div class="z-10 px-10 py-8 bg-white rounded-lg shadow-lg min-w-fit">
        <h2 class="pb-5 text-xl font-semibold text-center">Adicionar Novo Projeto</h2>
        <form method="POST" action="">
            <input type="text" name="nome" placeholder="Nome do Projeto" 
                class="w-full p-2 mb-4 border border-gray-300 rounded-md" required>

            <textarea name="descricao" placeholder="Descrição do Projeto (opcional)" 
                class="w-full p-2 mb-4 border border-gray-300 rounded-md resize-none"></textarea>

            <select name="categoria" class="w-full p-2 mb-4 border border-gray-300 rounded-md" required>
                <option value="">Selecione a Disciplina</option>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?= $cat['id'] ?>"><?= $cat['nome'] ?></option>
                <?php endforeach; ?>
            </select>

            <select name="turma" class="w-full p-2 mb-4 border border-gray-300 rounded-md" required>
                <option value="">Selecione a Turma</option>
                <?php foreach ($turmas as $turma): ?>
                    <option value="<?= $turma['id'] ?>"><?= $turma['nome'] ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit" class="w-full px-4 py-2 text-white bg-green-400 rounded-md">
                Salvar
            </button>
        </form>
        <?php if ($errorMessage): ?>
            <p class="mt-4 text-red-500"><?= $errorMessage ?></p>
        <?php endif; ?>
    </div>
</div>

<script>
    function fecharModal() {
        document.querySelector('.fixed').style.display = 'none';
    }
</script>
