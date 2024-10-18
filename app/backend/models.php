<?php
include_once('conexao.php');
class Avaliacoes {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function create($nota, $comentario, $projeto_id, $usuario_id) {
        $stmt = $this->mysqli->prepare("INSERT INTO avaliacoes (nota, comentario, projeto_id, usuario_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssii", $nota, $comentario, $projeto_id, $usuario_id);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function getById($id) {
        $stmt = $this->mysqli->prepare("SELECT * FROM avaliacoes WHERE codigo = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function associate($projeto_id, $usuario_id) {
        // Aqui você pode implementar associações se necessário
    }
}

class Categorias {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function create($nome) {
        $stmt = $this->mysqli->prepare("INSERT INTO categorias (nome) VALUES (?)");
        $stmt->bind_param("s", $nome);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function getAll() {
        $result = $this->mysqli->query("SELECT * FROM categorias");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function associate($id) {
        // Implementar associações, se necessário
    }
}

class Projetos {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function create($nome, $descricao, $categoria_id, $turma_id) {
        $stmt = $this->mysqli->prepare("INSERT INTO projetos (nome, descricao, categoria_id, turma_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssii", $nome, $descricao, $categoria_id, $turma_id);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function getAll() {
        $result = $this->mysqli->query("SELECT * FROM projetos");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

class ProjetosXcategorias {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function create($projeto_id, $categoria_id) {
        $stmt = $this->mysqli->prepare("INSERT INTO projetosXcategorias (projeto_id, categoria_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $projeto_id, $categoria_id);
        $stmt->execute();
        return $stmt->insert_id;
    }
}

class ProjetosXturmas {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function create($projeto_id, $turma_id) {
        $stmt = $this->mysqli->prepare("INSERT INTO projetosXturmas (projeto_id, turma_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $projeto_id, $turma_id);
        $stmt->execute();
        return $stmt->insert_id;
    }
}

class Turmas {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function create($nome) {
        $stmt = $this->mysqli->prepare("INSERT INTO turmas (nome) VALUES (?)");
        $stmt->bind_param("s", $nome);
        $stmt->execute();
        return $stmt->insert_id;
    }
}

class Usuarios {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function create($nome, $senha) {
        $stmt = $this->mysqli->prepare("INSERT INTO usuarios (nome, senha) VALUES (?, ?)");
        $stmt->bind_param("ss", $nome, $senha);
        $stmt->execute();
        return $stmt->insert_id;
    }
}

?>