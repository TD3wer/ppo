<?php

class Projeto {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll($tipo = null, $termo = null) {
        $sql = "SELECT p.*, u.nome AS orientador_nome, c.nome AS coorientador_nome 
                FROM projetos p
                LEFT JOIN usuarios u ON p.orientador_id = u.id
                LEFT JOIN usuarios c ON p.coorientador_id = c.id WHERE 1=1";

        if ($tipo) {
            $sql .= " AND p.tipo_projeto = ?";
        }

        if ($termo) {
            $sql .= " AND p.titulo LIKE ?";
        }

        $sql .= " ORDER BY p.id DESC";

        $stmt = $this->pdo->prepare($sql);

        $params = [];
        if ($tipo && $termo) {
            $params = [$tipo, "%$termo%"];
        } elseif ($tipo) {
            $params = [$tipo];
        } elseif ($termo) {
            $params = ["%$termo%"];
        }

        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM projetos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUsuariosPorTipo($tipo) {
        $stmt = $this->pdo->prepare("SELECT id, nome FROM usuarios WHERE tipo = ?");
        $stmt->execute([$tipo]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($dados) {
        $nomeImagem = null;

        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $pastaUpload = __DIR__ . '/../../public/uploads/';

            if (!is_dir($pastaUpload)) {
                die("Pasta uploads não existe.");
            }

            if (!is_writable($pastaUpload)) {
                die("Pasta uploads não tem permissão de escrita.");
            }

            $nomeArquivo = basename($_FILES['imagem']['name']);
            $nomeImagem = uniqid('img_') . '_' . $nomeArquivo;

            if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $pastaUpload . $nomeImagem)) {
                die("Erro ao mover imagem.");
            }
        }

        $stmt = $this->pdo->prepare("
            INSERT INTO projetos 
            (tipo_projeto, titulo, subtitulo, descricao, orientador_id, coorientador_id, data_inicio, data_fim, status, imagem) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $dados['tipo_projeto'],
            $dados['titulo'],
            $dados['subtitulo'] ?? '',
            $dados['descricao'] ?? '',
            $dados['orientador'] ?? null,
            $dados['coorientador'] ?? null,
            $dados['data_inicio'],
            $dados['data_fim'],
            $dados['status'],
            $nomeImagem
        ]);
    }

    public function update($id, $dados) {
        $nomeImagem = $dados['imagem_atual'] ?? null;

        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $pastaUpload = __DIR__ . '/../../public/uploads/';

            if (!is_dir($pastaUpload)) {
                die("Pasta uploads não existe.");
            }

            if (!is_writable($pastaUpload)) {
                die("Pasta uploads não tem permissão de escrita.");
            }

            if (!empty($nomeImagem) && file_exists($pastaUpload . $nomeImagem)) {
                unlink($pastaUpload . $nomeImagem);
            }

            $nomeArquivo = basename($_FILES['imagem']['name']);
            $nomeImagem = uniqid('img_') . '_' . $nomeArquivo;

            if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $pastaUpload . $nomeImagem)) {
                die("Erro ao mover imagem.");
            }
        }

        $stmt = $this->pdo->prepare("
            UPDATE projetos SET 
                tipo_projeto = ?,
                titulo = ?, 
                subtitulo = ?, 
                descricao = ?, 
                orientador_id = ?, 
                coorientador_id = ?, 
                data_inicio = ?, 
                data_fim = ?, 
                status = ?, 
                imagem = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            $dados['tipo_projeto'],
            $dados['titulo'],
            $dados['subtitulo'] ?? '',
            $dados['descricao'] ?? '',
            $dados['orientador'] ?? null,
            $dados['coorientador'] ?? null,
            $dados['data_inicio'],
            $dados['data_fim'],
            $dados['status'],
            $nomeImagem,
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM projetos WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getColaboradores($projeto_id) {
        $stmt = $this->pdo->prepare("
            SELECT u.id, u.nome 
            FROM projetos_colaboradores pc
            JOIN usuarios u ON pc.usuario_id = u.id
            WHERE pc.projeto_id = ?
        ");
        $stmt->execute([$projeto_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsuariosParaColaboracao() {
        $stmt = $this->pdo->query("SELECT id, nome, tipo FROM usuarios WHERE tipo IN ('bolsista', 'aluno')");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteColaboradores($projeto_id) {
        $stmt = $this->pdo->prepare("DELETE FROM projetos_colaboradores WHERE projeto_id = ?");
        return $stmt->execute([$projeto_id]);
    }

    public function addColaborador($projeto_id, $usuario_id) {
        $stmt = $this->pdo->prepare("INSERT INTO projetos_colaboradores (projeto_id, usuario_id) VALUES (?, ?)");
        return $stmt->execute([$projeto_id, $usuario_id]);
    }
}